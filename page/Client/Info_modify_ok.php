<?php

include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$sql = mq("select * from userInfo where id = '$_SESSION[userid]';");
$board = $sql->fetch_array();

// 새 비밀번호
$pw = $_POST['password'];
$password = password_hash($pw,PASSWORD_DEFAULT);
// 이메일
$email = $_POST['email'];
// 전화번호
$phone = $_POST['phone'];


$origin_pw = $board['pw'];

if(password_verify($pw,$origin_pw)) {
    $sql2 = mq("update userInfo set pw='$password',email ='$email',phone='$phone' where id='$_SESSION[userid]';");
    echo "<script>alert('수정이 완료 되었습니다.')</script>";
} else {
    echo "<script>alert('기존 비밀번호가 틀렸습니다.')</script>";
}
?>
<script>location.href='/ChanStyle/page/Client/MyPage.php'</script>
