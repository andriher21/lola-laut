<!-- Begin Page Content -->
<div class="container-fluid employee-attendance-data">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800">Employee Manager</h1> -->

    <!-- DataTales Example -->
    <div class="row mb-2">
        <div class="col-4"></div>
        <div class="col-4">
            <p class="text-center font-weight-bold"><?= $active_date ?></p>
        </div>
        <div class="col-4">
            <button type="button" class="btn btn-sm btn-primary mb-3 data-datepicker float-right"><i class="fas fa-fw fa-calendar-alt"></i></button>
            <!-- <div class="date"></div> -->
            <div class="btn-group float-right mr-2">
                <a href="<?= $prev_date_uri ?>" class="btn btn-sm btn-primary float-right"> <i class="fas fa-chevron-left"></i></a>
                <a href="<?= $next_date_uri ?>" class="btn btn-sm btn-primary float-right"> <i class="fas fa-chevron-right"></i></a>
            </div>
            <a href="<?= site_url('transaction') ?>" class="btn btn-sm btn-primary float-right mr-2">&nbsp;Today&nbsp;</a>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Transaction Data</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6">
                                <div class="btn-group group-action-area">
                                    <button class="btn btn-primary btn-print-report"><i class="fas fa-fw fa-print"></i></button>
                                    <button class="btn btn-success btn-export"><i class="fas fa-fw fa-file-csv"></i> Export CSV</button>
                                </div>
                            </div>
                            <div class="col-2">
                                <form action="<?= site_url('transaction/filter/') . $dates; ?>" method="POST" enctype="multipart/form-data" class="form-filter">
                                    <div class="input-group">
                                        <!-- <div class="input-group-append">
                                            <button class="input-group-text"><i class="fas fa-filter text-primary"></i></button>
                                        </div> -->
                                        <!-- <?php //if (!empty($this->request->getpost('shift_filter'))) { ?> -->
                                            <!-- <div class="input-group-append">
                                                <a href="<?= site_url('transaction/daily/') . $dates ?>" class="input-group-text bg-danger"><i class="fas fa-sync text-white"></i></a>
                                            </div> -->
                                        <!-- <?php //} ?> -->
                                    </div>
                                </form>
                            </div>
                            <div class="col-4">
                                <div class="input-group">

                                    <input type="text" id="searchbox" class="form-control" placeholder="Search by transaction">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-search text-primary"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-attendance" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    <th width="10px" class="pr-4 pl-0">
                                         <div class="custom-control custom-checkbox table-checkbox">
                                             <input type="checkbox" class="chkboxes check check-all" value="1" data-name="Master Admin" id="table-chk-all">
                                      </div>
                                     </th>
                                        <th width="5px">No</th>
                                        <!-- <th >Jenis </th> -->
                                        <th>No Vehicle</th>
                                        <th>Company</th>
                                        <th>Driver</th>
                                        <th>Jenis Vehicle </th>
                                        <th>Material </th>
                                        <th>Weight IN </th>
                                        <th>Weight OUT </th>
                                        <th>Weight Nett </th>
                                        <th>Time In </th>
                                        <th>Time OUT </th>
                                        <th>Volume Ton</th>
                                        <th>Volume M3</th>
                                        <th>Total Ton</th>
                                        <th>Total M3 </th>
                                        <th width="5px">Action</th>
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    foreach ($user as $u) : ?>
                                        <tr>
                                        <td class="pr-4 pl-0">
                                            <div class="custom-control custom-checkbox table-checkbox">
                                                <input type="checkbox" class="chkboxes check check-data" name="checkbox" value="<?= $u['transaksi_id'] ?>" data-name="<?= $u['vehicle'] ?>">
                                            </div>
                                        </td>    
                                        <td><?= ++$total; ?></td>
                                            <!-- <td><?= $u['jenis_transaksi']; ?></td> -->
                                            <td><?= $u['vehicle']; ?></td>
                                            <td><?= $u['company']; ?></td>
                                            <td><?= $u['driver']; ?></td>
                                            <td><?= $u['jenis_vcl']; ?></td>
                                            <td><?= $u['material']; ?></td>
                                            <td class='text-right' ><?= number_format($u['weight_in']); ?></td>
                                            <td class='text-right'><?= number_format($u['weight_out']); ?></td>
                                            <td class='text-right'><?= number_format($u['nett_weight']); ?></td>
                                            <td><?= $u['date_in']; ?></td>
                                            <td><?= $u['date_out']; ?></td>
                                            <td><?= $u['vol_ton']; ?></td>
                                            <td><?= $u['vol_kubik']; ?></td>
                                            <td><?= $u['total_ton']; ?></td>
                                            <td><?= $u['total_kubik']; ?></td>
                                        <td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEdit<?= $u['transaksi_id']; ?>" style="margin:auto; display:block;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <iframe id="print-employee-report" hidden></iframe>
     <!-- Modal Edit Employee -->
     <?php foreach ($user as $u) : ?>
        <div class="modal fade" id="modalEdit<?= $u['transaksi_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title" id="exampleModalLongTitle">Delete Schedule</h5> -->

                        <h6 class="modal-title font-weight-bold text-primary"> Manage Transaksi</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="<?= base_url('edittransaksi') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $u['transaksi_id'] ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row mb-2">

                                    <div class="col">
                                        <label class="col-form-label font-weight-bold text-dark">Material</label>
                                        <input type="text" value="<?= $u['material'] ?>" class="form-control" name="material">
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
<script>
    var activeDate = '<?= $dates ?>'; // coba bikin pake ajax
</script>