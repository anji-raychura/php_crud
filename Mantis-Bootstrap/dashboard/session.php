<?php

session_start();

$_SESSION['username'] = "Anjali";

echo $_SESSION['username'];

session_unset();

echo $_SESSION['username'];
?>