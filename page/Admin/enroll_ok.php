<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$pname = $_POST['product_name'];
$pprice = $_POST['product_price'];
$pgroup1 = $_POST['product_group1'];
$pgroup2 = $_POST['product_group2'];
$inventory = $_POST['product_inventory'];

$uploads_dir = '../../images/product';
$allowed_ext = array('jpg', 'jpeg', 'png', 'gif');

$error = $_FILES['product_image']['error'];
$file_name = $_FILES['product_image']['name'];

$pdetail_image = $_FILES['product_detail_image']['name'];

$size_detail = $_FILES['size_image']['name'];

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
// 파일 이동
move_uploaded_file($_FILES['product_image']['tmp_name'], "$uploads_dir/$file_name");
move_uploaded_file($_FILES['product_detail_image']['tmp_name'], "$uploads_dir/$pdetail_image");
move_uploaded_file($_FILES['size_image']['tmp_name'],"$uploads_dir/$size_detail");

$sql = mq("insert into product(pname,pprice,pgroup1,pgroup2,inventory,pimage,pdetail_image,size_detail) values ('$pname','$pprice','$pgroup1','$pgroup2','$inventory','$file_name','$pdetail_image','$size_detail')");

?>
<script type="text/javascript">alert("상품등록이 완료되었습니다.");</script>-->
<meta http-equiv="refresh" content="0 url=/ChanStyle/page/Admin/adminPage.php"/>
