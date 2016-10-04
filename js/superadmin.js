$(function() {

  var userRolesModule = (function() {
    var myData = { 'users':[], 'roles':[] };
    var currentUser = '';

    /* Cache DOM elements */
    var $table  = $('#sa-table');
    var $eModal = $('#emodal');
    var $modalTitle = $eModal.find('.modal-title');
    var $modalForm  = $eModal.find('.modal-body form');
    var $modalSave  = $eModal.find('.modal-footer button:nth-child(2)');

    var tableTpl = '<thead><tr><th>id</th><th>Username</th><th>Roles</th></tr></thead>'+
      '<tbody>'+
      '{{#.}}'+
        '<tr class="row-roles"><td>{{id}}</td><td class="username">{{username}}</td><td>{{roles}}</td></tr>'+
      '{{/.}}'+
      '{{^.}}'+
        '<tr class="row-roles"><td></td><td>No records found</td><td></td></tr>'+
      '{{/.}}'+
      '</tbody>';

    var checkboxTpl =
      '{{#.}}'+
        '<div class="checkbox"><label><input type="checkbox" name="{{name}}" value="{{id}}">{{name}}</label></div>'+
      '{{/.}}';

    /* Initialise module */
    function init() {
      // Open modal form on click of user row
      $table.on('click', '.row-roles', function() {
        currentUser = $(this).find('.username').text();
        $modalTitle.text('Edit Roles - '+currentUser);
        // Prefill checkboxes
        var user = $.grep(myData.users, function(u) { return u.username == currentUser })[0];
        $modalForm.find('input').each(function() {
          var id = parseInt($(this).val());
          if ($.inArray(id, user.role_ids) !== -1) { $(this).prop('checked', true); }
        });
        // Finally show modal
        $eModal.modal('show');
      });

      $modalSave.on('click', _submitModal);

      // Reset modal style when hidden
      $eModal.on('hidden.bs.modal', function () {
        styleBtn($modalSave, 'primary', 'Save');
        $modalForm.trigger('reset');
      });

      _update();
    }

    /* Render module */
    function _render() {
      // Render table
      var tpl = Mustache.render(tableTpl, myData.users);
      $table.html(tpl);

      // Render modal
      var tpl = Mustache.render(checkboxTpl, myData.roles);
      $modalForm.html(tpl);
    }

    /* Update user & roles data */
    function _update() {
      $.get({
        url: 'php/roles.php',
        dataType: 'json'
      })
        .done(function(d) {
          myData.users = d.users;
          myData.roles = d.roles;
        })
        .fail(logAjaxError)
        .always(function() {
          _render();
        });
    }

    /* On submit: send form data, style button, fade out, then hide */
    function _submitModal() {
      var roles = [];
      $modalForm.find('input').each(function() {
        var $check = $(this);
        if ($check.is(':checked')) { roles.push($check.val()); }
      });

      $.ajax({
        method: 'POST',
        url: 'php/roles.php',
        data: JSON.stringify({'username': currentUser, 'roles': roles}),
        dataType: 'json'
      })
        .done(function() {
          styleBtn($modalSave, 'success', 'Saved!');
        })
        .fail(function(jq, status, error) {
          styleBtn($modalSave, 'danger', 'Error!');
          logAjaxError(jq, status, error);
        })
        .always(function() {
          _update();
          setTimeout(function() { $eModal.modal('hide'); }, 500);
      });
    }

    function styleBtn(btn, style, text) {
      if (style === 'success') {
        btn.removeClass('btn-primary btn-danger')
           .addClass('btn-success');
      } else if (style === 'danger') {
        btn.removeClass('btn-primary btn-success')
           .addClass('btn-danger');
      } else if (style === 'primary') {
        btn.removeClass('btn-success btn-danger')
           .addClass('btn-primary');
      }
      btn.text(text);
    }

    /* Log AJAX errors */
    function logAjaxError(jq, status, error)  {
        console.log("An AJAX Error Occured!");
        console.log("  Text status: " + status);
        console.log("  Error thrown: " + error);
        console.log("  jqXHR: " + JSON.stringify(jq));
    }

    return {
      init: init
    };
  })();

  userRolesModule.init();
});
