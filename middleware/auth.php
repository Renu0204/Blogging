<?php 
session_start();
if (!isset($_SESSION['name'])) {
    header("Location:?route=login");
}










?>








