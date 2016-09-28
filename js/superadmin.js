$(document).ready(function() {

    updateUserRolesTable();

    /* Send modal form data on click to set user roles */
    $('#emodal-btn').click(function() {
        $.ajax({
            type: "POST",
            url: "php/roles.php",
            cache: false,
            data: $('#emodal-form').serialize(),
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('#emodal-btn').removeClass('btn-primary')
                                    .addClass('btn-success')
                                    .text('Saved!');
                    updateUserRolesTable();
                } else {
                    $('#emodal-btn').text('Error!');
                }
            },
            error: handleAjaxError,
            complete: function() {
                setTimeout(function() {
                    $('#emodal').modal('hide');
                    $('#emodal-btn').removeClass('btn-success')
                                    .addClass('btn-primary')
                                    .text('Save');
                }, 500);
            }
        });
    });


    /* Reset modal form on modal close */
    $('#emodal').on('hidden.bs.modal', function () {
        $("#emodal-form").trigger('reset');
    });


    /* Updates User Roles table & modal */
    function updateUserRolesTable() {
        $.get({
            url: "php/roles.php",
            dataType: "json",
            success: function(response) {
                /* Update table */
                var tableBody = '';
                $.each(response.userroles, function(username, roles) {

                    tableBody += '<tr class="row-roles">'+
                                  '<td class="username">'+username+'</td>'+
                                  '<td>';
                    $.each(roles, function(i, role) {
                        if (role && (i !== roles.length-1)) tableBody += role+', ';
                        else if (role) tableBody += role;
                    });
                    tableBody += '</td></tr>\n';
                });
                $('#u-table-body').html(tableBody);

                /* Update modal */
                var checkboxes = '';
                $.each(response.roles, function(role_id, role_name) {
                    checkboxes += '<div class="checkbox"><label><input type="checkbox" '+
                                    'name="roles[]" role-name="'+role_name+
                                    '" value="'+role_id+'">'+role_name+'</label></div>\n';
                });
                $('#emodal-roles').html(checkboxes);

                /* Open modal form on click of user row */
                $('.row-roles').click(function() {
                    var username = $(this).find('.username').text();
                    $('#emodal-title').text('Edit Roles - '+username);
                    $('#emodal-username').val(username);
                    $('#emodal-roles div.checkbox input').each(function() {
                        if ($.inArray($(this).attr('role-name'), response.userroles[username]) > -1) {
                            $(this).prop('checked', true);
                        }
                    });
                    $('#emodal').modal('show');
                });
            },
            error: handleAjaxError
        });
    }

    /* Log AJAX errors */
    function handleAjaxError(jq, status, error)  {
        console.log("An Error Occured!");
        console.log("Text status: " + status);
        console.log("Error thrown: " + error);
        console.log("jqXHR: " + JSON.stringify(jq));
    }
});
