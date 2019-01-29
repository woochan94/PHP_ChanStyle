<?php

include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";
$name = $_POST['username'];
$id = $_POST['userid'];
$c_pw1 = $_POST['pwd1'];
$c_pw2 = $_POST['pwd2'];
$pw = password_hash($_POST['pwd1'], PASSWORD_DEFAULT);
$pw2 = password_hash($_POST['pwd2'], PASSWORD_DEFAULT);
$email = $_POST['useremail'];
$phone = $_POST['phone1'] . '-' . $_POST['phone2'] . '-' . $_POST['phone3'];
$postnum = $_POST['postnum'];
$address1 = $_POST['useraddress1'];
$address2 = $_POST['useraddress2'];
$address = $_POST['useraddress1'] . ' ' . $_POST['useraddress2'];

$id_check = mq("select * from userInfo where id='$id'");
$id_check = $id_check->fetch_array();
if($id_check >= 1) {
    echo "<script>alert('아이디가 중복됩니다.'); history.back();</script>";
} else if($cpw != $cpw2) {
    echo "<script>alert('비밀번호를 확인하여주세요'); history.back()</script>";
} else {
    $sql = mq("insert into userInfo (name, id, pw, email, phone, postnum, address, address1, address2) 
values ('$name','$id','$pw','$email','$phone','$postnum','$address','$address1','$address2')");

    echo "<script>alert('회원가입이 완료되었습니다.'); </script>";
}

?>
<meta charset="utf-8" />
<meta http-equiv="refresh" content="0 url=/ChanStyle/page/Login/Login.php">
