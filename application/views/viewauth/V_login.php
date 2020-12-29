<div class="login-box fadeInDown animated">
        <div class="card">
            <div class="card-body login-card-body">
                <a href="<?= base_url() ?>c_dashboard"><i class="fas fa-arrow-left text-success"></i></a>
                <center><a href="<?= base_url() ?>c_dashboard"><img src="<?= base_url() ?>frontend/img/icon/1.png" alt="logo" ></a></center>
                <center><a href="#"><b class="text-success">Kalbe Morinaga Indonesia <br/> Integrated Smart System</b></a></center>
                <br>

                <?= $this->session->flashdata('messageauth'); ?>
                <form class="user" method="post" action="<?= base_url() . "c_auth/login"; ?>">
                <?= form_error('textNik', '<small class="text-danger pl-3">', '</small>'); ?>
                    <div class="input-group mb-3">
                        <input type="text" name="textNik" class="form-control" placeholder="Masukkan Nik Kamu..." autocomplete="off" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <div class="col-12">
                            <button type="submit" name="login" value="Log In"
                                class="btn btn-success btn-block">Masuk</button>
                        </div>
                    </div>
                </form>
                <br/>
                <br/>
                <br/>
            </div>
        </div>
    </div>
<!-- /.login-box -->

