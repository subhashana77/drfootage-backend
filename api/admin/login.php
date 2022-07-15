<?php

include_once '../../db/DBUtil.php';
include_once '../../common/Utility.php';

$connection = DBUtil::getConnection();
$requestBody = Utility::getRequestBody();

$request = DBUtil::executeQuery(
    $connection,
    'SELECT * FROM administrator WHERE admin_username = ? AND admin_password = ?',
    $requestBody['admin_username'],
    $requestBody['admin_password']
);

if (count($request) > 0) {
//    $request[0]['password'] = '*****';
//    $token = JwtUtil::generateAccessToken($request[0], USER_ROLE_ADMIN, ADMIN_ACCESS_TOKEN_EXP_TIME);

    Utility::sendResponse(
        true,
        'Success Login',
        $request
//        $token
    );
} else {
    Utility::sendResponse(
        false,
        'Error Login',
        null
    );
}