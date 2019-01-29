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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Select Box -->
    <script type="text/javascript">
        $(function () {
            $('#pgroup1').click(function () {
                var top = ["T-shirt", "Sweat_shirt", "Shirt", "Knite", "Cardigan"];
                var bottom = ["Blue jeans","Black jeans","Slacks","Cotton pants", "shorts"];
                var outer = ["Coat","Padding","Jacket"];
                var shoes = ["Sneakers", "Boots", "Loafers", "Derby Shoes", "Sandals/Slippers"];
                var bag = ["Backpack", "Cross bag", "clutches", "Tote bag", "Suitcase"];
                var accesories = ["Belt", "Socks", "Hat", "ETC"];
                var selectItem = $('#pgroup1').val();
                var changeItem;
                if (selectItem == "TOP") {
                    changeItem = top;
                } else if(selectItem == "BOTTOM") {
                    changeItem = bottom;
                } else if(selectItem == "OUTER") {
                    changeItem = outer;
                } else if(selectItem == "SHOES") {
                    changeItem = shoes;
                } else if(selectItem == "BAG") {
                    changeItem = bag;
                } else if(selectItem == "ACCESORIES") {
                    changeItem = accesories;
                }

                $('#pgroup2').empty();
                for (var count = 0; count < changeItem.length; count++) {
                    var option = $("<option>" + changeItem[count] + "</option>");
                    $('#pgroup2').append(option);
                }
            });
        });
    </script>
</head>

<body>
<!-- Header -->
<header class="header" include-html="/ChanStyle/BasicHeader.php">

</header>

<main>
    <div class="vertical-menu" style="height: 750px;">
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


    <div id="product_enrollment" class="tabcontent product_enrollment_div">
        <div class="m-text17">상품 등록</div>
        <div class="enrollment_container">
            <form action="/ChanStyle/page/Admin/enroll_ok.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-25">
                        <label for="pname">상품 명</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="pname" name="product_name" placeholder="상품명" autocomplete="off" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="pprice">상품 가격</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="pprice" name="product_price" placeholder="상품 가격" autocomplete="off" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="pgroup1">대분류</label>
                    </div>
                    <div class="col-75">
                        <select id="pgroup1" name="product_group1" required>
                            <option>선택</option>
                            <option value="TOP">상의</option>
                            <option value="BOTTOM">하의</option>
                            <option value="OUTER">자켓</option>
                            <option value="SHOES">신발</option>
                            <option value="BAG">가방</option>
                            <option value="ACCESORIES">악세사리</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="pgroup2">소분류</label>
                    </div>
                    <div class="col-75">
                        <select id="pgroup2" name="product_group2" required></select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="inventory">재고량</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="inventory" name="product_inventory" placeholder="재고량" autocomplete="off" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="pimage">상품 이미지</label>
                    </div>
                    <div class="col-75">
                        <input style="padding-top: 10px" type="file" id="pimage" name="product_image" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="pimage">상품 상세</label>
                    </div>
                    <div class="col-75">
                        <input style="padding-top: 10px" type="file" id="pimage_detail" name="product_detail_image" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="pimage">사이즈 상세</label>
                    </div>
                    <div class="col-75">
                        <input style="padding-top: 10px" type="file" id="size_detail" name="size_image" required>
                    </div>
                </div>

                <div class="row">
                    <input type="submit" value="등록">
                </div>

            </form>
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

