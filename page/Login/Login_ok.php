<?php

header('Content-Type: text/html; charset=utf-8'); //인코딩 타입을 utf-8로 설정

$db = new mysqli("localhost", "root", "wjddncks!", "chanstyle"); // $db에 mysql을 연결
$db->set_charset("utf8"); // db문자열을 utf-8로 인코딩

// 연결 확인
if($db->connect_errno) {
    echo '[DB연결실패] :' .$db->connect_error.'';
} else {
}

function mq($sql)
{
    global $db; // global은 외부에서 선언된 $sql을 함수 내에서 쓸 수 있도록 해줌
    return $db->query($sql);
}

if(isset($_POST["remember-me"])){
    $duration = 7 * 24 * 60 * 60;
    ini_set('session.gc_maxlifetime', $duration);
    session_set_cookie_params($duration);
}
session_start();
// Post로 바다온 아이디와 비밀번호가 비어있다면 알림창을 띄우고 전 페이지로 돌아감
if($_POST["userid"] == "" || $_POST["userpwd"] == "") {
    echo '<script> alert("아이디와 패스워드를 모두 입력하세요."); history.back(); </script>';
} else {
    $password = $_POST['userpwd'];
    $sql = mq("select * from userInfo where id='".$_POST['userid']."'");
    $member = $sql->fetch_array();
    $hash_pw = $member['pw']; // hash_pw에 POST로 받아온 아이디열의 비밀번호를 저장한다.

    if(password_verify($password, $hash_pw)) {  // 만약 password변수와 hash_pw변수가 같다면 세션값을 저장하고 알림창을 띄운 후 main으로 이동
        $_SESSION['userid'] = $member["id"];
        $_SESSION['userpw'] = $member["pw"];
        $_SESSION['username'] = $member['name'];
        echo "<script>location.href='/ChanStyle/index.php';</script>";
    } else {
        echo "<script>alert('아이디 혹은 비밀번호를 확인하세요.'); history.back();</script>";
    }
}
?>

