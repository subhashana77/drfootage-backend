<?php

include_once '../../db/DBUtil.php';
include_once '../../common/Utility.php';

$connection = DBUtil::getConnection();
$requestBody = Utility::getRequestBody();

$request = DBUtil::executeQuery(
    $connection,
    'SELECT * FROM footage WHERE footage_name = ?',
    $requestBody['footage_name']
);

if (count($request) > 0) {

    Utility::sendResponse(
        true,
        'Image data are fetched!',
        $request
    );
} else {
    Utility::sendResponse(
        false,
        'Image data not found!',
        null
    );
}