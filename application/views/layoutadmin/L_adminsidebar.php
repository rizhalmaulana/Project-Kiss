  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="<?=base_url()?>frontend/auth/dist/img/user.jpg" class="img-circle elevation-2"
                      alt="User Image">
              </div>
              <div class="info">
                  <?php $num_char = 20; ?>
                  <a class="d-block"><?= substr($user['textEmployeeName'], 0, $num_char) . '...'; ?></a>
              </div><br>
          </div>

          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- QUERY AKSES -->
                  <?php
                      $role_id = $this->session->userdata('intRoleId');
                      $queryAkses = "SELECT `user_menu`.`intId`,`textMenu`
                                    FROM `user_menu` JOIN `user_access_menu` 
                                    ON `user_menu`.`intId` = `user_access_menu`.`intMenuId`
                                    WHERE `user_access_menu`.`intRoleId` = $role_id"; 
                      $akses = $this->db->query($queryAkses)->result_array();
                    ?>

                  <?php foreach($akses as $m) : ?>

                  <!-- QUERY AKSES -->
                  <?php 
                      $menuId = $m['intId'];
                      $queryMenu = "SELECT `user_sub_menu`.`textUrl` AS `url`, `user_sub_menu`.`textJudul` 
                      AS `judul`, `user_sub_menu`.`textIcon` AS `icon`, `user_sub_menu`.`textClass` 
                      AS `class`, `user_sub_menu`.`textLiClass` AS `liclass`, `user_sub_menu`.`intId` AS `id`  
                      FROM `user_sub_menu` JOIN `user_menu` 
                                    ON `user_sub_menu`.`intMenuId` = `user_menu`.`intId`
                                    WHERE `user_sub_menu`.`intMenuId` = $menuId
                                    AND `user_sub_menu`.`intIs_active` = 1
                                    ";

                      $subMenu = $this->db->query($queryMenu)->result_array(); 
                    ?>

                  <?php foreach($subMenu as $sm) : ?>

                  <?php if ($sm['judul'] != 'Engineering' && $sm['judul'] != 'FA & IT' && $sm['judul'] != 'HR & GA' && 
                            $sm['judul'] != 'IOS' && $sm['judul'] != 'MDP' && $sm['judul'] != 'Production' && 
                            $sm['judul'] != 'Quality Assurance' && $sm['judul'] != 'Warehouse' && $sm['judul'] != 'Sales') : ?>
                  <li class="<?= $sm['liclass']; ?>">
                      <a href="<?= base_url($sm['url']); ?>" class="nav-link <?= $sm['class']; ?>">
                          <i class="<?= $sm['icon']; ?>"></i>
                          <p>
                            <?= $sm['judul']; ?>
                          </p>
                      </a>
                  </li>
                  <?php endif; ?>
                  <?php endforeach; ?>

                  <?php endforeach; ?>




                <!-- <li class="nav-header">DAFTAR DEPARTEMEN</li>
                <?php
                    $role_id = $this->session->userdata('intRoleId');
                    $queryAkses = "SELECT `user_menu`.`intId`,`textMenu`
                                    FROM `user_menu` JOIN `user_access_menu` 
                                    ON `user_menu`.`intId` = `user_access_menu`.`intMenuId`
                                    WHERE `user_access_menu`.`intRoleId` = $role_id
                                    "; 
                    $akses = $this->db->query($queryAkses)->result_array();
                ?>

                <?php foreach($akses as $m) : ?>

                <?php 
                    $menuId = $m['intId'];
                    $queryMenu = "SELECT `user_sub_menu`.`textUrl` AS `url`, `user_sub_menu`.`textJudul` 
                    AS `judul`, `user_sub_menu`.`textIcon` AS `icon`, `user_sub_menu`.`textClass` AS `class`, `user_sub_menu`.`intId` AS `id`  FROM `user_sub_menu` JOIN `user_menu` 
                                    ON `user_sub_menu`.`intMenuId` = `user_menu`.`intId`
                                    WHERE `user_sub_menu`.`intMenuId` = $menuId
                                    AND `user_sub_menu`.`intIs_active` = 1
                                    ";

                    $subMenu = $this->db->query($queryMenu)->result_array(); 
                ?>

                <?php foreach($subMenu as $sm) : ?>

                <?php if ($sm['judul'] != 'Dashboard' && $sm['judul'] != 'Master User' && $sm['judul'] != 'Master Dept Head') : ?>
                <li class="nav-item">
                    <a href="<?= base_url($sm['url']); ?>" class="<?= $sm['class']; ?> nav-link">
                        <i class="<?= $sm['icon']; ?>"></i>
                        <p> <?= $sm['judul']; ?></p>
                    </a>
                </li>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endforeach; ?> -->

                <li class="nav-header">LAINNYA</li>
                <!-- <li class="nav-item has-treeview menu-open">
                    <a href="<?= base_url() ?>c_admin/setting" class="nav-link">
                        <i class="fas fa-user-cog"></i>
                        <p>Pengaturan</p>
                    </a>
                </li> -->
                <li class="nav-item has-treeview menu-open">
                    <a href="<?= base_url() ?>c_auth/keluar" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Keluar</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>