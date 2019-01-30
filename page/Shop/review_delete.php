<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$idx = $_POST['idx'];
$bno = $_POST['bno'];

$sql = mq("delete from review where idx = '$idx';");
echo "<script type=\"text/javascript\">alert(\"삭제되었습니다.\");</script>";
echo "<script>location.href='/ChanStyle/page/Shop/Product.php?idx=$bno';</script>";
?>