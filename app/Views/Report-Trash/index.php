<!-- Begin Page Content -->
<div class="container-fluid employee-attendance-data-summary">
    <!-- Page Heading -->
    <div class="row mb-2">
        <div class="col-4"></div>
        <div class="col-4">
        <?php if($start != $end){?>
                <p class="text-center font-weight-bold"> Date : <?= $start ?> - <?= $end ?></p>
            <?php }
            elseif($start == $end){?>
             <p class="text-center font-weight-bold"> Date : <?= $start ?></p>
            <?php }?>
        </div>
        <div class="col-4">
        <button class="btn btn-sm btn-primary data-daterangepicker float-right">&nbsp; <i class="fas fa-calendar-alt mr-2"></i> Date &nbsp;</button>
          
    </div>
       
    </div>

    <!-- DataTales Example -->
    <div class="section-body section-emp-summary">
        <div class="row">
            <div class="col"></div>
            <div class="col-12">
                <div class="card shadow mb-4">
                <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Report Data</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                        <div class="col-6">
                            <div class="btn-group group-action-area ">
                                <!-- <button class="btn btn-sm btn-primary data-daterangepicker">&nbsp; <i class="fas fa-calendar-alt mr-2"></i>Last 7 Days &nbsp;</button> -->
                                <!-- <button class="btn btn-primary  btn-print-summary"> <i class="fas fa-fw fa-print"></i> </button>
                                <button class="btn btn-success btn-export"><i class="fas fa-fw fa-file-csv"></i> Export CSV</button>
                                -->
                            </div>
                        </div>
                            <div class="col-2"> </div>
                            <div class="col-4">
                                <div class="input-group">

                                    <input type="text" id="searchbox" class="form-control" placeholder="Search by Report Transaction">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-search text-primary"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" width="100%" cellspacing="0" id="dataTable">
                                <thead>
                                    <tr>
                                        <!-- <th></th> -->
                                        <!-- <th width="10px" class="pr-4 pl-0">
                                            <div class="custom-control custom-checkbox table-checkbox">
                                                <input type="checkbox" class="chkboxes check check-all" value="1" data-name="Master Admin" id="table-chk-all">
                                            </div>
                                        </th> -->
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
                                        <?php if($_SESSION['role_id'] == '2'){ ?>
                                            <th width="5px">Action</th>
                                        <?php } ?>
                                        <!-- <th>Out Duration</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php foreach ($report as $u) : ?>
                                            <tr>
                                            <!-- <td class="pr-4 pl-0">
                                                <div class="custom-control custom-checkbox table-checkbox">
                                                    <input type="checkbox" class="chkboxes check check-data" name="checkbox" value="<?= $u['transaksi_id'] ?>" data-name="<?= $u['vehicle'] ?>">
                                                </div>
                                              </td>   -->
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
                                            <?php if($_SESSION['role_id'] == '2'){ ?>
                                            <td> <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEdit<?= $u['transaksi_id']; ?>" style="margin:auto; display:block;" title="Detail Data">
                                                    <i class="fas fa-marker"></i>
                                                </button>
                                            </td>
                                            <?php } ?>
                                            </tr>
                                        <?php endforeach ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <iframe id="print-summary-report" hidden></iframe>
    <?php if($_SESSION['role_id'] == '2'){ ?>
         <!-- Modal Edit Employee -->
         <?php foreach ($report as $u) : ?>
        <div class="modal fade" id="modalEdit<?= $u['transaksi_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title" id="exampleModalLongTitle">Delete Schedule</h5> -->

                        <h6 class="modal-title font-weight-bold text-primary"> Detail Transaksi</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item "><p class="text-center font-weight-bold"><small> No Vehicle </small> : <?= $u['vehicle']; ?></p> </li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Company  </small> : <?= $u['company']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Address </small> : <?= $u['address']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Driver </small> : <?= $u['driver']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> No Identitas </small> : <?= $u['no_ktp']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Jenis Vehicle </small> : <?= $u['jenis_vcl']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Material </small> : <?= $u['material']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Weight IN </small> : <?= $u['weight_in']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Weight OUT </small> : <?= $u['weight_out']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Weight Nett </small> : <?= $u['nett_weight']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Time IN </small> : <?= $u['date_in']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Time OUt </small> : <?= $u['date_out']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Volume Ton</small> : <?= $u['vol_ton']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Volume M3 </small> : <?= $u['vol_kubik']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Total Ton</small> : <?= $u['total_ton']; ?></p></li>
                            <li class="list-group-item"><p class="text-center font-weight-bold"><small> Total M3 </small> : <?= $u['total_kubik']; ?></p></li>
                         </ul>
                        </div>
                        <div class=" modal-footer">
                
                                <div class="col">
                                   
                                </div>
                                <div class="col">
                                    <button class="btn btn-sm btn-danger button-center" id="<?= $u['transaksi_id']; ?>"  style="margin:auto; display:block;" title="Restore Data">
                                        <i class="fas fa-undo-alt"> Restore</i>
                                    </button>
                                     
                                </div>
                                <div class="col">
                                    
                                </div>
                                
                        </div>
                </div>
            </div>
        </div>
    
    <?php endforeach ?>
    <?php } ?>
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
</div>
<!-- End of Main Content -->
<script>
    var base_url = '<?php echo base_url(); ?>'; 
    var startDate = '<?php echo date('Y-m-d',strtotime($start)) ?>';
    var endDate = '<?php echo date('Y-m-d',strtotime($end)); ?>';
    </script>

