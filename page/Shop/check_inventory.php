<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$bno = $_POST['bno'];

$sql = mq("select * from product where idx = '$bno';");
$board = $sql->fetch_array();

if($board['inventory'] <= 0) {
    echo "1";
}else {
    echo "2";
}
?>