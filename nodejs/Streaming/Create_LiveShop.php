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
    <!-- BootStrap -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/bootstrap/css/bootstrap.min.css">
    <!-- semantic -->
    <link rel="stylesheet" type="text/css" href="/ChanStyle/vendor/semantic/semantic.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="/ChanStyle/vendor/semantic/semantic.js"></script>
    <!-- includeHTML -->
    <script src="/ChanStyle/js/includeHTML.js"></script>

    <style>
        .enrollment_container {
            border-radius: 5px;
            background-color: #f2f2f2;
            width: 1200px;
            height: 400px;
            padding: 20px;
            margin-bottom: 100px;
        }

        .col-25 {
            float: left;
            width: 25%;
            margin-top: 30px;
        }

        .col-75 {
            float: left;
            width: 75%;
            margin-top: 30px;
        }

        .enrollment_container label {
            padding: 12px 12px 12px 70px;
            display: inline-block;
            font-size: 20px;
            margin-left: 30px;
        }

        .enrollment_container input[type=text], select, textarea {
            width: 85%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        .enrollment_container input[type=submit] {
            width: 100%;
            background-color: #09C;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
            margin-left: 100px;
            margin-right: 135px;
            margin-top: 30px;
        }

        .enrollment_container input[type=submit]:hover {
            background-color: red;
        }
    </style>
</head>

<body>
<!-- Header -->
<header class="header" include-html="/ChanStyle/BasicHeader.php">

</header>

<main>
    <div class="container">
        <div class="m-t-45 m-b-70">
            <h4 class="m-text17">LiveShop 시작하기</h4>
        </div>
        <div class="enrollment_container">
            <form action="http://localhost:3000/form_receiver" method="post">
                <input type="hidden" id="name" name="name" value="<?php echo $_SESSION['username']?>">
                <div class="row">
                    <div class="col-25">
                        <label for="title">방송 제목</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="title" name="title" placeholder="방송 제목" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="pname">상품 명</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="pname" name="pname" placeholder="상품명" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="pprice">상품 가격</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="pprice" name="pprice" placeholder="상품가격" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <input type="submit" value="만들기">
                </div>
            </form>
        </div>
    </div>

</main>

<footer id="footer" class="bg3 p-t-50 p-b-20" include-html="/ChanStyle/BasicFooter.php">

</footer>
<script>
    includeHTML();
</script>
<script type="text/javascript" src="/ChanStyle/js/sidebar.js"></script>
</body>
</html>


