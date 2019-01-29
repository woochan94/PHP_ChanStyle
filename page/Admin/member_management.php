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

    <div id="product_manage" class="tabcontent product_manage_div">
        <div class="m-text17">회원 관리</div>
        <table class="list_member_manage">
            <thead>
            <tr>
                <th width="60">번호</th>
                <th width="100">아이디</th>
                <th width="100">이름</th>
                <th width="200">email</th>
                <th width="150">전화</th>
                <th width="350">주소</th>
                <th width="100">탈퇴</th>
            </tr>
            </thead>
            <?php
            $sql = mq("select * from userInfo where id not in('admin')");
            while($board = $sql->fetch_array()) {
                ?>
                <tbody>
                <tr>
                    <td width="45" style="text-align: left"><?php echo $board['idx']; ?></td>
                    <td width="100"><?php echo $board['id']; ?></td>
                    <td width="100"><?php echo $board['name']; ?></td>
                    <td width="200"><?php echo $board['email']; ?></td>
                    <td width="150"><?php echo $board['phone']; ?></td>
                    <td width="350"><?php echo $board['address']; ?></td>
                    <td width="100"><button>탈퇴</button></td>
                </tr>
                </tbody>
            <?php
            }
            ?>
        </table>
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
</main>

<footer style="float: left;" id="footer" class="bg3 p-t-50 p-b-20" include-html="/ChanStyle/BasicFooter.php">

</footer>
<script>
    includeHTML();
</script>
<script type="text/javascript" src="/ChanStyle/js/sidebar.js"></script>
</body>
</html>


