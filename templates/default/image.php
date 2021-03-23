<?php
include "phpqrcode/qrlib.php";
session_start();

QRcode::png($_SESSION['qrAmount']);
?>
