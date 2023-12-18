<!-- Begin Page Content -->
<div class="container-fluid employee-data">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800">Employee Manager</h1> -->
    <form name="form-import" enctype="multipart/form-data" style="display: none;">
        <input id="import" type="file" name="file" accept=".csv">
    </form>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="float-left">
            <h6 class="m-0 font-weight-bold text-primary">Driver Data</h6>
            </div>
            <?php if ($_SESSION['role_id']=='4'){ ?>
                    <div class="float-right">
                            <a class="btn btn-sm btn-danger btn-sync"><i class="fas fa-fw fa-sync"></i>&nbsp;Sync Cloud X</a>
                    </div>    
         <?php
        }?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="btn-group group-action-area">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalCenter"><i class="fas fa-fw fa-plus-circle"></i> &nbsp;New</button>
                        <button type="button" class="btn btn-sm btn-success btn-import"><i class="fas fa-fw fa-upload"></i> &nbsp;Import From CSV</button>
                        <!-- <a href="<?= base_url('uploads/template/Employee Import Format - User Management.csv') ?>" class="btn btn-sm btn-info"><i class="fas fa-fw fa-download"></i> &nbsp;Import Format</a> -->

                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-3">
                        <input type="text" id="searchbox" class="form-control" placeholder="Search by Driver name">
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
                            <th>NIK</th>
                            <th>Address</th>
                            <th width="5px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0;
                        foreach ($driver as $u) : ?>
                            <tr>
                                <td class="pr-4 pl-0">
                                    <div class="custom-control custom-checkbox table-checkbox">
                                        <input type="checkbox" class="chkboxes check check-data" name="checkbox" value="<?= $u['driver_id'] ?>" data-name="<?= $u['driver_name'] ?>">
                                    </div>
                                </td>
                                <td><?= $u['driver_name']; ?></td>
                                <td><?= $u['driver_nik']; ?></td>
                                <td><?= $u['driver_address']; ?></td>

                                <td>
                                    <?php if($_SESSION['role_id'] == '1'|| $_SESSION['role_id'] == '4'){ ?>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEdit<?= $u['driver_id']; ?>" style="margin:auto; display:block;">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    <?php }
                                    elseif($_SESSION['role_id'] == '2'){ ?>
                                        <button class="btn btn-sm btn-danger restore-token" id="<?= $u['driver_id']; ?>" style="margin:auto; display:block;" title="Restore Data">
                                            <i class="fas fa-undo-alt"></i>
                                        </button>
                                    <?php }?>
                                </td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Plant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="<?= base_url('adddriver') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Name<small class="text-danger"><u>*</u></small></label>
                                    <input class="form-control" type="text" name="name" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">NIK<small class="text-danger"><u>*</u></small></label>
                                    <input class="form-control" type="text" name="nik" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Address<small class="text-danger"><u>*</u></small></label>
                                    <input class="form-control" type="text" name="address" required>
                                </div>
                               
                            </div>
                        </div>

                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Employee -->
    <?php foreach ($driver as $u) : ?>
        <div class="modal fade" id="modalEdit<?= $u['driver_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title" id="exampleModalLongTitle">Delete Schedule</h5> -->

                        <h6 class="modal-title font-weight-bold text-primary"> Manage Driver</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="<?= base_url('editdriver') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $u['driver_id'] ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">Name</label>
                                        <input type="text" value="<?= $u['driver_name'] ?>" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">NIK</label>
                                        <input type="text" value="<?= $u['driver_nik'] ?>" class="form-control" name="nik">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">Address</label>
                                        <input type="text" value="<?= $u['driver_address'] ?>" class="form-control" name="address">
                                    </div>
                                </div>
                                
                               
                               
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary"> <i class="fas fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>

    <!-- Modal Import -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Import Driver</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="import" method="post">
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class=" text-center">#</th>
                                    <!-- <th>No</th> -->
                                    <th>Name</th>
                                    <th>Nik</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody class="body-import-result">
                                <tr>
                                    <td colspan="6">Data not found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onClick="doImport();"> <i class="fas fa-save"></i> Save</button>
                        <!-- <button type="button" class="btn btn-primary btn-save"> <i class="fas fa-save"></i> Save</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="confirmation-dialog" tabindex="-1" role="dialog" aria-labelledby="modal-top" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-body confirmation-dialog-notice"> Do you want to continue?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-shadow btn-confirmation-dialog-yes" data-dismiss="modal" data-url="javascript:;">
                        <i class="fa fa-trash m-r-5"></i> Yes
                    </button>
                    <button type="button" class="btn btn-secondary" id="" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Delete Modal -->
</div>
<!-- End of Main Content -->