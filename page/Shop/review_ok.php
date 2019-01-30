<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$bno = $_POST['bno'];
$content = $_POST['content'];
$name = $_SESSION['username'];

$sql = mq("insert into review(con_num, name, content) values ('$bno','$name','$content');");

$aa = array($content, $name);
echo json_encode($aa);
?>
