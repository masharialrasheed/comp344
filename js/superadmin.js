$(function() {
  /* Cache DOM elements */
  var $eModal = $('#emodal');
  var $modalTitle = $eModal.find('.modal-title');
  var $modalForm = $eModal.find('form');
  var $modalSave = $eModal.find('.modal-footer button:nth-child(2)');

  var $table = $('#sa-table');
  var $tableHead = $table.find('thead tr');
  var $tableBody = $table.find('tbody');

  var gusers;
  var groles;

  init();


  /* Initialise page */
  function init() {
    $modalSave.on('click', submitModal);
    $eModal.on('hidden.bs.modal', function () {
      $modalForm.trigger('reset');
      $modalSave.removeClass('btn-success btn-danger').addClass('btn-primary').text('Save');
    });
    
    fillTableWithUserRoles();
  }


  /* On save: send form data, style button, fade out, then reset style */
  function submitModal() {
    var username = $eModal.prop('data-username');
    var roles = [];
    $modalForm.find('input').each(function() {
      var $box = $(this);
      if ($box.is(':checked')) {
        roles.push($box.val());
      }
    });

    $.ajax({
      method: 'POST',
      url: 'php/roles.php',
      data: {'username': username, 'roles': roles},
      dataType: 'json',
      success: function(data) {
        $modalSave.removeClass('btn-primary').addClass('btn-success').text('Saved!');
      },
      error: function(jq, status, error) {
        $modalSave.removeClass('btn-primary').addClass('btn-danger').text('Error!');
        logAjaxError(jq, status, error);
      },
      complete: function() {
        fillTableWithUserRoles();
        setTimeout(function() {
          $eModal.modal('hide');
        }, 500);
      }
    });
  }


  /* Updates User Roles table & modal */
  function fillTableWithUserRoles() {
    $tableHead.html('<th>Username</th><th>Roles</th>');

    $.get({
      url: 'php/roles.php',
      dataType: 'json',
      success: function(data) {
        /* Update table */
        var userTemplate = '<tr class="row-roles"><td class="username">{{username}}</td><td>{{roles}}</td></tr>';
        var tableBodyHtml = '';
        $.each(data.users, function(k, v) {
          tableBodyHtml += Mustache.render(userTemplate, this);
        });
        $tableBody.html(tableBodyHtml);

        /* Update modal */
        var checkboxTemplate = '<div class="checkbox"><label><input type="checkbox" name="{{name}}" value="{{id}}">{{name}}</label></div>';
        var checkboxHtml = '';
        $.each(data.roles, function(k, v) {
          checkboxHtml += Mustache.render(checkboxTemplate, this);
        });
        $modalForm.html(checkboxHtml);

        /* Open modal form on click of user row */
        $('.row-roles').on('click', function() {
          var username = $(this).find('.username').text();
          $eModal.prop('data-username', username);
          $modalTitle.text('Edit Roles - '+username);
          // Prefill checkboxes
          $modalForm.find('input').each(function() {
            var role_id = $(this).val();
            if (role_id) { role_id = parseInt(role_id)};
            var user = data.users[username];
            if ($.inArray(role_id, user.role_ids) !== -1) {
              $(this).prop('checked', true);
            }
          });
          $eModal.modal('show');
        });
      },
      error: logAjaxError
    });
  }


  /* Log AJAX errors */
  function logAjaxError(jq, status, error)  {
      console.log("An AJAX Error Occured!");
      console.log("  Text status: " + status);
      console.log("  Error thrown: " + error);
      console.log("  jqXHR: " + JSON.stringify(jq));
  }

  jQuery.isSubstring = function(haystack, needle) {
      return haystack.indexOf(needle) !== -1;
  };
});
