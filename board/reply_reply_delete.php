<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$rno = $_POST['rno'];
$sql = mq("select * from re_reply where idx='".$rno."'");
$board = $sql->fetch_array();

$sql = mq("delete from re_reply where idx='".$rno."'");
?>
<script type="text/javascript">alert('댓글이 삭제되었습니다.'); location.replace("read.php?idx=<?php echo $board["re_num"]; ?>");</script>

