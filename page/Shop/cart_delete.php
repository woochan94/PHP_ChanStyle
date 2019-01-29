<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$bno = $_POST['param1'];

$sql = mq("delete from cart where idx='$bno';");
?>