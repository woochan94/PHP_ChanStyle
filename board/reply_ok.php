<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$bno = $_POST['bno'];
$sql = mq("insert into reply(con_num,name,pw,content) values('".$bno."','".$_SESSION['username']."','".null."','".$_POST['content']."')");
if($_SESSION['username'] == "관리자") {
    $answer = mq("update board set answer = '1' where idx = '$bno'");
}
?>
