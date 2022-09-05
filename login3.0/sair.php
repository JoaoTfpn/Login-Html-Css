<?php
session_start();
unset($_SESSION['id_user'], $_SESSION['nome']);
header("Location: index.php");