<div class="content-wrapper">
    <br>
    <section class="content">
        <div class="container-fluid">
            <div class="row fadeInLeft animated">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?=base_url()?>frontend/auth/dist/img/user.jpg" 
                                alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><?= $textEmployeeName; ?></h3>
                            <p class="text-muted text-center"><?= $textDeptName; ?></p>
                        </div>
                        <div class="card-body card-outline">
                            <form action="<?=base_url()?>c_admin/update_user" method="POST">
                            <?= $this->session->flashdata('messageedit'); ?>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="intId" value="<?= $intId; ?>"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">NIK</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="textNikEdit" value="<?= $textNik; ?>" autocomplete="off">
                                        <?= form_error('textNikEdit', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="textNamaEdit" value="<?= $textEmployeeName; ?>" autocomplete="off">
                                        <?= form_error('textNamaEdit', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Departemen</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="textDept" value="<?= $textDeptName; ?>" autocomplete="off">
                                        <?= form_error('textDept', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Sub Departemen</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="textSubDept" value="<?= $textSubName; ?>" autocomplete="off">
                                        <?= form_error('textSubDept', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Role Pegawai</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="selectRole">
                                            <option value="null">-- Silahkan Pilih Dibawah Ini -- </option>
                                            <option value="SA">1. Super Admin</option>
                                            <option value="DH">2. Dept Head</option>
                                            <option value="User">3. User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Status Akun</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="isActive">
                                            <option selected="selected" value="null">-- Silahkan Pilih Dibawah Ini -- </option>
                                            <option value="aktif">1. Aktif</option>
                                            <option value="nonaktif">2. Non-Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary form-control">Ubah</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>