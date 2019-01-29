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
    <link rel="stylesheet" type="text/css" href="/ChanStyle/css/adminpage.css">
    <!-- BootStrap -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/bootstrap/css/bootstrap.min.css">
    <!-- semantic -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/semantic/semantic.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="/ChanStyle/vendor/semantic/semantic.js"></script>
    <!-- includeHTML -->
    <script src="/ChanStyle/js/includeHTML.js"></script>
    <!-- ajax -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<!-- Header -->
<header class="header" include-html="/ChanStyle/BasicHeader.php">
</header>

<main>
    <div class="vertical-menu" style="height: 800px;">
        <div class="text-center m-text29 p-t-50 p-b-50">관리자 페이지</div>
        <a href="/ChanStyle/page/Admin/adminPage.php"><button class="tablinks m-text11">상품관리</button></a>
        <a href="/ChanStyle/page/Admin/product_enrollment.php"><button class="tablinks m-text11">상품등록</button></a>
        <button style="padding-left: 70px" class="dropdown-btn tablinks m-text11">문의<i class="fa fa-caret-down p-l-50 "></i></button>
        <div class="dropdown-container vertical-menu2">
            <a href="/ChanStyle/page/Admin/no_question.php"><button class="tablinks m-text11">미답변 문의</button></a>
            <a href="/ChanStyle/page/Admin/complete_question.php"><button class="tablinks m-text11">답변완료 문의</button></a>
        </div>
        <a href="/ChanStyle/page/Admin/member_management.php"><button class="tablinks m-text11">회원관리</button></a>
    </div>
    <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>


    <div id="product_manage" class="tabcontent product_manage_div">
        <div class="m-text17">상품 관리</div>
        <table class="list-product_manage">
            <thead>
            <tr>
                <th>번호</th>
                <th style="text-align: center; width: 150px;">상품이미지</th>
                <th style="text-align: center;" width="200">상품명</th>
                <th style="text-align: center;" width="100">가격</th>
                <th>대분류</th>
                <th>소분류</th>
                <th>재고량</th>
                <th>판매량</th>
                <th style="text-align: center">수정/삭제</th>
            </tr>
            </thead>
            <?php
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $sql2 = mq("select * from product");
            $row_num = mysqli_num_rows($sql2);
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

            $sql = mq("select * from product order by idx desc limit $start_num,$list");
            while($board = $sql->fetch_array()) {
                $idx = $board["idx"];
                ?>
                <tbody>
                <tr>
                    <td><?php echo $board['idx'] ?></td>
                    <td>
                        <?php
                        $file=$board['pimage'];
                        echo "<img src='../../images/product/$file' style='width: 100px; height: 120px; margin-top: 10px; margin-bottom: 10px;'>";
                        ?>
                    </td>
                    <td><?php echo $board['pname'] ?></td>
                    <td><?php echo $board['pprice'] ?></td>
                    <td><?php echo $board['pgroup1'] ?></td>
                    <td><?php echo $board['pgroup2'] ?></td>
                    <td><?php echo $board['inventory'] ?></td>
                    <td><?php echo $board['sales'] ?></td>
                    <td>
                        <?php
                        $idx = $board['idx'];
                        echo "<a href='/ChanStyle/page/Admin/product_modify.php?idx=$idx'><button>수정</button></a>";
                        echo "<a href='/ChanStyle/page/Admin/product_delete.php?idx=$idx'><button>삭제</button></a>";
                        ?>
                    </td>
                </tr>
                </tbody>
            <?php
            }
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


