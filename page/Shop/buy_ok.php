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
        .btn-large {
            padding: 1.5rem 1.5rem;
            font-size: 1.25rem;
            line-height: 1.5;
            border-radius: .3rem;
            font-weight: bold;
            font-size: 20px;
        }
        #buy_info {
            border-collapse: collapse;
        }

        #buy_info td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

    </style>
</head>

<body>
<!-- Header -->
<header class="header" include-html="/ChanStyle/BasicHeader.php">

</header>

<main>
    <?php
    $name = $_POST['firstname']; // 수령인
    $email = $_POST['email'];
    $postnum = $_POST['postnum'];
    $address1 = $_POST['useraddress1'];
    $address2 = $_POST['useraddress2'];
    $address = $address1. ' '. $address2;
    $phone = $_POST['phone'];
    $memo = $_POST['memo'];

    if(!empty($_POST['test'])){
        foreach ($_POST['test'] as $key => $data) {
            $value[] = "{$data}";
        }
        //$data2 = 구매한 각 상품의 수량
        foreach ($_POST['count'] as $key => $data2) {
            $value2[] = "{$data2}";
        }

        // 구매한 아이템들의 재고량 감소 및 판매량 증가
        for($i = 0; $i < count($value); $i++) {
            $sql4 = mq("select * from cart where idx = '$value[$i]';");
            $board3 = $sql4->fetch_array();
            $sql5 = mq("select * from product where idx = '$board3[pid]';");
            $board4 = $sql5->fetch_array();

            // 주문 리스트에 구매목록 insert
            $sql3 = mq("insert into order_list(name, email, postnum, address, phone, memo, pidx, pname, userid, pcount) 
                    values('$name','$email','$postnum','$address','$phone','$memo','$board4[idx]','$board3[pname]','$_SESSION[userid]','$value2[$i]');");

            $inventory = $board4['inventory']-$value2[$i];
            $sales = $board4['sales'] + $value2[$i];

            $sql6 = mq("update product set inventory='$inventory', sales='$sales' where idx='$board3[pid]';");
            // 장바구니에서 삭제
            $sql7 = mq("delete from cart where idx='$value[$i]';");
        }

    }else {
        $pnum = $_POST['pnum'];
        $sql = mq("select * from product where idx='$pnum';");
        $board = $sql->fetch_array();
        $sql2 = mq("insert into order_list(name, email, postnum, address, phone, memo, pidx, pname, userid,pcount) values ('$name','$email','$postnum','$address','$phone','$memo','$board[idx]','$board[pname]','$_SESSION[userid]','1');");
        // 구매한 아이템들의 재고량 감소 및 판매량 증가
        $inventory = $board['inventory'] -1;
        $sales = $board['sales'] + 1;
        $sql3 = mq("update product set inventory='$inventory', sales='$sales' where idx='$pnum';");
    }

    ?>
    <div class="container m-t-50">
        <div class="m-text17">주문 완료</div>
        <hr color="#e6e6e6" style="height: 2px;">
        <div class="m-t-100 m-b-100" style="text-align: center; font-size: 45px">
            고객님의 <span style="color: tomato;">주문이 정상적으로 완료</span>되었습니다.
        </div>

        <div class="m-b-50" style="text-align: center">
            <button class="btn btn-large m-r-40"> <a href="/ChanStyle/page/Shop/Shop_Main.php" style="color: #000;">계속 쇼핑하기</a> </button>
            <button class="btn btn-primary btn-large"> <a href="/ChanStyle/page/Client/Order_list.php" style="color: white;">구매 내역 확인하기</a></button>
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


