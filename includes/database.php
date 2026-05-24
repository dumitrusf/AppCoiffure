<?php

$db = mysqli_connect('localhost', 'root', 'root', 'appsalon_mvc_php');


if (!$db) {
    echo "Error: It could not connect to MySQL.";
    echo "Debug error number: " . mysqli_connect_errno();
    echo "Debug error: " . mysqli_connect_error();
    exit;
}
