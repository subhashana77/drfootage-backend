<?php

include_once '../../db/DBUtil.php';
include_once '../../common/Utility.php';

$connection = DBUtil::getConnection();
$requestBody = Utility::getRequestBody();

$file_path = "../../uploads/";

try {
    DBUtil::getConnection()->beginTransaction();

    $result = DBUtil::executeUpdate(
        $connection,
        "INSERT INTO footage (file_path, footage_name, file_type, added_date) VALUES (?, ?, ?, ?)",
        $file_path,
        $requestBody['footage_name'],
        $requestBody['file_type'],
        $requestBody['added_date']
    );

    $result = DBUtil::executeUpdate(
        $connection,
        "INSERT INTO category (category_name) VALUES (?)",
        $requestBody['category_name']
    );

    $result = DBUtil::executeUpdate(
        $connection,
        "INSERT INTO category_detail (footage_id, category_id) VALUES (?, ?)",
        $requestBody['footage_id'],
        $requestBody['category_id']
    );

    $result = DBUtil::executeUpdate(
        $connection,
        "INSERT INTO tags (tag_line, footage_id) VALUES (?, ?)",
        $requestBody['tag_line'],
        $requestBody['footage_id']
    );

    DBUtil::getConnection() -> commit();

    if ($result) {
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
            $requestBody['footage_name']." not added!",
            null
        );
    }

} catch (Exception $e) {
    try {
        DBUtil::getConnection()->rollBack();

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


