<?php

include_once '../../db/DBUtil.php';
include_once '../../common/Utility.php';

$connection = DBUtil::getConnection();
$requestBody = Utility::getRequestBody();

$request = DBUtil::executeQuery(
    $connection,
    'SELECT footage_name, footage_id, tags, file_type, file_path, footage_name, category_id, added_date, file_type FROM footage WHERE file_type = ?',
    $requestBody['file_type']
);

if (count($request) > 0) {

    Utility::sendResponse(
        true,
        'All ' . $requestBody['file_type'] . ' image names are fetched!',
        $request
    );
} else {
    Utility::sendResponse(
        false,
        'Image ' . $requestBody['file_type'] . ' names fetching fail!',
        null
    );
}