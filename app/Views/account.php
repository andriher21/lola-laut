<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col"></div>
        <div class="col-5">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-profile rounded-circle" width="60px" src="<?= base_url() ?>/img/undraw_profile.svg">
                    </div>
                    <form method="POST" action="<?= base_url('accountUpdate') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $sess['user_id'] ?>">
                        <div class="form-group">
                            <div class="row ml-2 mr-2">
                                <div class="col-md-12 mb-2">
                                    <label for="message-text" class="col-form-label">Name</label>
                                     <input class="form-control" type="text" name="name" value="<?= $sess['fullname'] ?>" required>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="message-text" class="col-form-label">Username </label>
                                    <input class="form-control" type="text" name="username" value="<?= $sess['username'] ?>" required>
                                </div>
                                <div class="col-md-12 mb-2">
                                        <label for="message-text" class="col-form-label">Password</label>
                                        <input class="form-control" type="password" name="password" placeholder="Leave empty if you won't change it"required>
                                </div>
                            
                                <div class="col-md-12 mt-4">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <div class="col"></div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->