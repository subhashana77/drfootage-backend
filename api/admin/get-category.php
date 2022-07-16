<?php

include_once '../../db/DBUtil.php';
include_once '../../common/Utility.php';

$connection = DBUtil::getConnection();
$requestBody = Utility::getRequestBody();

$request = DBUtil::executeQuery(
    $connection,
    'SELECT * FROM category'
);

if (count($request) > 0) {

    Utility::sendResponse(
        true,
        'All categories are fetched!',
        $request
    );
} else {
    Utility::sendResponse(
        false,
        'Category fetching fail!',
        null
    );
}