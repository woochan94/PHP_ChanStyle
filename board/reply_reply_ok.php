<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$rno = $_POST['rno'];
$r_rno = $_POST['r_rno'];
$bno = $_POST['b_no'];
$content = $_POST['content'];
$name = $_SESSION['username'];

$sql = mq("insert into re_reply(con_num, re_num, content, name) values ('$rno','$r_rno','$content','$name'); ");
?>
<meta http-equiv="refresh" content="0 url=/ChanStyle/board/read.php?idx=<?php echo $bno; ?>">
