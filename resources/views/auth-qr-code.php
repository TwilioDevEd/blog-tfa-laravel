<?php
  header('Content-Type: image/png');
  echo QrCode::format('png')->size(300)->generate($otpauthUrl);
  exit;
?>
