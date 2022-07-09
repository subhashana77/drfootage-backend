<?php
require_once 'DBConn.php';

class DBUtil {
    //    insert, update, delete query
    public static function executeUpdate($conn, $sql, ...$params) {
        try {
            $pstm = $conn->prepare($sql);
            return $pstm->execute($params);
        } catch (PDOException $exception) {
            return false;
        }
    }

//    select query
    public static function executeQuery($conn, $sql, ...$params) {
        try {
            $pstm = $conn->prepare($sql);
            $pstm->execute($params);
            return $pstm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            return null;
        }
    }

//    get db connection
    public static function getConnection() {
        try {
            return (new DBConn())->getConnection();
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}