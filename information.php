<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$link = mysqli_connect('db', 'root', 'root');
if (!$link) {
    die('Error! ' . mysqli_connect_error());
}
echo 'Good!';
mysqli_close($link);
?>

