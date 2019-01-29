<?php
include $_SERVER["DOCUMENT_ROOT"] . "/ChanStyle/db.php";

$bno = $_POST['bno'];
$size = $_POST['size'];
$sql = mq("select * from product where idx = $bno");
$product = $sql->fetch_array();

echo $product['pimage'];

$sql2  = mq("insert into cart(userid, pid, pname, psize, pprice, pimage) values('$_SESSION[userid]', '$product[idx]', '$product[pname]', '$size', '$product[pprice]', '$product[pimage]');");
?>
<script type="text/javascript">location.replace("/ChanStyle/page/Shop/Product.php?idx=<?php echo $bno; ?>");</script>
