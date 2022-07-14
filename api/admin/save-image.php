<?php

include_once '../../common/Utility.php';

if (isset($_POST ['Upload-Img'])) {

    $img = $_FILES['images']['name'];
    $img_loc = $_FILES['images']['temp_name'];
    $img_folder = "../../uploads/";

    if (move_uploaded_file($img_loc, $img_folder, $img)) {
        Utility::sendResponse(
            true,
            'Image Uploaded!',
            null
        );
    } else {
        Utility::sendResponse(
            true,
            'Upload Fail!',
            null
        );
    }
}
