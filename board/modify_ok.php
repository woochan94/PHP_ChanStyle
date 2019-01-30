<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$bno = $_POST['idx'];
$name = $_SESSION['username'];
$title = $_POST['title'];
$content = $_POST['content'];
$id = $_SESSION['userid'];

echo "$name";
echo "$title";
echo "$id";

$sql = mq("update board set title='$title', content='$content' where idx='$bno'");
echo "<script type=\"text/javascript\">alert(\"수정되었습니다.\");</script>";
?>
<meta http-equiv="refresh" content="0 url=/ChanStyle/board/read.php?idx=<?php echo $bno; ?>">
