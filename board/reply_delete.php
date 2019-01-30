<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$rno = $_POST['rno'];
$sql = mq("select * from reply where idx='".$rno."'");
$board = $sql->fetch_array();

$sql = mq("delete from reply where idx='".$rno."'");
$sql2 = mq("delete from re_reply where con_num = $rno;");
?>
<script type="text/javascript">alert('댓글이 삭제되었습니다.'); location.replace("read.php?idx=<?php echo $board["con_num"]; ?>");</script>
