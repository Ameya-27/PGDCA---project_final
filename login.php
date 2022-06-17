<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['user_master_id'])) {
    include "master/db_conn.php";
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
        $sub_str = substr($logo, 3);
    }
    
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sign-In</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/images/logo/digikentro.png">

        <!-- page css -->

        <!-- Core css -->
        <link href="assets/css/app.min.css" rel="stylesheet">
        <style>
            #comp_name {
                font-family: "DIN-Next-W01-Light";
                font-weight: bold;
                color: #0A3CFF;
                font-size: large;
            }
        </style>

    </head>

    <body>
        <div class="app">
            <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('assets/images/others/login-3.png')">
                <div class="d-flex flex-column justify-content-between w-100">
                    <div class="container d-flex h-100">
                        <div class="row align-items-center w-100">
                            <div class="col-md-7 col-lg-5 m-h-auto">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <img src="<?php echo  $sub_str ?>" alt="Logo" style="width: 50px; height: 50px;">
                                        <label id="comp_name"><?php echo strtoupper($app); ?>'S LOGIN PAGE</label>
                                        <form action="master/check-login.php" method="POST">
                                            <?php if (isset($_GET['error'])) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?= $_GET['error'] ?>
                                                </div>
                                            <?php } ?>
                                            <br>
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="username">Username:</label>
                                                <div class="input-affix">
                                                    <i class="prefix-icon anticon anticon-user"></i>
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="password">Password:</label>
                                                <!--<a class="float-right font-size-13 text-muted" href="create.php">Signup</a>-->
                                                <div class="input-affix m-b-10">
                                                    <i class="prefix-icon anticon anticon-lock"></i>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <button class="btn btn-primary">Login</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-md-flex p-h-40 justify-content-between">
                        <span class="">© 2022</span>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a class="text-dark text-link" href="">Legal</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-dark text-link" href="">Privacy</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <!-- Core Vendors JS -->
        <script src="assets/js/vendors.min.js"></script>

        <!-- page js -->

        <!-- Core JS -->
        <script src="assets/js/app.min.js"></script>

    </body>

    </html>
<?php } else {
    if ($_SESSION['role'] == 'employee') {
        if ($_SESSION['is_manager'] == 1) {
            header("LOCATION:manager/manager-dashboard.php");
        } else {
            header("LOCATION:employee/employee-dashboard.php");
        }
    } else {
        header("LOCATION:admin/admin-dashboard.php");
    }
} ?>