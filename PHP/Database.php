<?php

    function escape ($param) {
        return mysqli_real_escape_string($param);
    }

    function sendData ($conn, $name, $type, $hp, $attack, $weak, $res) {
        try {
            $stmt = "INSERT INTO pokemon (name, type, hp, attack, weakness, resistance) 
            VALUES ('".$name."', '".$type."', '".$hp."', '".$attack."', '".$weak."', '".$res."')";
            mysqli_query($conn, $stmt);    
        } catch (mysqli_sql_exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function getData ($conn) {
        try {
            $stmt = "SELECT *
            FROM pokemon";
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

    function deleteAll ($conn) {
        try {
            $stmt = "DELETE FROM pokemon";
            mysqli_query($conn, $stmt);
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