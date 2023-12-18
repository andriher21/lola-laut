<!-- Begin Page Content -->
<div class="container-fluid customer-data">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800">Employee Manager</h1> -->
    
    <form name="form-import" enctype="multipart/form-data" style="display: none;">
        
        <input id="import" type="file" name="file" accept=".csv">
    </form>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Client Data</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="btn-group group-action-area">
                        
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalCenter"><i class="fas fa-fw fa-plus-circle"></i> &nbsp;New</button>
                        <!-- <button type="button" class="btn btn-sm btn-success btn-import"><i class="fas fa-fw fa-upload"></i> &nbsp;Import From CSV</button> -->
                        <!-- <a href="<?= base_url('uploads/template/Employee Import Format - User Management.csv') ?>" class="btn btn-sm btn-info"><i class="fas fa-fw fa-download"></i> &nbsp;Import Format</a> -->
                        
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-3">
                        <input type="text" id="searchbox" class="form-control" placeholder="Search by Client name">
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
                            <th>Token</th>
                            <th width="5px">Status</th>
                            <!-- <th width="5px">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0;
                        foreach ($client as $u) : ?>
                            <tr>  
                                <td class="pr-4 pl-0">
                                    <div class="custom-control custom-checkbox table-checkbox">
                                        <input type="checkbox" class="chkboxes check check-data" name="checkbox" value="<?= $u['clientid'] ?>" data-name="<?= $u['clientname'] ?>">
                                    </div>
                                </td>
                                
                                <td><?= $u['clientname']; ?></td>
                                <td><?= $u['clientnumb']; ?></td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="whitelist" class="custom-control-input toggle-status" id="customSwitch<?= $u['clientid'] ?>" data-id="<?= $u['clientid'] ?>" <?= $u['whitelist'] == '1' ? 'checked="true"' : ''; ?>>
                                        <label class="custom-control-label" for="customSwitch<?= $u['clientid'] ?>"></label>
                                    </div>
                                </td>
                                <!-- <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEdit<?= $u['clientid']; ?>" style="margin:auto; display:block;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td> -->

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
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="<?= base_url('addclient') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                            
                                <div class="col-md-12">
                                    <label for="message-text" class="col-form-label">Name Client<small class="text-danger"><u>*</u></small></label>
                                    <input class="form-control" type="text" name="name" required>
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
    <?php foreach ($client as $u) : ?>
        <div class="modal fade" id="modalEdit<?= $u['clientid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title" id="exampleModalLongTitle">Delete Schedule</h5> -->

                        <h6 class="modal-title font-weight-bold text-primary"> Manage Client</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="<?= base_url('client/edit') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $u['clientid'] ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row mb-2">

                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">Name</label>
                                        <input type="text" value="<?= $u['clientname'] ?>" class="form-control" name="name">
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Import User</h5>
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
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Departement</th>
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
                        <button type="submit" class="btn btn-primary" onclick="doImport()"> <i class="fas fa-save"></i> Save</button>
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