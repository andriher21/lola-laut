<!-- Begin Page Content -->
<style type="text/css">
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 100%;
  max-width: 1000px;
}


/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}
</style>
<div class="container-fluid employee-attendance-data-detail">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-4 ">
            <a href="<?= base_url('attendance/employee/daily/') . $dates; ?>" class="btn btn-sm btn-primary"> <i class="fas fa-chevron-left mr-2"></i> Back &nbsp;</a>
        </div>
        <div class="col-4">
            <p class="text-center font-weight-bold"><?= $active_date ?></p>
        </div>
        <div class="col-4">
            <!-- <a href="<?= base_url('schedule/employee'); ?>" class="btn btn-sm btn-primary float-right"> <i class="fas fa-chevron-left mr-2"></i> Back</a> -->
            <div class="btn-group float-right mr-2">
                <a href="<?= $prev_date_uri ?>" class="btn btn-sm btn-primary float-right"> <i class="fas fa-chevron-left"></i></a>
                <a href="<?= $next_date_uri ?>" class="btn btn-sm btn-primary float-right"> <i class="fas fa-chevron-right"></i></a>


            </div>
            <a href="<?= $today ?>" class="btn btn-sm btn-primary float-right mr-2">&nbsp;Today&nbsp;</a>

        </div>
    </div>
    <!-- DataTales Example -->
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="mb-2">
                            <div class="text-center">
                                <?php foreach ($users as $user) : ?>
                                    <b><?= $user['nama'] ?> <small>/ NIK. <?= $user['pid'] ?></small></b>
                                <?php endforeach ?>
                            </div>

                        </div>


                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Shift</th>
                                        <th>In Time</th>
                                        <th>Out Time</th>
                                        <th>First Scan</th>
                                        <th>Last Scan</th>
                                        <th width="150px">Late Duration</th>
                                        <th width="150px">Out Duration</th>
                                        <th width="150px">In Duration</th>
                                        <th width="150px">Overtime</th>
                                        <!-- <th width="150px">SAP</th> -->
                                        <!-- <th>Out Duration</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($accumulations)) { ?>
                                        <tr>
                                            <td colspan="9" style="text-align:center">No data.</td>
                                        </tr>
                                    <?php } else { ?>
                                        <?php $count = 0;
                                        foreach ($accumulations as $accu) : ?>
                                            <tr>
                                                <td> <?= ++$count; ?>
                                                </td>
                                                <td><?= $accu['tanggal'] ?></td>
                                                <td>Shift <?= $accu['shift'] ?></td>
                                                <td><?= date('H:i:s', strtotime($accu['masuk'])) ?></td>
                                                <td><?= date('H:i:s', strtotime($accu['pulang'])) ?></td>
                                                <td><?= date('H:i:s', strtotime($accu['in_scan'])) ?></td>
                                                <?php if ($accu['out_scan'] == null) { ?>
                                                    <td>-</td>
                                                <?php } else { ?>
                                                    <td><?= date('H:i:s', strtotime($accu['out_scan'])) ?></td>
                                                <?php } ?>

                                                <?php if ($accu['late_duration'] < '00:00:00') { ?>
                                                    <td><span class="badge badge-pill badge-danger">0</span></td>

                                                <?php } else { ?>
                                                    <td><span class="badge badge-pill badge-danger"><?= $accu['late_duration'] ?> </span></td>

                                                <?php } ?>

                                                <?php if ($accu['out_duration'] == null) { ?>
                                                    <td>-</td>
                                                <?php } else { ?>
                                                    <td><span class="badge badge-pill badge-danger"><?= $accu['out_duration'] ?> </span></td>
                                                <?php } ?>
                                                <?php if ($accu['in_duration'] == null) { ?>
                                                    <td>-</td>
                                                <?php } else { ?>
                                                    <td><span class="badge badge-pill badge-primary"><?= $accu['in_duration'] ?> </span></td>
                                                <?php } ?>

                                                <?php if ($accu['over_time'] == null) { ?>
                                                    <td>-</td>
                                                <?php } else { ?>
                                                    <td><span class="badge badge-pill badge-info"><?= $accu['over_time'] ?> </span></td>
                                                <?php } ?>

                                                <!-- <?php if ($accu['flag_sap'] == 1) { ?>
                                                    <td><span class="badge badge-pill badge-warning">NOT YET SENT</span></td>
                                                <?php } else { ?>
                                                    <td><span class="badge badge-pill badge-success">SENT</span></td>
                                                <?php } ?> -->


                                            </tr>
                                        <?php endforeach ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="mb-2">
                            <div class="float-left">
                                <?php foreach ($users as $user) : ?>
                                    <b><?= $user['nama'] ?> <small>/ NIK. <?= $user['pid'] ?></small></b>
                                <?php endforeach ?>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-sm btn-primary btn-print-detail"><i class="fas fa-fw fa-print "></i> Print</button>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <div class="btn-group group-action-area" role="group" aria-label="action-area">
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Scan Time</th>
                                        <th>Gate</th>
                                        <th>Shift</th>
                                        <!-- <th>Scan Time</th> -->
                                        <th width="10px">In/Out</th>
                                        <!-- <th>Out Duration</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($scan_data)) { ?>
                                        <tr>
                                            <td colspan="6" style="text-align:center">No data.</td>
                                        </tr>
                                    <?php } else { ?>
                                        <?php foreach ($scan_data as $sd) : ?>
                                            <tr>
                                                <td class="counterCell ">
                                                </td>


                                                <?php if ($sd['in_scan'] == null) { ?>
                                                    <td><?= date('H:i:s', strtotime($sd['out_scan'])) ?>
                                                        <br>
                                                        <small><?= date('Y-m-d', strtotime($sd['out_scan'])) ?></small>
                                                    </td>
                                                    <td><?= $sd['building'] ?></td>
                                                    <td>Shift <?= $sd['shift'] ?></td>
                                                    <td><span class="badge badge-pill badge-danger"><?= $sd['user_status'] ?></span></td>
                                                <?php } else if ($sd['out_scan'] == null) { ?>
                                                    <td><?= date('H:i:s', strtotime($sd['in_scan'])) ?>
                                                        <br>
                                                        <small><?= date('Y-m-d', strtotime($sd['in_scan'])) ?></small>
                                                    </td>
                                                    <td><?= $sd['building'] ?></td>
                                                    <td>Shift <?= $sd['shift'] ?></td>
                                                    <td><span class="badge badge-pill badge-success"><?= $sd['user_status'] ?></span></td>

                                                <?php } ?>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <b class="text-primary">Photos </b>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Scan Time</th>
                                        <th>Image</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($photos)) { ?>
                                        <tr>
                                            <td colspan="6" style="text-align:center">No data.</td>
                                        </tr>
                                    <?php } else { ?>
                                        <?php $count = 0; 
                                        foreach ($photos as $photo) : ?>
                                            <tr>
                                                <!-- <td><?= $photo['id']?></td> -->
                                                <td> <?= ++$count;?>
                                                </td>
                                                <td><?= date('H:i:s', strtotime($photo['in_scan'])) ?>
                                                    <br>
                                                    <small><?= date('Y-m-d', strtotime($photo['in_scan'])) ?></small>
                                                </td>
                                                <td><img class="img img-thumbnail" id="img_cam<?= $photo['id']?>" style="width:100%;max-width:150px" src="<?= base_url('uploads/cam-photo/') . $photo['id'] . '.jpeg' ?>" onclick="javascript:trigger('img_cam<?= $photo['id']?>');"></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php } ?>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <iframe id="print-detail-report" hidden></iframe>
    <div id="myModal" class="modal">
      <span class="close">&times;</span>
      <img class="modal-content" id="img01">
      <div id="caption"></div>
    </div>
    

</div>
</div>
<!-- End of Main Content -->

<script>
    var id = '<?= $id ?>';
    var activeDate = '<?= $dates ?>';
</script>

<script type="text/javascript">
    // var img = document.getElementById("img_cam");
    // var modal = document.getElementById("myModal")
    // var modalImg = document.getElementById("img01");
    // img.onclick = function(){
    //   modal.style.display = "block";
    //   modalImg.src = this.src;
    //   // captionText.innerHTML = this.alt;
    // }

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    //var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    /*
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }

    */

    function trigger(var1)
    {
     modal.style.display = "block";
      modalImg.src = document.getElementById(var1).src;
      // captionText.innerHTML = document.getElementById(var1).alt;

    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
      modal.style.display = "none";
    }
</script>