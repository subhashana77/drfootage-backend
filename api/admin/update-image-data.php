<?php

include_once '../../db/DBUtil.php';
include_once '../../common/Utility.php';

$connection = DBUtil::getConnection();
$requestBody = Utility::getRequestBody();

$result = DBUtil::executeUpdate(
    $connection,
    "UPDATE footage SET added_date = ?, tags = ?, category_id = ? WHERE footage_id = ?",
    $requestBody['added_date'],
    $requestBody['tags'],
    $requestBody['category_id'],
    $requestBody['footage_id']
);

if ($result) {
    Utility::sendResponse(
        true,
        'Image details updated!',
        $requestBody
    );
} else {
    Utility::sendResponse(
        false,
        'Image details update fail!',
        null
    );
}