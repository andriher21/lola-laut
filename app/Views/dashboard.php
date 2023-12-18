<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col"></div>
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Transaction</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count['transaction'][0]->transaksi ?> </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Customer</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count['company'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas  fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Material
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $count['material'] ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Vehicle
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $count['vehicle'] ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
   
    <div class="row">
        <!-- <div class="col"></div> -->
        <div class="col-md-6">
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="float-left">
                                <h6 class="font-weight-bold text-primary">Last Transaction</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <a href="<?= site_url('dashboard'); ?>" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-sync"></i> Reload</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 table-dashboard" id="dataTable" width="100%" cellspacing="0">
                            <thead style="border-top: 0px;">
                                <tr>
                                    <th >Vehicle</th>
                                    <th width="150px">Material</th>
                                    <th width="100px">Weight</th>
                                    <th width="150px">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($last_transaction as $last) : ?>
                                    
                                        <tr>
                                           <td><?= $last['vehicle'] ?> </td>
                                           <td><?= $last['material'] ?> </td>
                                           <td class='text-right'><?= number_format( $last['nett_weight'] )?> </td>
                                           <td><?= $last['date_out'] ?></td>
                                        </tr>
                                    
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="float-left">
                                <h6 class="font-weight-bold text-primary">Biggest Transaction </h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <a href="<?= site_url('dashboard'); ?>" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-sync"></i> Reload</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 table-dashboard" id="dataTable" width="100%" cellspacing="0">
                            <thead style="border-top: 0px;">
                                <tr>
                                <tr>
                                    <th width="150px">Vehicle</th>
                                    <th width="150px">Material</th>
                                    <th>Weight</th>
                                    <th width="150px">Date</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach ($weight as $w) : ?>
                                       
                                    <tr>
                                            <td><?= $w['vehicle'] ?> </td>
                                           <td><?= $w['material'] ?> </td>
                                           <td><?= $w['nett_weight'] ?> </td> 
                                           <td><?= $w['date_out'] ?> </td> 
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
    <div class="row">
    <!-- <div class="col"></div> -->
        <div class="col-md-6">
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="float-left">
                                <h6 class="font-weight-bold text-primary">Total Weight of Material To day</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <a href="<?= site_url('dashboard'); ?>" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-sync"></i> Reload</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 table-dashboard" id="dataTable" width="100%" cellspacing="0">
                            <thead style="border-top: 0px;">
                                <tr>
                                    <tr>
                                     <th>No</th>
                                    <th>Material</th>
                                    <th >Weight</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total=0 ;
                                foreach ($material as $last) : ?>
                                  
                                         <tr>
                                            <td><?= ++$total; ?></td>
                                           <td><?= $last['material'] ?> </td>
                                           <td ><?= number_format( $last['sumnett'] )?> </td> 
                                        </tr>
                              
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="float-left">
                                <h6 class="font-weight-bold text-primary">Total Transaction Weight in the last 5 days </h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <a href="<?= site_url('dashboard'); ?>" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-sync"></i> Reload</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive"> 
                        <table class="table table-striped mb-0 table-dashboard" id="dataTable" width="100%" cellspacing="0">
                            <thead style="border-top: 0px;">
                                <tr>
                                <tr>
                            
                                <th>No</th>
                                    <th>Date</th>
                                    <th >Weight</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php $total=0 ;
                                 foreach ($transaction as $t) : ?>
                                       
                                    <tr>

                                           <td><?= ++$total; ?></td>
                                           <td><?= $t['date_out'] ?> </td>
                                           <td ><?= number_format( $t['sumnett'] )?> </td>
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
   
    
        <!-- <div class="col"></div> -->
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content