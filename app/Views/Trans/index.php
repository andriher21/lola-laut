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
            <h6 class="m-0 font-weight-bold text-primary">Trans Data</h6>
            </div>
            <?php if ($_SESSION['role_id']=='4'){ ?>
                <div class="float-right">
                        <a class="btn btn-sm btn-danger btn-sync"><i class="fas fa-fw fa-sync" title="Sycnronitation Cloud X"></i>&nbsp;Sync Cloud X</a>
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
                        <input type="text" id="searchbox" class="form-control" placeholder="Search by Trans name">
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
                            <th>Vehicle</th>
                            <th>Owner</th>
                            <th>Company</th>
                            <th>Type Vehicle</th>
                            <th>Material</th>
                            <th>Panjang</th>
                            <th>Lebar</th>
                            <th>Tinggi</th>
                            <th>Volume</th>
                            <th>Over Weight</th>
                            <th width="5px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0;
                        foreach ($trans as $u) : ?>
                            <tr>
                                <td class="pr-4 pl-0">
                                    <div class="custom-control custom-checkbox table-checkbox">
                                        <input type="checkbox" class="chkboxes check check-data" name="checkbox" value="<?= $u['trans_id'] ?>" data-name="<?= $u['trans_vehicle'] ?>">
                                    </div>
                                </td>
                                <td><?= $u['trans_vehicle']; ?></td>
                                <td><?= $u['trans_owner']; ?></td>
                                <td><?= $u['trans_company']; ?></td>
                                <td><?= $u['trans_type_vcl']; ?></td>
                                <td><?= $u['trans_material']; ?></td>
                                <td><?= $u['trans_long_vcl']; ?></td>
                                <td><?= $u['trans_wide_vcl']; ?></td>
                                <td><?= $u['trans_high_vcl']; ?></td>
                                <td><?= $u['trans_volume_vcl']; ?></td>
                                <td><?= $u['trans_overweight']; ?></td>

                                <td>
                                    <?php if($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '4'){ ?>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEdit<?= $u['trans_id']; ?>" style="margin:auto; display:block;">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    <?php }
                                    elseif($_SESSION['role_id'] == '2' ){ ?>
                                        <button class="btn btn-sm btn-danger restore-token" id="<?= $u['trans_id']; ?>" style="margin:auto; display:block;" title="Restore Data">
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Trans</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="<?= base_url('addtrans') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Vehicle<small class="text-danger"><u>*</u></small></label>
                                    <input class="form-control" type="text" name="vehicle" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Owner<small class="text-danger"><u>*</u></small></label>
                                    <input class="form-control" type="text area" name="owner" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Company<small class="text-danger"><u>*</u></small></label>
                                    <input class="form-control" type="text area" name="company" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Type Vehicle</label>
                                        <select name="type_vcl" class="form-control">
                                            <option value="">Select Type Vehicle</option>
                                            <?php foreach ($typevcl as $type) : ?>
                                                <option value="<?= $type['type_vcl'] ?>" ><?= $type['type_vcl']?> </option>
                                            <?php endforeach ?>
                                        </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Material<small class="text-danger"><u>*</u></small></label>
                                    <input class="form-control" type="text area" name="material" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Panjang<small class="text-danger"><u>*</u></small></label>
                                    <input class="form-control" type="text area" name="panjang" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Lebar<small class="text-danger"><u>*</u></small></label>
                                    <input class="form-control" type="text area" name="lebar" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Tinggi<small class="text-danger"><u>*</u></small></label>
                                    <input class="form-control" type="text area" name="tinggi" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Volume<small class="text-danger"><u>*</u></small></label>
                                    <input class="form-control" type="text area" name="volume" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Over Wieght<small class="text-danger"><u>*</u></small></label>
                                    <input class="form-control" type="text area" name="overweight" required>
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
    <?php foreach ($trans as $u) : ?>
        <div class="modal fade" id="modalEdit<?= $u['trans_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title" id="exampleModalLongTitle">Delete Schedule</h5> -->

                        <h6 class="modal-title font-weight-bold text-primary"> Manage Trans</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="<?= base_url('edittrans') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $u['trans_id'] ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">Vehicle</label>
                                        <input type="text" value="<?= $u['trans_vehicle'] ?>" class="form-control" name="vehicle">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">Owner</label>
                                        <input type="textarea" value="<?= $u['trans_owner'] ?>" class="form-control" name="owner">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">Company</label>
                                        <input type="textarea" value="<?= $u['trans_company'] ?>" class="form-control" name="company">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="message-text" class="col-form-label">Type Vehicle</label>
                                        <select name="type_vcl" class="form-control">
                                            <option value="">Select Type Vehicle</option>
                                            <?php foreach ($typevcl as $type) : ?>
                                                <option value="<?= $type['type_vcl'] ?>" <?= $u['trans_type_vcl'] == $type['type_vcl'] ? 'selected="true"' : ''; ?>><?= $type['type_vcl']?> </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">Material</label>
                                        <input type="textarea" value="<?= $u['trans_material'] ?>" class="form-control" name="material">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">Panjang</label>
                                        <input type="textarea" value="<?= $u['trans_long_vcl'] ?>" class="form-control" name="panjang">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">Lebar</label>
                                        <input type="textarea" value="<?= $u['trans_wide_vcl'] ?>" class="form-control" name="lebar">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">Tinggi</label>
                                        <input type="textarea" value="<?= $u['trans_high_vcl'] ?>" class="form-control" name="tinggi">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">Volume </label>
                                        <input type="textarea" value="<?= $u['trans_volume_vcl'] ?>" class="form-control" name="volume">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">Over Weight</label>
                                        <input type="textarea" value="<?= $u['trans_overweight'] ?>" class="form-control" name="overweight">
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
        <div class="modal-dialog modal-dialog-centered modal-lg qms-dialog" role="document">
            <div class="modal-content qms-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Import Trans</h5>
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
                                    <th>Vehicle</th>
                                    <th>Owner</th>
                                    <th>Company</th>
                                    <th>Type Vehicle</th>
                                    <th>Material</th>
                                    <th>Panjang</th>
                                    <th>Lebar</th>
                                    <th>Tinggi</th>
                                    <th>Volume</th>
                                    <!-- <th>Over Weight</th> -->
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