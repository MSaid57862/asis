<?php session_start(); ?>
<?php require_once '../connections/meekro/db.class.php'; ?>
<?php require_once 'functions.php';?>
<?php

// NEW BARRACK UNIT IMAGE UPLOAD
if (isset($_FILES['barrackUnitImage'])) {
    $file = $_FILES['barrackUnitImage'];

    // File details
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    // Specify the target directory where the image will be saved
    $uploadDirectory = '../barrackImages/';

    // Ensure the target directory exists, or create it if necessary
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    if ($fileSize <= $maxFileSize) {
    // Check for allowed file types (you can customize this list)
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    if (in_array(strtolower($fileExtension), $allowedExtensions)) {
        if ($fileError === UPLOAD_ERR_OK) {
            // Generate a unique file name to avoid overwriting existing files
            $newFileName = uniqid('', true) . '.' . $fileExtension;

            // Move the uploaded file to the target directory
            $targetPath = $uploadDirectory . $newFileName;
            move_uploaded_file($fileTmpName, $targetPath);

           $barrackCode = $_POST['barrackUnitImageCode'];
                $imageTitle = $_POST['imageTitle'];
                    $query = DB::queryFirstRow("SELECT * FROM barrack_unit_images WHERE unit_code = '$barrackCode' AND image_title='$imageTitle'");
                    if($query){
                        $_SESSION['fail'] = ' Error.'.$imageTitle.' picture for the Barrack Unit already Uploaded ';
                        header('Location: ' . $_SERVER['HTTP_REFERER']);	
                            }else{
                                
                            $res = DB::insert('barrack_unit_images', array(
                            'image_url' => $newFileName,
                            'unit_code' => $_POST['barrackUnitImageCode'],
                            'unit' => $_POST['barrackUnitImageID'],
                            'image_title' => $_POST['imageTitle'],
                            'created_by' => $_SESSION['svc'],
                            'date_created' => time()
                                )
                                    
                            );
                                if($res){
                                     $_SESSION['success'] = $imageTitle." Barrack Unit Image Successful Added";
                                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                                    
                                }else{
                                     $_SESSION['fail'] = $imageTitle. " Failed to Add Barrack Unit Image ";
                                     header('Location: ' . $_SERVER['HTTP_REFERER']);
                                }      
                                        
                    }

        } else {
            $_SESSION['fail'] = $imageTitle. " Error: An error occurred while uploading the file.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    } else {
        $_SESSION['fail'] = $imageTitle. " Error: Invalid file type. Please upload a valid image (jpg, jpeg, png, gif).";
         header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    }else{
        //FileSize greater than 2MB
        $_SESSION['fail'] = $imageTitle. " Error: The file size exceeds the allowed limit (2MB). Please upload a smaller file. ";
         header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

//NEW BARRACK
if(isset($_POST['new-barrack'])){
    $barrackCode = $_POST['barrackCode'];
    $query = DB::queryFirstRow("SELECT barrack_code FROM barrack_information WHERE barrack_code = '$barrackCode'");
    if($query){
        $_SESSION['fail'] = ' Error. Barrack Code Exist ';
        header('Location: ' . $_SERVER['HTTP_REFERER']);	
            }else{
                
            $res = DB::insert('barrack_information', array(
            'name' => $_POST['barrackName'],
            'barrack_code' => $_POST['barrackCode'],
            'category' => $_POST['barrackCategory'],
            'description' => $_POST['barrackDescription'],
            'address' => $_POST['barrackAddress'],
            'barrack_state' => $_POST['barrackState'],
            'barrack_lga' => $_POST['barrackLGA'],
            'created_by' => $_SESSION['svc'],
            'barrack_status' => $_POST['barrackStatus'],
            'date_created' => time()
                )
                    
            );
                if($res){
                     $_SESSION['success'] = " Barrack Records Successful Added";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    
                }else{
                     $_SESSION['fail'] = " Failed to Add Barrack Records ";
                     header('Location: ' . $_SERVER['HTTP_REFERER']);
                }      
                        
    }
}


//NEW BARRACK UNIT
if(isset($_POST['new-barrack-unit'])){
    $barrackUnitCode = $_POST['barrackUnitCode'];
    $query = DB::queryFirstRow("SELECT unit_code FROM barrack_unit_information WHERE unit_code = '$barrackUnitCode'");
    if($query){
        $_SESSION['fail'] = ' Error. Barrack Unit Code Exist ';
        header('Location: ' . $_SERVER['HTTP_REFERER']);	
            }else{
                
            $res = DB::insert('barrack_unit_information', array(
            'unit_name' => $_POST['barrackUnitName'],
            'unit_code' => $_POST['barrackUnitCode'],
            'unit_status' => $_POST['barrackUnitStatus'],
            'facilities' => $_POST['barrackFacilities'],
            'allocation_status' => $_POST['barrackUnitAllocationStatus'],
            'barrack_id' => $_POST['barrackId'],
            'date_created' => time()
                )
                    
            );
                if($res){
                     $_SESSION['success'] = " Barrack Records Successful Added";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    
                }else{
                     $_SESSION['fail'] = " Failed to Added Barrack Records ";
                     header('Location: ' . $_SERVER['HTTP_REFERER']);
                }      
                        
    }
}

?>

