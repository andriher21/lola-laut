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
            <h6 class="m-0 font-weight-bold text-primary">Client Log</h6>
        </div>
        <div class="card-body">
        <div class="row">
                <div class="col-6">
                   
                </div>
                <div class="col-6">
                    <div class="input-group mb-3">
                        <input type="text" id="searchbox" class="form-control" placeholder="Search by Client Log">
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
                        
                            <!-- <th width="10px" class="pr-4 pl-0">
                                <div class="custom-control custom-checkbox table-checkbox">
                                    <input type="checkbox" class="chkboxes check check-all" value="1" data-name="Master Admin" id="table-chk-all">
                                </div>
                            </th> -->
                           
                            
                            <th>Token</th>
                            <th>Erore</th>
                            <th>Date</th>
                            <!-- <th width="5px">Status</th> -->
                            <!-- <th width="5px">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0;
                        foreach ($client as $u) : ?>
                            <tr>  
                               
                                <td><?= $u['logapi_token']; ?></td>
                                <td><?= $u['logapi_erore']; ?></td>
                                <td><?= $u['logapicreate']; ?></td>
                                

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- End of Main Content -->