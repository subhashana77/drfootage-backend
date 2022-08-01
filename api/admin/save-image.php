<?php

include_once '../../db/DBUtil.php';
include_once '../../common/Utility.php';

$connection = DBUtil::getConnection();
$requestBody = Utility::getRequestBody();

$file_path = "http://localhost/projects/drfootage-backend/uploads/";
try {
    $result = DBUtil::executeUpdate(
        $connection,
        "INSERT INTO footage (file_path, footage_name, file_type, added_date, tags, category_id) VALUES (?, ?, ?, ?, ?, ?)",
        $file_path,
        $requestBody['footage_name'],
        $requestBody['file_type'],
        $requestBody['added_date'],
        $requestBody['tags'],
        $requestBody['category_id']
    );

    $encoded = $requestBody['base64_code'];
    $file = fopen("../../uploads/".$requestBody['footage_name'].".".$requestBody['file_type'], "w");
    fwrite($file, base64_decode($encoded));
    fclose($file);

    if ($result) {
        Utility::sendResponse(
            true,
            $requestBody['footage_name'].'.'.$requestBody['file_type']." Added!",
            $requestBody
        );

    } else {
        Utility::sendResponse(
            false,
            'footage not uploaded!',
            null
        );
    }

} catch (Exception $e) {
    Utility::sendResponse(
        false,
        'Cannot complete this operation!',
        null
    );
}


