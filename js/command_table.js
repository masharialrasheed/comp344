$(function() {

  var commandsModule = (function() {
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
          console.log(myData.commands);
        })
        .fail(logAjaxError)
        .always(function() {
          _render();
        });
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

  commandsModule.init();
});
