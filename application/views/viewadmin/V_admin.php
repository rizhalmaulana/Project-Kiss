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
            <!-- <?php if($user['intRoleId'] != "2" && $user['intRoleId'] != "3") : ?>
              <div class="d-flex">
                <button class="btn btn-primary btn-round ml-auto mb-3" data-toggle="modal" data-target="#addRowModal">
                  <i class="fa fa-plus"></i>
                  Tambah
                </button>
              </div>
            <?php endif; ?> -->
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content fadeInLeft animated">
    <div class="container-fluid">
      <div class="row">
        <?php
        foreach ($portaldept as $head) { ?>
          <div class="col-12 col-sm-6 col-md-2">
            <a href="<?= base_url() ?><?= $head->texturlDepartemen; ?>" type="button" class="text-dark">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><img src="<?= $head->textLogoDept; ?>" style="width: 60px; height: 60px;" class="img-circle" alt="Image"></span>
                <div class="info-box-content">
                  <span class="info-box-number" style="font-size: 14px;"><?= $head->textNamaDept; ?></span>
                  <span class="info-box-text" style="font-size: 12px;">
                    <small><?= $head->dtmCreated; ?></small>
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