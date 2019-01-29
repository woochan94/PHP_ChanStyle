<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";
?>
<form action="http://localhost:3000/form_receiver" name="test_form" method="post">
    <input name="id" type="hidden" value="dncks25"/>
    <input name="name" type="hidden" value="<?php echo $_SESSION['username']?>"/>
    <input type="submit" value="정우찬님 채팅방" style="width: 440px; height: 40px;">
</form>

<form action="http://localhost:3000/form_receiver" name="test_form" method="post">
    <input name="id" type="hidden" value="test1"/>
    <input name="name" type="hidden" value="<?php echo $_SESSION['username']?>"/>
    <input type="submit" value="test1님과의 채팅방" style="width: 440px; height: 40px">
</form>