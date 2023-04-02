jQuery(document).ready(function () {
    let contentdata = JSON.parse($('#datacontent').html());
    function getMainData() {
        $.ajax({
            url: '/get_users',
            dataType: 'json',
            success: function (response) {
                contentdata = response.data;
                drawTable(contentdata);
            },
            error: function (xhr, status, error) {
                alert(error);
            }
        });
    }

    /**
     * @returns {jQuery|HTMLElement|*}
     * @param contentdata
     */
    function drawTable(contentdata) {
        if (contentdata.length > 0) {

            var table = $('<table>').addClass('table');
            var thead = $('<thead>');
            var tbody = $('<tbody>');

            var headerRow = $('<tr>');
            headerRow.append($('<th>').text('Name'));
            headerRow.append($('<th>').text('Surname'));
            headerRow.append($('<th>').text('Position'));
            headerRow.append($('<th>').text('Actions'));
            thead.append(headerRow);

            $.each(contentdata, function(i, item) {
                var row = $('<tr>');
                row.append($('<td>').text(item.name));
                row.append($('<td>').text(item.lastname));
                row.append($('<td>').text(item.position));
                let editButton = $("<button>", {
                    type: "button",
                    class: "btn btn-outline-success btn-sm ml-1 edit_user",
                    "data-userid":item.id,
                    "data-username":item.name,
                    "data-userlastname":item.lastname,
                    "data-userposition":item.position,
                    "data-toggle":"modal",
                    "data-target": "#editUserModal",
                    text: "Edit"
                });
                let deleteButton = $("<button>", {
                    type: "button",
                    class: "btn btn-outline-danger btn-sm delete_user",
                    "data-userid":item.id,
                    "data-username":item.name,
                    "data-toggle":"modal",
                    "data-target": "#deleteUserModal",
                    text: "delete"
                });
                let td = $('<td>').append(editButton).append(deleteButton);
                row.append(td);
                tbody.append(row);
            });

            table.append(thead);
            table.append(tbody);
            $('#content').html(table);
        } else {
            $('#content').html("<h2>There is no users in database</h2>");
        }
    }

    getMainData(contentdata);

    $('#createUser #user_name').on('input', function () {
        let span = $('#createUser #nameError');
        span.text('');
        $(this).removeClass('is-invalid');
    });

    $('#createUser #user_last_name').on('input', function () {
        let span = $('#createUser #lastnameError');
        span.text('');
        $(this).removeClass('is-invalid');
    });

    $('#createUser #user_position').on('change', function () {
        let span = $('#createUser #lastnameError');
        span.text('');
        $(this).removeClass('is-invalid');
    });

    $('body').on('click', 'button.delete_user', function (event) {
        let userId = $(this).data('userid');
        let userName = $(this).data('username');
        $('#deleteUserModal p#confirmation_text').text('You try to delete ' + userName);
        $('#deleteUserModal #user_id').val(userId);
        $('#deleteUserModal').modal('show');
    });

    $('body').on('click', 'button.edit_user', function (event) {
        let userId = $(this).data('userid');
        let username = $(this).data('username');
        let userlastname = $(this).data('userlastname');
        $('#editUser #user_id').val(userId);
        $('#editUser #user_name').val(username);
        $('#editUser #user_last_name').val(userlastname);

        $('#editNodeModal').modal('show');
    });

    $('#createUser').submit(function (event) {
        event.preventDefault();
        let formData = $(this).serialize();
        jQuery.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function (response) {
                getMainData();
                let message = JSON.parse(response)
                alert(message.data)
                $('#createUser').trigger('reset');
                $('#createUserModal').modal('hide');
            },
            error: function (xhr) {
                let errors = JSON.parse(xhr.responseText);
                if (typeof errors.errors === 'string') {
                    alert(errors.errors);
                    $('#createUser').trigger('reset');
                    $('#createUserModal').modal('hide');
                } else {
                    let field = Object.keys(errors.errors)[0];
                    $('#createUser #' + field).addClass('is-invalid');
                    let span = $('#createUser #' + field + 'Error');
                    span.text(errors.errors[field]);
                }
            }
        });
    });

    $('#editUser').submit(function (event) {
        event.preventDefault();
        let userId = $('#editUser #user_id').val();
        let userName = $('#editUser #user_name').val();
        let userLastName = $('#editUser #user_last_name').val();
        let userPosition = $('#editUser #user_position').val();
        let formData = $(this).serialize();
        jQuery.ajax({
            url: $(this).attr('action') + '?user_id=' + userId + '&user_name=' + userName + '&user_last_name=' + userLastName + '&user_position=' + userPosition,
            type: 'PUT',
            data: formData,
            success: function (response) {
                getMainData();
                let message = JSON.parse(response);
                alert(message.data);
                $('#editUser').trigger('reset');
                $('#editUserModal').modal('hide');
            },
            error: function (xhr) {
                let errors = JSON.parse(xhr.responseText);
                if (typeof errors.errors === 'string') {
                    alert(errors.errors);
                    $('#editUser').trigger('reset');
                    $('#editUserModal').modal('hide');
                } else {
                    let field = Object.keys(errors.errors)[0];
                    $('#editUser #' + field).addClass('is-invalid');
                    let span = $('#editUser #' + field + 'Error');
                    span.text(errors.errors[field]);
                }
            }
        });
    });

    $('#deleteUser').submit(function (event) {
        event.preventDefault();
        let userId = $('#deleteUser #user_id').val();
        let formData = $(this).serialize();
        jQuery.ajax({
            url: $(this).attr('action') + "?user_id=" + userId,
            type: 'DELETE',
            data: formData,
            success: function (response) {
                getMainData();
                let message = JSON.parse(response)
                alert(message.data)
                $('#deleteUser').trigger('reset');
                $('#deleteUserModal p#confirmation_text').text('');
                $('#deleteUserModal').modal('hide');
            },
            error: function (xhr) {
                let errors = JSON.parse(xhr.responseText);
                if (typeof errors.errors === 'string') {
                    alert(errors.errors);
                    $('#deleteUser').trigger('reset');
                    $('#deleteUserModal p#confirmation_text').text('');
                    $('#deleteUserModal').modal('hide');
                }
            }
        });
    });
});