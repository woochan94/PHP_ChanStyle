<?php
include "../db.php";

$bno = $_GET['idx'];
$sql = mq("delete from board where idx='$bno';");
echo "<script type=\"text/javascript\">alert(\"삭제되었습니다.\");</script>";
echo "<script>location.href='board.php';</script>";
?>

