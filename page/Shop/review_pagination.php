<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$page =  '';
$output = '';

$bno = $_POST['idx'];

if(isset($_POST['page'])) {
    $page = $_POST['page'];
} else {
    $page = 1;
}
$sql = mq("select * from review where con_num='$bno'");
$row_num = mysqli_num_rows($sql);

$list = 3;
$block_ct = 5;

$block_num = ceil($page/$block_ct);
$block_start = (($block_num-1)*$block_ct)+1;
$block_end = $block_start + $block_ct - 1;

$total_page = ceil($row_num/$list);

if($block_end > $total_page) {
    $block_end = $total_page;
}
$total_block = ceil($total_page / $block_ct);
$start_num = ($page-1) * $list;

$query = mq("select * from review where con_num = '$bno' order by idx desc limit $start_num, $list");

$output .= "
    <div id='review_box'>
    <div>
";

while($row = mysqli_fetch_array($query)) {
    $output .= '
        <div style="font-size: 17px; font-family: Tahoma, Geneva, sans-serif; display: inline;">작성자 : '.$row['name'].' 
    ';
    if($row['name'] == $_SESSION['username'] || $_SESSION['userid'] == 'admin') {
        $output .= '
         <form action="review_delete.php" method="post" style="display: inline">
            <input type="hidden" name="idx" value="'.$row['idx'].'">
            <input type="hidden" name="bno" value="'.$bno.'">
            <input type="submit" value="삭제" style="width: 50px; height: 25px; display: inline; margin-left: 900px; background: transparent; cursor: pointer; color: #09C;">
        </form>
        ';
    }
    $output .= '
  </div> 
        <div style="font-size: 17px; font-family: Tahoma, Geneva, sans-serif; margin-bottom: 5px; margin-top: 10px; margin-left: 5px">' . $row['content'] . '</div>
    <hr>
    ';
}

$output .= '</div></div>';

$output .= '
        <div class="text-center m-b-50">
            <div style="display: inline-block; margin-top: 60px;">
';
if($page <= 1){

} else {
    $output .= "
        <span  class='pagination_link' id='1' style='color: black; float: left; padding: 8px; 16px; text-decoration: none; cursor: pointer;' >처음</span>
    ";
}

if($page <= 1) {

} else {
    $pre = $page - 1;
    $output .= "
        <span  class='pagination_link' id='$pre' style='color: black; float: left; padding: 8px; 16px; text-decoration: none; cursor: pointer;'  >이전</span>
    ";
}

for($i=$block_start; $i<=$block_end; $i++) {

    if($page == $i) {
        $output .= "
            <span class='pagination_link' style='color: red; float: left; padding: 8px; 16px; text-decoration: none; cursor: pointer;' id='".$i."'>".$i."</span>
    ";
    } else {
        $output .= "
            <span class='pagination_link' style='color: black; float: left; padding: 8px; 16px; text-decoration: none; cursor: pointer;' id='".$i."'>".$i."</span>
    ";
    }
}

if($page >= $total_page) {

} else {
    $next = $page+1;
    $output .= "
        <span  class='pagination_link' id='$next' style='color: black; float: left; padding: 8px; 16px; text-decoration: none; cursor: pointer;'  >다음</span>
    ";
}

if($page >= $total_page) {

} else {
    $output .= "
        <span  class='pagination_link' id='$total_page' style='color: black; float: left; padding: 8px; 16px; text-decoration: none; cursor: pointer;'  >마지막</span>
    ";
}

$output .= "
    </div></div>
";
echo $output;
?>

<script>
    $(document).ready(function () {
       $('.pagination_link').hover(function () {
           $(this).css("background-color","#ddd");
       },function () {
           $(this).css("background-color","white");
       })
    });
</script>
