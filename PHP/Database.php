<?php

    function escape ($param) {
        return mysqli_real_escape_string($param);
    }

    function sendData ($conn, $name, $type, $attack, $weak, $res, $hitpoints) {
        try {
            $stmt = "INSERT INTO pokemon (name, type, attack, weakness, resistance, hitpoints) 
            VALUES ('".$name."', '".$type."', '".$attack."', '".$weak."', '".$res."', '".$hitpoints."')";
            mysqli_query($conn, $stmt);    
        } catch (mysqli_sql_exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function sendActiveData($conn, $id, $name) {
        try {
            $stmt = "INSERT INTO active (id, name) 
            VALUES ('".$id."','".$name."')";
            mysqli_query($conn, $stmt);    
        } catch (mysqli_sql_exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function getData ($conn, $table) {
        try {
            $stmt = "SELECT *
            FROM $table";
            $result = mysqli_query($conn, $stmt);
        } catch (mysqli_sql_exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $result;
    }

    function getDataById ($conn, $id) {
        try {
            $stmt = "SELECT *
            FROM pokemon WHERE id=$id";
            $result = mysqli_query($conn, $stmt);
            $result = mysqli_fetch_object($result);
        } catch (mysqli_sql_exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $result;
    }

    function deleteSingle ($conn, $id) {
        try {
            $stmt = "DELETE FROM pokemon WHERE id=$id";
            $result = mysqli_query($conn, $stmt);
        } catch (mysqli_sql_exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function deleteAll ($conn, $type) {
        try {

            if ($type == 'all') {
                $stmt = "DELETE FROM pokemon";
                mysqli_query($conn, $stmt);
                $stmt2 = "DELETE FROM active";
                mysqli_query($conn, $stmt2);
            } else {
                $stmt = "DELETE FROM active";
                mysqli_query($conn, $stmt);
            }
        } catch (mysqli_sql_exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function getRandomName ($conn, $func) {
        $stmt = "SELECT `name` FROM names ORDER BY rand() LIMIT 1";
        $result = mysqli_query($conn, $stmt) or die(mysqli_error($conn));
        $result = mysqli_fetch_object($result);

        return $result->name;
    }

    function getRandomType ($conn, $func) {
        $stmt = "SELECT `type` FROM types ORDER BY rand() LIMIT 1";
        $result = mysqli_query($conn, $stmt) or die(mysqli_error($conn));
        $result = mysqli_fetch_object($result);

        return $result->type;
    }

    function getRandomMove($conn, $func) {
        $stmt = "SELECT `move` FROM moves ORDER BY rand() LIMIT 1";
        $result = mysqli_query($conn, $stmt) or die(mysqli_error($conn));
        $result = mysqli_fetch_object($result);

        return $result->move;
    }

    function checkCount ($conn) {
        try {
            $stmt = "SELECT COUNT(*) as total FROM active";
            $result = mysqli_query($conn, $stmt);
            $data = mysqli_fetch_assoc($result);
        } catch (mysqli_sql_exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $data;
    }