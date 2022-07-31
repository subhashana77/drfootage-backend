<?php

include_once '../../db/DBUtil.php';
include_once '../../common/Utility.php';

$connection = DBUtil::getConnection();
$requestBody = Utility::getRequestBody();

try {
    $result = DBUtil::executeUpdate(
        $connection,
        "INSERT INTO footage (file_path, footage_name, file_type, added_date, tags, category_id) VALUES (?, ?, ?, ?, ?, ?)",
        $requestBody['file_path'],
        $requestBody['footage_name'],
        $requestBody['file_type'],
        $requestBody['added_date'],
        $requestBody['tags'],
        $requestBody['category_id']
    );

    $base64Image = $requestBody['base64'];
    var_dump($base64Image);

//    $fp = fopen(
//        $requestBody['file_path']
//        .$requestBody['footage_name']
//        ."."
//        .$requestBody['file_type'],
//        "w+"
//    );
//    fwrite($fp, base64_decode($requestBody['base64']));

    if ($result) {
        Utility::sendResponse(
            true,
            $requestBody['footage_name']." Added!",
            $requestBody
        );

    } else {
        Utility::sendResponse(
            false,
            "footage not uploaded!",
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


