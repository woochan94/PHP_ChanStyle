<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";
?>
<form action="http://localhost:3000/form_receiver" method="post">
    <input name="name" type="hidden" value = <?php echo $_SESSION['username'];?>>
    <input type="submit" value="채팅방 입장">
</form>
