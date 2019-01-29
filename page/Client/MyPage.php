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

    <style>
        .container2 input[type=text], input[type=password], input[type=email] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=submit] {
            background-color: black;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: red;
            transition: 0.3s;
        }

        .container2 {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            margin-top: 50px;
            margin-left: 150px;
            margin-bottom: 50px;
        }
    </style>
</head>

<body>
<!-- Header -->
<header class="header" include-html="/ChanStyle/BasicHeader.php">

</header>

<main>
    <div class="vertical-menu" style="height: 950px;">
        <div class="text-center m-text29 p-t-50 p-b-50">MY PAGE</div>
        <a href="/ChanStyle/page/Client/MyPage.php">
            <button class="tablinks m-text11">개인정보 수정</button>
        </a>
        <a href="/ChanStyle/page/Client/My_board.php">
            <button class="tablinks m-text11">내가 쓴 문의글</button>
        </a>
        <a href="/ChanStyle/page/Client/Order_list.php">
            <button class="tablinks m-text11">구매 내역</button>
        </a>
    </div>

    <div class="tabcontent page_content">
        <div class="m-text17">개인정보 수정</div>
        <?php
        $sql = mq("select * from userInfo where id = '$_SESSION[userid]';");
        $board = $sql->fetch_array();
        ?>

        <div class="container container2">
            <form action="/ChanStyle/page/Client/Info_modify_ok.php" method="post">
                <label for="fname">ID</label>
                <input type="text" id="fname" name="firstname" value="<?php echo $board['id'] ?>" disabled>

                <label for="lname">Name</label>
                <input type="text" id="lname" name="lastname" value="<?php echo $board['name'] ?>" disabled>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="password" required>

                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" placeholder="new_password">

                <label for="new_password_confirm">New Password Confirm</label>
                <input type="password" id="new_password_confirm" name="new_password_confirm"
                       placeholder="new_password_confirm">
                <div class="m-t-10" id="alert-success" style="color: #008000;">비밀번호가 일치합니다.</div>
                <div class="m-t-10" id="alert-danger" style="color: #FF0000;">비밀번호가 일치하지 않습니다.</div>

                <script type="text/javascript">
                    $(function () {
                        $("#alert-success").hide();
                        $("#alert-danger").hide();
                        $("input").keyup(function () {
                            var pwd1 = $("#new_password").val();
                            var pwd2 = $("#new_password_confirm").val();
                            if(pwd1 != "" || pwd2 != ""){
                                if(pwd1 == pwd2){
                                    $("#alert-success").show();
                                    $("#alert-danger").hide();
                                    $("#submit").removeAttr("disabled");
                                }else{
                                    $("#alert-success").hide();
                                    $("#alert-danger").show();
                                    $("#submit").attr("disabled", "disabled");
                                }
                            }
                        });
                    });
                </script>

                <label for="email">E-MAIL</label>
                <input type="email" id="email" name="email" value="<?php echo $board['email'] ?>">

                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="<?php echo $board['phone'] ?>">

                <input type="submit" style="width: 100%;" value="수정">
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

