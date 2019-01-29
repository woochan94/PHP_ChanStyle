<?php
/**
 * write.php에서 입력한 내용을 DB에 올려주는 페이지
 */
include "../db.php"; // DB 파일을 불러온다.

$date = date('Y-m-d');
$name = $_SESSION['username'];
$title = $_POST['title'];
$content = $_POST['content'];
$id = $_SESSION['userid'];
if (isset($_POST['pw'])) {
    $pw = $_POST['pw'];
} else {
    $pw = 'null';
}

if (isset($_POST['lockpost'])) {
    $lo_post = '1';
} else {
    $lo_post = '0';
}



if($_FILES['b_file']['name'] == "") {
    $file_name ='null';
} else {
    $uploads_dir = '../images';
    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');

    $error = $_FILES['b_file']['error'];
    $file_name = $_FILES['b_file']['name'];
    $ext = array_pop(explode('.', $file_name));
// 오류 확인
    if ($error != UPLOAD_ERR_OK) {
        switch ($error) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo "파일이 너무 큽니다. ($error)";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "파일이 첨부되지 않았습니다. ($error)";
                break;
            default:
                echo "파일이 제대로 업로드되지 않았습니다. ($error)";
        }
        exit;
    }
// 확장자 확인
    if (!in_array($ext, $allowed_ext)) {
        echo "허용되지 않는 확장자입니다.";
        exit;
    }
// 파일 이동
    move_uploaded_file($_FILES['b_file']['tmp_name'], "$uploads_dir/$file_name");
}




$sql = mq("insert into board(id,name,pw,title,content,date,lock_post,file) values('$id','$name',$pw ,'$title','$content','$date','$lo_post','$file_name')");
?>
<script type="text/javascript">alert("글쓰기가 완료되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=/ChanStyle/board/board.php"/>