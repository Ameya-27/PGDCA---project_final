<?php
session_start();
if (isset($_SESSION['user_master_id']) && isset($_SESSION['username'])) {
    include "../master/db_conn.php";
    if (isset($_POST['submit']) && ($_POST['submit'] == 'submit')) {
        if (isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] === UPLOAD_ERR_OK) {
            $company_name = $_POST['company_name'];


            $fileTmpPath = $_FILES['file-upload']['tmp_name'];
            $fileName = $_FILES['file-upload']['name'];
            $fileSize = $_FILES['file-upload']['size'];
            $fileType = $_FILES['file-upload']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            // sanitize file-name

            $ext = pathinfo($fileName, PATHINFO_EXTENSION);

            $newFileName = strval(md5(time() . $fileName)). '.' .$ext;
           // $newFileName = $fileName ;
            // check if file has one of the following extensions
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($fileExtension, $allowedfileExtensions)) {
                // directory in which the uploaded file will be moved
                $uploadFileDir = '../uploaded_files/';
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    echo "<script> alert('new data added')</script>";
                    echo $company_name;
                    header("refresh:2;admin-dashboard.php");
                    
                    $sql = "INSERT INTO system_settings (logo_url,app_name) Values ('$dest_path','$company_name')";
                    $result = mysqli_query($conn,$sql);
                 
                    if($result!=True){
                       header("Location:admin-dashboard.php?error=data not added");
                    }
                    $sql_1 = "SELECT logo_url from system_settings WHERE logo_url='$dest_path'";
                    $result_1=mysqli_query($conn,$sql_1);
                    if($result_1==True){
                    $row=mysqli_fetch_assoc($result_1);
                    $row_logo_url=$row['logo_url'];}
                    
                } else {
                    header("Location:?error=There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.");
                }
            } else {
                header('Location:?error=Upload failed.  Your file extension is not in Allowed file types: ' . implode(',', $allowedfileExtensions));
            }
        } else {
            header("Location:admin-dashboard.php?error=there is something wrong with the file. Please check it". $_FILES['uploadedFile']['error']);
        }
    } else {
        header("Location:admin-dashboard.php?error=something");
        
    }
} else {
    header("Location:../index.php");
}
