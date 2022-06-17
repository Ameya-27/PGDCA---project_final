  <!-- Header START -->
  <?php
    include "db_conn.php";

    //$sql = "SELECT logo_url from system_settings where setting_id=(SELECT MAX(setting_id) from system_settings)";
    //$res = mysqli_query($conn,$sql);
    $query = "SELECT MAX(setting_id) FROM system_settings";
    $res =  mysqli_query($conn, $query);
    if ($res == True) {
        $row = mysqli_fetch_assoc($res);
        $id_max = $row['MAX(setting_id)'];
    }
    $query_1 = "SELECT MAX(setting_id) FROM system_settings WHERE app_name !='' ";
    $res_1 =  mysqli_query($conn, $query_1);
    if ($res_1 == True) {
        $row_1 = mysqli_fetch_assoc($res_1);
        $id_max_not_null = $row_1['MAX(setting_id)'];
    }
    $query_2 = "SELECT logo_url FROM system_settings WHERE setting_id = $id_max ";
    $res_2 =  mysqli_query($conn, $query_2);
    if ($res_2 == True) {
        $row_2 = mysqli_fetch_assoc($res_2);
        $logo = $row_2['logo_url'];
    }
    $query_3 = "SELECT app_name FROM system_settings WHERE setting_id = $id_max_not_null ";
    $res_3 =  mysqli_query($conn, $query_3);
    if ($res_3 == True) {
        $row_3 = mysqli_fetch_assoc($res_3);
        $app = $row_3['app_name'];
    }
    ?>
  <div class="header">
      <div class="logo logo-dark" style="padding-top:10px;padding-left: 40px;padding-right:10px">
          <img src="<?php echo $logo ?>" alt="Logo" style="width: 50px; height: 50px;">
          <img class="logo-fold" src="<?php echo $logo; ?>" alt="Logo" style="width:40px;height:40px;">
          <label id="comp_name"><?php echo strtoupper($app); ?></label>
      </div>
      <!-- logo white
                <div class="logo logo-white">
                    <a href="index.html">
                        <img src="../assets/images/logo/logo-white.png" alt="Logo">
                        <img class="logo-fold" src="../assets/images/logo/logo-fold-white.png" alt="Logo">
                    </a>
                </div>-->
      <div class="nav-wrap">
          <ul class="nav-left">
              <!-- side nav wrap button 
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>-->
              <li class="mobile-toggle">
                  <a href="javascript:void(0);">
                      <i class="anticon"></i>
                  </a>
              </li>
              &nbsp;
              <li>
                  <button id="back-btn" onclick="history.back()"><i class=" bi bi-arrow-left-short"></i></button>
              </li>
              <!--<li>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#search-drawer">
                                <i class="anticon anticon-search"></i>
                            </a>
                        </li>-->
          </ul>
          <ul class="nav-right">
              <li class="dropdown dropdown-animated scale-left">
                  <div class="pointer" data-toggle="dropdown">
                      <div class="avatar avatar-image  m-h-10 m-r-15">
                          <img src="<?php echo $user_icon ?>" alt="">
                      </div>
                  </div>
                  <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                      <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                          <div class="d-flex m-r-50">
                              <div class="avatar avatar-lg avatar-image">
                                  <img src="<?php echo $user_icon ?>" alt="">
                              </div>
                              <div class="m-l-10">
                                  <p class="m-b-0 text-dark font-weight-semibold"><?php echo $name; ?></p>
                              </div>
                          </div>
                      </div>
                      <a href=<?php echo $edit; ?> class="dropdown-item d-block p-h-15 p-v-10">
                          <div class="d-flex align-items-center justify-content-between">
                              <div>
                                  <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                                  <span class="m-l-10">Edit Profile</span>
                              </div>
                              <i class="anticon font-size-10 anticon-right"></i>
                          </div>
                      </a>
                      <a href=<?php echo $logout; ?> class="dropdown-item d-block p-h-15 p-v-10">
                          <div class="d-flex align-items-center justify-content-between">
                              <div>
                                  <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                  <span class="m-l-10">Logout</span>
                              </div>
                              <i class="anticon font-size-10 anticon-right"></i>
                          </div>
                      </a>
                  </div>
              </li>
              <!-- quick view <li>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#quick-view">
                                <i class="anticon anticon-appstore"></i>
                            </a>-->
              </li>
          </ul>
      </div>
  </div>
  <!-- Header END -->