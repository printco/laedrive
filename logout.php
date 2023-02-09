<?php

session_start();

require_once "logging.php";

$username = $_SESSION['username'];

unset($_SESSION['username']);

write_log("User-${username} loged out");

header("Location: login.php");

