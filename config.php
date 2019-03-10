<?php
DEFINE('HOST','localhost');
DEFINE('USER','root');
DEFINE('PASS','root');
DEFINE('DB','forex');
$conn = mysqli_connect(HOST,USER, PASS, DB) or die("Bağlantı Başarısız");

?>
