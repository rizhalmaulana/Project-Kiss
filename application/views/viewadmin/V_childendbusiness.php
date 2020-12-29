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
                        <li class="breadcrumb-item active"><a href="<?=base_url()?>c_admin/business"><?= $dashboard; ?></a></li>
                        <?php if($user['intRoleId'] != "2" && $user['intRoleId'] != "3") : ?>
                        <a href="#" type="button" class="btn btn-block bg-primary">Tambah</a>
                        <?php endif; ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content fadeInLeft animated">
        <div class="container-fluid">
            <div class="row">
                <?php
                    foreach ($mastersubend as $end) { ?>
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="<?=$end->textLinkSub; ?>" type="button" class="text-dark">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><img src="<?= $end->textLogoSub; ?>" style="width: 50px; height: 50px;" class="img-circle" alt="User Image"></span>
                            <div class="info-box-content">
                                <span class="info-box-number" style="font-size: 12px;"><?= $end->textNamaSub; ?></span>
                                <span class="info-box-text" style="font-size: 12px;"><small><?= $end->dtmInserted; ?></small>
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