<?php
/**
 * Created by PhpStorm.
 * User: woochan
 * Date: 2018-12-29
 * Time: 오전 2:36
 */
session_start(); // session 시작
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

?>