<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 fadeInRight animated">
                <div class="col-sm-6">
                    <h3 class="breadcrumb"><?= $headline; ?></h3>
                    <small class="breadcrumb"><?= $keterangan; ?></small>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>c_admin">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="<?=base_url()?>c_admin/user"><?= $dashboard; ?></a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content fadeInLeft animated">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?= $this->session->flashdata('messagedelete'); ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>NIK</th>
                                        <th>Nama Employee</th>
                                        <th>Departemen</th>
                                        <th>Sub Departemen</th>
                                        <?php if($user['intRoleId'] != "3") : ?>
                                            <th>Aksi</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = 1;
                                    $num_char = 100;
                                    foreach ($data->result() as $datauser) { ?>
                                        <tr class="text-center">
                                            <td><?= $datauser->textNik; ?></td>
                                            <td><?= $datauser->textEmployeeName; ?></td>
                                            <td><?= $datauser->textDeptName; ?></td>
                                            <td><?= $datauser->textSubName; ?></td>
                                            <?php if($user['intRoleId'] != "3") : ?>
                                                <td>
                                                    <div class="col-md-12 text-white">
                                                        <a class="submit btn btn-success"
                                                        href="<?=base_url()?><?="c_admin/edit_user/" . $datauser->intId; ?>">
                                                        Ubah
                                                    </a>
                                                    <a class="submit btn btn-danger"
                                                    href="<?=base_url()?><?="c_admin/hapus_user/" . $datauser->intId; ?>">
                                                    Hapus
                                                </a>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                    <div class="row">
                        <div class="col">
                            <!--Tampilkan pagination-->
                            <?= $pagination; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($user['intRoleId'] != "2" && $user['intRoleId'] != "3") : ?>
        <?= $this->session->flashdata('messageuser'); ?>
        <form action="<?=base_url()?>c_admin/insert_user" method="POST">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Registrasi User</h3>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="form-group">
                                <label>NIK Pegawai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-sort-numeric-down-alt"></i></span>
                                    </div>
                                    <input type="text" name="textNik" class="form-control" autocomplete="off"
                                    data-mask>
                                </div>
                                <?= form_error('textNik', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                    </div>
                                    <input type="text" name="textNama" class="form-control" autocomplete="off"
                                    data-mask>
                                </div>
                                <?= form_error('textNama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label>Asal Departemen</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    </div>
                                    <input type="text" name="textDepartemen" class="form-control" autocomplete="off"
                                    data-mask>
                                </div>
                                <?= form_error('textDepartemen', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label>Sub Departemen</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-building"></i></span>
                                    </div>
                                    <input type="text" name="textAsalDepartemen" class="form-control"
                                    autocomplete="off" data-mask>
                                </div>
                                <?= form_error('textAsalDepartemen', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label>Role Pegawai</label>
                                <select class="form-control select2" style="width: 100%;" name="selectRole">
                                    <option selected="selected" value="SA">1. Super Admin</option>
                                    <option value="DH">2. Dept Head</option>
                                    <option value="User">3. User</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn ripple btn-3d btn-primary form-control">
                                    <div>
                                        <span>Submit</span>
                                    </div>
                                </button>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>
</section>
</div>