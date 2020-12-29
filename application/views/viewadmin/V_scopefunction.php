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
    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header border-0">
            <h3 class="modal-title">
              <span class="fw-mediumbold">
                Create New Quiz
              </span> 
            </h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="small">Create a new row using this form, make sure you fill them all</p>
            <form role="form">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group form-group-default">
                    <label>Judul</label>
                    <input id="addName" type="text" class="form-control" placeholder="Masukan Judul Quiz">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group form-group-default">
                    <label>Pertanyaan</label>
                    <input id="addPosition" type="text" class="form-control" placeholder="Masukan Pertanyaan">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group form-group-default">
                    <label>Pilihan 1 (A)</label>
                    <input id="addOffice" type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group form-group-default">
                    <label>Pilihan 2 (B)</label>
                    <input id="addOffice" type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group form-group-default">
                    <label>Pilihan 3 (C)</label>
                    <input id="addOffice" type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group form-group-default">
                    <label>Pilihan 4 (D)</label>
                    <input id="addOffice" type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group form-group-default">
                    <label>Pilihan 4 (D)</label>
                    <input id="addOffice" type="text" class="form-control" placeholder="">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group form-group-default">
                    <label for="exampleFormControlSelect1">Status</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                      <option>-</option>
                      <option>Active</option>
                      <option>Deactive</option>
                    </select>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer border-0">
            <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> 
    <section class="content fadeInLeft animated">
        <div class="container-fluid">
            <div class="row">
                <?php foreach ($masterscope as $scope) { ?>
                    <div class="col-12 col-sm-6 col-md-2">
                        <a href="<?= base_url() ?>c_scope/subscope/<?=$scope->intNo; ?>" type="button" class="text-dark">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><img src="<?= $scope->textLogoDept; ?>"
                                    style="width: 60px; height: 60px;" class="img-circle" alt="User Image"></span>
                                <div class="info-box-content">
                                    <span class="info-box-number" style="font-size: 12px;"><?= $scope->textNamaDept; ?></span>
                                    <span class="info-box-text" style="font-size: 12px;"><small><?= $scope->dtmCreated; ?></small>
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