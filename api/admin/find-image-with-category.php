<?php

include_once '../../db/DBUtil.php';
include_once '../../common/Utility.php';

$connection = DBUtil::getConnection();
$requestBody = Utility::getRequestBody();

$request = DBUtil::executeQuery(
    $connection,
    'SELECT footage_name, footage_id, tags, file_type, file_path, footage_name, category_id, added_date, file_type FROM footage WHERE category_id = ?',
    $requestBody['category_id']
);

if (count($request) > 0) {

    Utility::sendResponse(
        true,
        'All ' . $requestBody['category_id'] . ' image names are fetched!',
        $request
    );
} else {
    Utility::sendResponse(
        false,
        'Image ' . $requestBody['category_id'] . ' names fetching fail!',
        null
    );
}