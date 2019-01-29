<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$test = $_POST['userid'];

if($_POST['userid'] != NULL) {
    $id_check = mq("select * from userInfo where id='{$_POST['userid']}'"); // id항목에서 post 값으로 받아온 userid를 찾는다.
    $id_check = $id_check->fetch_array();

    if($id_check >= 1) {
        echo "※이미 존재하는 아이디입니다.";
    } else if ($id_check === null) {
        echo "사용 가능한 아이디입니다.";
    }
}
?>

