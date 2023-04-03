<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createUserModal">
    + New User
</button>

<!-- Create user Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Create root</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createUser" action="/new_user" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_name">User name</label>
                        <input type="text" class="form-control" name="user_name" id="user_name" aria-describedby="user_nameError"
                               required>
                        <small id="user_nameError" class="form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_last_name">User surname</label>
                        <input type="text" class="form-control" name="user_last_name" id="user_last_name" aria-describedby="user_last_nameError"
                               required>
                        <small id="user_last_nameError" class="form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_position">Position</label>
                        <select class="custom-select" name="user_position" id="user_position">
                            <option value="" disabled selected>Choose position</option>
                            <?php foreach ($contentdata["positions"] as $position) {?>
                            <option value="<?=  $position['id'] ?>"><?=  $position['title'] ?></option>
                            <?php }?>
                        </select>
                        <small id="user_positionError" class="form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create user</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cansel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit user Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editUser" action="/edit_user" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="user_id" id="user_id">
                        <label for="user_name">User name</label>
                        <input type="text" class="form-control" name="user_name" id="user_name" aria-describedby="user_nameError"
                               required>
                        <small id="user_nameError" class="form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_last_name">User surname</label>
                        <input type="text" class="form-control" name="user_last_name" id="user_last_name" aria-describedby="user_last_nameError"
                               required>
                        <small id="user_last_nameError" class="form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_position">Position</label>
                        <select class="custom-select" name="position" id="user_position" required>
                            <option value="" disabled selected>Choose position</option>
                            <?php foreach ($contentdata["positions"] as $position) {?>
                                <option value="<?=  $position['id'] ?>"><?=  $position['title'] ?></option>
                            <?php }?>
                        </select>
                        <small id="user_positionError" class="form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cansel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete user Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Delete confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="confirmation_text"></p>
                <p> Are you sure? </p>
            </div>
            <form id="deleteUser" action="/delete_user" method="post">
                <input type="hidden" name="user_id" id="user_id">
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-danger">Yes, I am</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="datacontent" style="display: none;"><?= json_encode($contentdata) ?></div>
<div id="content" class="container-fluid">
</div>
<div class="container-fluid">
    <h2>Part 2</h2>
    <?php if (!empty($contentdata['goods'])) { ?>
    <table class="table">
        <tr>
            <?php foreach (array_keys($contentdata['goods'][0]) as $column) { ?>
                <th><?= $column ?></th>
            <?php } ?>
        </tr>
        <?php foreach ($contentdata['goods'] as $raw) { ?>
            <tr>
                <?php foreach ($raw as $column_value) { ?>
                    <td><?= $column_value ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
    <?php } ?>

    <div class="my-2 card">
        <h3>this is how the query looks like to task part 2</h3>
        "SELECT goods.name, goods.id, goods.article, goods.name, goods.price, goods.ean, goods.vat, field1.name , value1.name
        FROM goods
        LEFT JOIN additional_goods_field_values AS agfv1 ON goods.id = agfv1.good_id
        LEFT JOIN additional_fields AS field1 ON agfv1.additional_field_id = field1.id
        LEFT JOIN additional_field_values AS value1 ON agfv1.additional_field_value_id = value1.id
        LEFT JOIN additional_goods_field_values AS agfv2 ON goods.id = agfv2.good_id
        LEFT JOIN additional_fields AS field2 ON agfv2.additional_field_id = field2.id
        LEFT JOIN additional_field_values AS value2 ON agfv2.additional_field_value_id = value2.id"
    </div>
</div>
