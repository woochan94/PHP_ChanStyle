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
        <div class="m-text17">내가 쓴 문의글</div>

        <table class="list-mypage-board">
            <thead>
            <tr>
                <th width="70">번호</th>
                <th style="text-align: center" width="500">제목</th>
                <th width="120">글쓴이</th>
                <th width="120">작성일</th>
                <th width="100">조회수</th>
            </tr>
            </thead>
            <?php
            // 현재 페이지를 알기 위한 변수 $page
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else { // 처음 접속하면 page에 값이 없기때문에 page변수에 1을 넣는다.
                $page = 1;
            }
            $sql = mq("select * from board where id = '$_SESSION[userid]';");
            $row_num = mysqli_num_rows($sql); // 게시판 총 레코드 수
            $list = 5; // 한 페이지에 보여줄 개수
            $block_ct = 5; // 블록당 보여줄 페이지 개수 -> 1~5까지가 블록1, 6~10이 블록2 ...

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

            $sql2 = mq("select * from board where id='$_SESSION[userid]' order by idx desc limit $start_num, $list");
            while($board = $sql2->fetch_array()) {
                $idx = $board["idx"];
                $title = $board["title"];

                $sql3 = mq("select * from reply where con_num='".$board['idx']."'"); //reply테이블에서 con_num이 board의 idx와 같은 것을 선택
                $rep_count = mysqli_num_rows($sql3); //num_rows로 정수형태로 출력
                $sql4 = mq("select * from re_reply where re_num = $board[idx]");
                $rep_count2 = mysqli_num_rows($sql4);
                $rep_count3 = $rep_count+$rep_count2;
                ?>
                <tbody>
                <tr>
                    <td><?php echo $board['idx'] ?></td>
                    <td width="500">
                        <?php
                        $lockimg = "<img src='/ChanStyle/images/lock1.png' title='lock' width='17' height='17'>";
                        if ($board['lock_post'] == "1") {
                        if (isset($_SESSION['userid']) && $_SESSION['userid'] === "admin") { // 관리자는 비공개 게시물도 비밀번호 없이 볼수 있어야 한다.
                        ?><a class="acolor" href="/ChanStyle/board/read.php?idx=<?php echo $board["idx"]; ?>"><?php echo $lockimg, $title; if($rep_count != "0"){?><span style="color: #FF0000">[<?php echo $rep_count3;?>]</span><?php }
                            }else {?><a class="acolor" href='/ChanStyle/board/ck_read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $lockimg, $title; if($rep_count != "0") {?><span style="color: #FF0000">[<?php echo $rep_count3;?>]</span><?php } }
                                }else { ?><a class="acolor" href='/ChanStyle/board/read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title; if($rep_count != "0") {?><span style="color: #FF0000">[<?php echo $rep_count3;?>]</span><?php } } ?></a>
                    </td>
                    <td width="120"><?php echo $board['name'] ?></td>
                    <td width="100"><?php echo $board['date'] ?></td>
                    <td width="100"><?php echo $board['hit']; ?></td>
                </tr>
                </tbody>
            <?php }
            ?>
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

