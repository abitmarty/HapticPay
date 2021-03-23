<?php
include "phpqrcode/qrlib.php";
session_start();

echo "<p>Je moeder</p>"


QRcode::png(
  $_SESSION['qrAmount'],
  $outfile = false,
  $level = QR_ECLEVEL_L,
  $size = 15,
);

?>
