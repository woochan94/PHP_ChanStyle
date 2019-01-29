<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$bno = $_GET['idx'];

$sql = mq("delete from product where idx='$bno';");
echo "<script type=\"text/javascript\">alert(\"삭제되었습니다.\");</script>";
echo "<script>location.href='/ChanStyle/page/Admin/adminPage.php';</script>"
?>

