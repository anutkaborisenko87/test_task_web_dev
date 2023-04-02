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
                        <select class="custom-select" name="position" id="user_position">
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
            <form id="" action="/delete_user" method="post">
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
