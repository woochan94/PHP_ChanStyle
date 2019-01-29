<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";
?>
<form action="http://localhost:3000/form_receiver" method="post">
    <input name="name" type="hidden" value="<?php echo $_SESSION['username']?>"/>
    <input name="id" type="hidden" value="dncks25"/>
    <input type="submit" value="정우찬 채팅방">
</form>
<form action="http://localhost:3000/form_receiver" method="post">
    <input name="name" type="hidden" value="<?php echo $_SESSION['username']?>"/>
    <input name="id" type="hidden" value="test1"/>
    <input type="submit" value="test1 채팅방">
</form>
