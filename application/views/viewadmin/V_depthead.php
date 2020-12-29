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
            <li class="breadcrumb-item active"><a href="<?=base_url()?>c_admin/depthead"><?= $dashboard; ?></a></li>
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
              <?= $this->session->flashdata('messagedeletedept'); ?>
              <table class="table table-bordered table-hover">
                <thead>
                  <tr class="text-center">
                    <th>NIK</th>
                    <th>Dept Head</th>
                    <th>Departemen</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $num_char = 100;
                  foreach ($data->result() as $dept) { ?>
                    <tr class="text-center">
                      <td><?= $dept->textNik; ?></td>
                      <td><?= $dept->textDeptHead; ?></td>
                      <td><?= $dept->textNamaDept; ?></td>
                      <td><?= $dept->dtmCreated; ?></td>
                      <td>
                        <div class="col-md-12 text-white">
                          <a class="submit btn btn-danger" href="<?=base_url()?><?="c_admin/hapus_depthead/" . $dept->intNo; ?>">
                            Hapus
                          </a>
                        </div>
                      </td>
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
        <?= $this->session->flashdata('messagedepthead'); ?>
        <form action="<?=base_url()?>c_admin/insert_depthead" method="POST">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Form Registrasi DeptHead</h3>
                </div>
                <br>
                <div class="card-body">

                  <div class="form-group">
                    <label>NIK Pegawai</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-sort-numeric-down-alt"></i></span>
                      </div>
                      <input type="text" name="textNikHead" class="form-control" autocomplete="off"
                      data-mask>
                    </div>
                    <?= form_error('textNikHead', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>

                  <div class="form-group">
                    <label>Nama Pegawai</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                      </div>
                      <input type="text" name="textNamaHead" class="form-control" autocomplete="off"
                      data-mask>
                    </div>
                    <?= form_error('textNamaHead', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>

                  <div class="form-group">
                    <label>Pilih Departemen</label>
                    <select class="form-control select2" style="width: 100%;" name="selectRoleHead">
                      <option selected="selected" value="Engineering">1. Engineering</option>
                      <option value="FA & IT">2. FA & IT</option>
                      <option value="HR & GA">3. HR & GA</option>
                      <option value="IOS">4. IOS</option>
                      <option value="MDP">5. MDP</option>
                      <option value="Production1">6. Production</option>
                      <option value="Quality Assurance">7. Quality Assurance</option>
                      <option value="Warehouse1">8. Warehouse</option>
                      <option value="Order">9. Order</option>
                      <option value="Incoming">10. Incoming</option>
                      <option value="WH Preparation">11. WH Preparation</option>
                      <option value="Quality  Inspection">12. Quality Inspection</option>
                      <option value="Production2">13. Production</option>
                      <option value="Warehouse2">14. Warehouse</option>
                      <option value="Sales">15. Sales</option>
                      <option value="Operation">16. Operation</option>
                      <option value="Performance">17. Performance</option>
                      <option value="Quality">18. Quality</option>
                      <option value="Common">19. Common</option>
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