<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 fadeInRight animated">
                <div class="col-sm-6">
                    <h3 class="breadcrumb"><?= $headline; ?></h3>
                    <small class="breadcrumb"><?= $keterangan;?></small>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>c_admin">Dashboard</a></li>
                    </ol>
                </div>
            </div>
            <?php if($user['intRoleId'] != "2" && $user['intRoleId'] != "3") : ?>
            <div class="d-flex fadeInRight animated">
                <button class="btn btn-primary btn-round ml-auto mb-3" data-toggle="modal" data-target="#addRowModal">
                    <i class="fa fa-plus"></i>
                    Tambah
                </button>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class="modal-title">
                        <span class="fw-mediumbold">
                            Buat Sub Departemen
                        </span>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" action="<?=base_url()?>c_admin/insert_subbusiness" method="POST"
                        enctype="multipart/form-data" role="form">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Nama Sub Departemen</label>
                                    <input id="addSubDept" type="text" class="form-control" name="textSubDept"
                                        placeholder="Contoh: Engineering">
                                </div>
                                <?= form_error('textSubDept', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label>Gambar URL Link</label>
                                    <input id="addUrlLink" type="link" class="form-control" name="textUrlLink">
                                </div>
                                <?= form_error('textUrlLink', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" id="addRowButton" class="btn btn-primary">Tambah</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <section class="content fadeInLeft animated">
        <div class="container-fluid">
            <div class="row">
                <?php
            foreach ($masterdepartemen as $departemen) { ?>
                <div class="col-12 col-sm-6 col-md-2">
                    <a href="<?= base_url() ?>c_departemen/subdepartemen/<?=$departemen->intNo; ?>" type="button"
                        class="text-dark">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><img src="<?= $departemen->textLogoDept; ?>"
                                    style="width: 60px; height: 60px;" class="img-circle" alt="User Image"></span>
                            <div class="info-box-content">
                                <span class="info-box-number"
                                    style="font-size: 12px;"><?= $departemen->textNamaDept; ?></span>
                                <span class="info-box-text"
                                    style="font-size: 12px;"><small><?= $departemen->dtmCreated; ?></small>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>

            </div>
        </div>
    </section>
</div>