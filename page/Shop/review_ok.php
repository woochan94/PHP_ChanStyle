<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$bno = $_POST['bno'];
$name = $_SESSION['username'];
$content = $_POST['content'];

$uploads_dir = '/ChanStyle/images/review';
$allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
$error = $_FILES['review_image']['error'];
$file_name = $_FILES['review_image']['name'];

$ext = array_pop(explode('.', $file_name));
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

move_uploaded_file($_FILES['review_image']['tmp_name'], "$uploads_dir/$file_name");

$sql = mq("insert into review(con_num,name,content,file) values ('$bno','$name','$content','$file_name')");

?>
