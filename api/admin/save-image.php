<?php

include_once '../../db/DBUtil.php';
include_once '../../common/Utility.php';

$connection = DBUtil::getConnection();
$requestBody = Utility::getRequestBody();

$file_path = "../../uploads/";

try {
    $footageResult = DBUtil::executeUpdate(
        $connection,
        "INSERT INTO footage (file_path, footage_name, file_type, added_date, tags, category_id) VALUES (?, ?, ?, ?, ?, ?)",
        $file_path,
        $requestBody['footage_name'],
        $requestBody['file_type'],
        $requestBody['added_date'],
        $requestBody['tags'],
        $requestBody['category_id']
    );

    if ($footageResult) {

        $fp = fopen(
            $file_path
            .$requestBody['footage_name']
            ."_"
            .rand(1,100)
            ."."
            .$requestBody['file_type'],
            "w+"
        );
        fwrite($fp, base64_decode($requestBody['base64_code']));

        Utility::sendResponse(
            true,
            $requestBody['footage_name']." Added!",
            $requestBody
        );
        
    } else {
        Utility::sendResponse(
            false,
            "footage_id and category_id not added!",
            null
        );
    }
} catch (Exception $e) {
    try {

        Utility::sendResponse(
            false,
            'Cannot complete this operation!',
            null
        );
    } catch (Exception $e) {
        Utility::sendResponse(
            false,
            'Something went wrong!',
            null
        );
    }
}


