<?php

include_once '../../db/DBUtil.php';
include_once '../../common/Utility.php';

$connection = DBUtil::getConnection();
$requestBody = Utility::getRequestBody();

$request = DBUtil::executeQuery(
    $connection,
    'SELECT footage_name FROM footage'
);

if (count($request) > 0) {

    Utility::sendResponse(
        true,
        'All image names are fetched!',
        $request
    );
} else {
    Utility::sendResponse(
        false,
        'Image names fetching fail!',
        null
    );
}