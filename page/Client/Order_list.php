<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CHANSTYLE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title Icon -->
    <link rel="icon" type="image/png" href="/ChanStyle/images/icons/title_icon.png"/>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/basicstructure.css">
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/mypage.css">
    <!-- BootStrap -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/bootstrap/css/bootstrap.min.css">
    <!-- semantic -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/semantic/semantic.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="/ChanStyle/vendor/semantic/semantic.js"></script>
    <!-- includeHTML -->
    <script src="/ChanStyle/js/includeHTML.js"></script>
</head>

<body>
<!-- Header -->
<header class="header" include-html="/ChanStyle/BasicHeader.php">

</header>

<main>
    <div class="vertical-menu" style="height: 800px;">
        <div class="text-center m-text29 p-t-50 p-b-50">MY PAGE</div>
        <a href="/ChanStyle/page/Client/MyPage.php"><button class="tablinks m-text11">개인정보 수정</button></a>
        <a href="/ChanStyle/page/Client/My_board.php"><button class="tablinks m-text11">내가 쓴 문의글</button></a>
        <a href="/ChanStyle/page/Client/Order_list.php"><button class="tablinks m-text11">구매 내역</button></a>
    </div>

    <div class="tabcontent page_content">
        <div class="m-text17">구매 내역</div>
        <table class="list-mypage">
            <thead>
            <tr>
                <th>주문 날짜</th>
                <th width="200">상품 이미지</th>
                <th width="150">상품 이름</th>
                <th width="150">주문 금액(수량)</th>
                <th width="100">수령자</th>
                <th width="250"> 수령지</th>
            </tr>
            </thead>
            <?php
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $sql3 = mq("select * from order_list where userid = '$_SESSION[userid]';");
            $row_num = mysqli_num_rows($sql3);
            $list = 5;
            $block_ct = 5;

            $block_num = ceil($page / $block_ct); // 현재 페이지 블록 구하기 ceil() -> 소수점 자리를 무조건 올리는 함수(올림) (ex. ceil(0.1111) = 1, ceil(88.3) = 89 )
            $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
            $block_end = $block_start + $block_ct - 1; // 블록의 마지막 번호

            $total_page = ceil($row_num / $list); // 페이지 수 구하기

            if ($block_end > $total_page) { // 블록의 마지막 번호가 페이지수보다 많다면 마지막 번호는 페이지 수
                // 해당 코드가 없으면 게시글이 없어도 지정해놓은 블록이 다 표시된다.
                $block_end = $total_page;
            }
            $total_block = ceil($total_page / $block_ct); // 블록의 총 개수
            $start_num = ($page - 1) * $list;


            $sql = mq("select * from order_list where userid='$_SESSION[userid]' order by idx desc limit $start_num, $list;");
            while($board = $sql->fetch_array()) {
                $sql2 = mq("select * from product where idx= $board[pidx];");
                $board2 = $sql2 ->fetch_array();
                ?>
                <tbody>
                <tr>
                    <td><?php echo $board['date'] ?></td>
                    <td>
                        <?php
                        $file = $board2['pimage'];
                        echo "<img src='/ChanStyle/images/product/$file' style='width: 100px; height: 120px; padding: 5px;'>";
                        ?>
                    </td>
                    <td><?php echo $board['pname']?></td>
                    <td>
                        <?php
                        $price = $board2['pprice'] * $board['pcount'];
                        echo "$price($board[pcount]개)";
                        ?>
                    </td>
                    <td><?php echo $board['name']?></td>
                    <td><?php echo $board['address']?></td>
                </tr>
                </tbody>

            <?php } ?>
        </table>
        <div class="text-center m-b-50">
            <div class="pagination2">
                <?php
                if ($page <= 1) {

                } else {
                    echo "<a href='?page=1'>처음</a>"; // 처음으로
                }

                if ($page <= 1) {

                } else {
                    $pre = $page - 1; // 이전페이지로
                    echo "<a href='?page=$pre'>이전</a>";
                }

                for ($i = $block_start; $i <= $block_end; $i++) {
                    if ($page == $i) {
                        echo "<a href='?page=$i' style='color: #09C;'>$i</a>";
                    } else {
                        echo "<a href='?page=$i'>$i</a>";
                    }
                }

                if ($page >= $total_page) {

                } else {
                    $next = $page + 1;
                    echo "<a href='?page=$next'>다음</a>";
                }

                if ($page >= $total_page) {

                } else {
                    echo "<a href='?page=$total_page'>마지막</a>";
                }
                ?>
            </div>
        </div>
    </div>


</main>

<footer style="float: left;" id="footer" class="bg3 p-t-50 p-b-20" include-html="/ChanStyle/BasicFooter.php">

</footer>
<script>
    includeHTML();
</script>
<script type="text/javascript" src="/ChanStyle/js/sidebar.js"></script>
</body>
</html>

