<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-6">
            <p class="h4 font-weight-bold text-primary text-center mt-5"> <i class="fab fa-envira"></i> &nbsp; REGIOS</p>
            <div class="card card-primary o-hidden border-0 shadow-lg my-5">

                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                            <div class="text-center">
                                    <!-- <h1 class="h4 text-gray-900 mb-4">Login Admin</h1> -->
                                    <?= session('message');  ?>
                                </div>
                                <form class="user" method="POST" action="<?= base_url('/login'); ?> ">
                                    <div class="form-group">
                                        <label class="small">Username</label>
                                        <input type="text" class="form-control form-control-user" id="username" name="username" >
                                       
                                    </div>
                                    <div class="form-group">
                                        <label class="small">Password</label>
                                        <input type="password" class="form-control form-control-user" id="password" name="password">
                                     
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>