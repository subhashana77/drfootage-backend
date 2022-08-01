<?php

include_once '../../db/DBUtil.php';
include_once '../../common/Utility.php';

$connection = DBUtil::getConnection();
$requestBody = Utility::getRequestBody();

$result = DBUtil::executeUpdate(
    $connection,
    "DELETE FROM footage WHERE footage_id = ?",
    $requestBody['footage_id']
);

if ($result) {
    Utility::sendResponse(
        true,
        'Image deleted!',
        $requestBody
    );
} else {
    Utility::sendResponse(
        false,
        'Image not deleted!',
        null
    );
}
