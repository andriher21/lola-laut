<!-- Begin Page Content -->
<div class="container-fluid users-data">
    <!-- Page Heading -->


    <!-- DataTales Example -->
    <div class="section-body">
        <div class="row">
            <!-- <div class="col"></div> -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col">
                                <div class="btn-group group-action-area">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalCenter"><i class="fas fa-fw fa-plus-circle"></i> &nbsp;New</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <input type="text" id="searchbox" class="form-control" placeholder="Search">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-search text-primary"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10px" class="pr-4 pl-0">
                                            <div class="custom-control custom-checkbox table-checkbox">
                                                <input type="checkbox" class="chkboxes check check-all" value="1" data-name="Master Admin" id="table-chk-all">
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th width="5px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $count = 0;
                                    foreach ($users as $user) : ?>
                                        <tr>
                                            <td class="pr-4 pl-0">
                                                <div class="custom-control custom-checkbox table-checkbox">
                                                    <input type="checkbox" class="chkboxes check check-data" name="checkbox" value="<?= $user['user_id'] ?>" data-name="<?= $user['fullname'] ?>">
                                                </div>
                                            </td>
                                            <td><?= $user['fullname'] ?></td>
                                            <td><?= $user['username'] ?></td>
                                            <?php if ($user['role_id'] == 1) { ?>
                                                <td><span class="badge badge-pill badge-danger"><?= $user['fullname'] ?></span></td>
                                            <?php } else if ($user['role_id'] == 9) { ?>
                                                <td><span class="badge badge-pill badge-info"><?= $user['fulname'] ?></span></td>
                                            <?php } else { ?>
                                                <td><span class="badge badge-pill badge-primary"><?= $user['fullname'] ?></td>
                                            <?php } ?>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalCenter<?= $user['user_id'] ?>"><i class="fas fa-fw fa-edit"></i></button>

                                            </td>
                                        </tr>
                                    <?php endforeach ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col"></div> -->
        </div>

    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="<?= base_url('adduser') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row mb-2">
                                <!-- <div class="col">
                                    <label for="message-text" class="col-form-label">Email</label>
                                    <input class="form-control" type="text" name="email">
                                </div> -->

                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="message-text" class="col-form-label">Username </label>
                                    <input class="form-control" type="text" name="username">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="message-text" class="col-form-label">Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="Leave empty if you won't change it">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="message-text" class="col-form-label">Name</label>
                                    <input class="form-control" type="text" name="name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="message-text" class="col-form-label">Role</label>
                                    <select name="role" class="form-control">
                                        <option value="">Select Role</option>
                                        <?php foreach ($roles as $role) : ?>
                                            <option value="<?= $role['roles_id'] ?>"><?= $role['name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Edit -->
    <?php foreach ($users as $user) : ?>
        <div class="modal fade" id="modalCenter<?= $user['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Manage User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="<?= base_url('edituser') ?>" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $user['user_id'] ?>" name="id">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="message-text" class="col-form-label">Name</label>
                                        <input class="form-control" type="text" name="name" value="<?= $user['fullname'] ?>">
                                    </div>

                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="message-text" class="col-form-label">Username </label>
                                        <input class="form-control" type="text" name="username" value="<?= $user['username'] ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="message-text" class="col-form-label">Password</label>
                                        <input class="form-control" type="password" name="password" placeholder="Leave empty if you won't change it">
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col">
                                        <label for="message-text" class="col-form-label">Level</label>
                                        <input class="form-control" type="text" name="Level" value="<?= $user['level'] ?>">
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col">
                                        <label for="message-text" class="col-form-label">Role</label>
                                        <select name="role" class="form-control">
                                            <option value="">Select Role</option>
                                            <?php foreach ($roles as $role) : ?>
                                                <option value="<?= $role['roles_id'] ?>" <?= $user['role_id'] == $role['roles_id'] ? 'selected="true"' : ''; ?>><?= $role['name'] ?> </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <!-- Modal Edit End -->

    <!-- Delete Modal -->
    <div class="modal fade" id="confirmation-dialog" tabindex="-1" role="dialog" aria-labelledby="modal-top" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-body confirmation-dialog-notice"> Do you want to continue?</div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-shadow btn-confirmation-dialog-yes" data-dismiss="modal" data-url="javascript:;">
                        <i class="fa fa-trash m-r-5"></i> Yes
                    </button>
                    <button type="button" class="btn btn-secondary" id="" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Delete Modal -->
</div>
</div>