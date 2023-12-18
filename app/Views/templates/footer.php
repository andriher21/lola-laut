<!-- Footer -->
<!-- <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer> -->
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>/js/sb-admin-2.min.js"></script>
<script src="<?= base_url() ?>/js/tempus-dominus.js"></script>
<script src="<?= base_url() ?>/js/moment.js"></script>
<script src="<?= base_url() ?>/js/custom.js"></script>
<script src="<?= base_url() ?>/js/bootstrap-select.min.js"></script>
<script src="<?= base_url() ?>/js/flatpickr.js"></script>
<script src="<?= base_url() ?>/js/theia-sticky-sidebar.min.js"></script>

<script src="<?= base_url() ?>/js/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>/js/moment.min.js"></script>
<script src="<?= base_url() ?>/daterangepicker/daterangepicker.js"></script>


<!-- Page level plugins -->
<script src="<?= base_url() ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>/js/demo/datatables-demo.js"></script>


<?php
if (isset($content_scripts)) {
    foreach ($content_scripts as $path) :

        $path = preg_match('/http/', $path) ? $path : base_url() . $path;
        echo '<script src="' . $path . '"></script>';

    endforeach;
}
?>

<!-- Flatpickr -->
<script>
    config = {
        enableTime: true,
        // noCalendar: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
      
    };
    
    flatpickr("#time", config);
  
  var base_url = '<?php echo base_url(); ?>';  

</script>

</body>

</html>