<?php

include_once '../../db/DBUtil.php';
include_once '../../common/Utility.php';

$connection = DBUtil::getConnection();
$requestBody = Utility::getRequestBody();

$footageName = '%'.$requestBody['footage_name'].'%';

$request = DBUtil::executeQuery(
    $connection,
    "SELECT footage_name, footage_id, tags, file_type, file_path, footage_name, category_id, added_date, file_type FROM footage WHERE footage_name LIKE '$footageName'"
);

if (count($request) > 0) {

    Utility::sendResponse(
        true,
        'All ' . $requestBody['footage_name'] . ' image names are fetched!',
        $request
    );
} else {
    Utility::sendResponse(
        false,
        'Image ' . $requestBody['footage_name'] . ' names fetching fail!',
        null
    );
}