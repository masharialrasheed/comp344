$(function() {

  /* Module to load table of useraccessgroups */
  var UAGModule = (function() {
    var myData = { 'users':[], 'roles':[], currentUser:'' };

    /* Cache DOM elements */
    var $table      = $('#sa-table');
    var $editModal  = $('#edit-modal');
    var $modalTitle = $editModal.find('.modal-title');
    var $modalForm  = $editModal.find('.modal-body form');
    var $modalSave  = $editModal.find('#modal-submit');

    var tableTpl = '<thead><tr><th>id</th><th>Username</th><th>Roles</th></tr></thead>'+
      '<tbody>'+
      '{{#.}}'+
        '<tr><td>{{id}}</td><td class="username">{{username}}</td><td>{{roles}}</td></tr>'+
      '{{/.}}'+
      '{{^.}}'+
        '<tr><td></td><td>No records found</td><td></td></tr>'+
      '{{/.}}'+
      '</tbody>';

    var checkboxTpl =
      '{{#.}}'+
        '<div class="checkbox"><label><input type="checkbox" name="{{name}}" value="{{id}}">{{name}}</label></div>'+
      '{{/.}}';

    /* Initialise module */
    function init() {
      // Open modal form on click of user row
      $table.on('click', 'tr', function() {
        myData.currentUser = $(this).find('.username').text();
        $modalTitle.text('Edit Roles - '+myData.currentUser);
        // Prefill checkboxes
        var user = $.grep(myData.users, function(u) { return u.username == myData.currentUser })[0];
        $modalForm.find('input').each(function() {
          var id = parseInt($(this).val());
          if ($.inArray(id, user.role_ids) !== -1) { $(this).prop('checked', true); }
        });
        // Finally show modal
        $editModal.modal('show');
      });

      // Submit modal on submit
      $modalSave.on('click', _submitModal);

      // Reset modal style when hidden
      $editModal.on('hidden.bs.modal', function () {
        help.bsStyleBtn($modalSave, 'primary', 'Save');
        $modalForm.trigger('reset');
      });

      _update();
    }

    function destroy() {
      $table.html('');

      $table.off();
      $modalSave.off();
      $editModal.off();
    }

    /* Render module */
    function _render() {
      $table.html(Mustache.render(tableTpl, myData.users));
      $modalForm.html(Mustache.render(checkboxTpl, myData.roles));
    }

    /* Update user & roles data */
    function _update() {
      $.get({
        url: 'api/useraccessgroup.php',
        dataType: 'json'
      })
        .done(function(d) {
          myData.users = d.users;
          myData.roles = d.roles;
        })
        .fail(help.logAjaxError)
        .always(_render);
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
        url: 'api/useraccessgroup.php',
        data: JSON.stringify({'username': myData.currentUser, 'roles': roles}),
        dataType: 'json'
      })
        .done(function() {
          help.bsStyleBtn($modalSave, 'success', 'Saved!');
        })
        .fail(function(jq, status, error) {
          help.bsStyleBtn($modalSave, 'danger', 'Error!');
          help.logAjaxError(jq, status, error);
        })
        .always(function() {
          _update();
          setTimeout(function() { $editModal.modal('hide'); }, 500);
      });
    }

    /* Return public methods */
    return {
      init: init,
      destroy: destroy
    };
  })();


  /* Module to load table of commands */
  var commandModule = (function() {
    var myData = { 'commands': [] };

    /* Cache DOM elements */
    var $table  = $('#sa-table');

    var tableTpl = '<thead><tr><th>id</th><th>Command</th><th>URL</th></tr></thead>'+
      '<tbody>'+
      '{{#.}}'+
        '<tr><td>{{id}}</td><td>{{name}}</td><td>{{url}}</td></tr>'+
      '{{/.}}'+
      '{{^.}}'+
        '<tr><td></td><td>No records found</td><td></td></tr>'+
      '{{/.}}'+
      '</tbody>';

    /* Initialise module */
    function init() {
      // Open modal form on click of row
      // $table.on('click', 'tr', function() {});

      _update();
    }

    function destroy() {
      $table.html('');
    }

    /* Render module */
    function _render() {
      // Render table
      $table.html(Mustache.render(tableTpl, myData.commands));
    }

    /* Update module */
    function _update() {
      $.get({
        url: 'api/command.php',
        dataType: 'json'
      })
        .done(function(d) {
          myData.commands = d;
        })
        .fail(help.logAjaxError)
        .always(function() {
          _render();
        });
    }

    return {
      init: init,
      destroy: destroy
    };
  })();


  var help = {
    /* Style Bootstrap buttons */
    bsStyleBtn: function(btn, style, text) {
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
    },

    /* Log AJAX errors */
    logAjaxError: function(jq, status, error)  {
        console.log("An AJAX Error Occured!");
        console.log("  Text status: " + status);
        console.log("  Error thrown: " + error);
        console.log("  jqXHR: " + JSON.stringify(jq));
    }
  };


  $('#pill-uag').on('click', function() {
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    commandModule.destroy();
    UAGModule.init();
  });

  $('#pill-cmd').on('click', function() {
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    UAGModule.destroy();
    commandModule.init();
  });

  UAGModule.init();
});
