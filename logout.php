<?php

session_start();
unset($_SESSION['eggziesibonew3']);
session_destroy();
setcookie('auth', '');
header('location:goodbye.php');

?>