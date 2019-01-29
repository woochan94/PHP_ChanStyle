$(document).ready(function(){
    $(".re_bt").click(function(){
        var params = $("form").serialize();
        console.log(params);
        $.ajax({
            type: 'post',
            url: 'reply_ok.php?=<?php echo $board["idx"]; ?>',
            data : params,
            dataType : 'html',
            success: function(data){
                $(".reply_view").html(data);
                $(".reply_content").val('');
            }
        });
    });

    $(".dat_edit_bt").click(function(){
        /* dat_edit_bt클래스 클릭시 동작(댓글 수정) */
        var obj = $(this).closest(".dap_lo").find(".dat_edit");
        obj.dialog({
            modal:true,
            width:650,
            height:200,
            title:"댓글 수정"});
    });

    $(".dat_delete_bt").click(function(){
        /* dat_delete_bt클래스 클릭시 동작(댓글 삭제) */
        var obj = $(this).closest(".dap_lo").find(".dat_delete");
        obj.dialog({
            modal:true,
            width:400,
            title:"댓글 삭제"});
    });

    $(".dat_reply_bt").click(function () {
        var obj = $(this).closest(".dap_lo").find(".dat_reply");
        obj.dialog({
            modal:true,
            width:650,
            height:200,
            title:"답글 달기"});
    })
});

$(document).ready(function () {
    $("#review_submit").click(function () {
        var params = $("#review_form").serialize();
        console.log(params);
        $.ajax({
            type: 'post',
            url:'review_ok.php?=<?php echo $bno; ?>',
            data: params,
            dataType: 'html',
            success: function (data) {
                $("#review_content").val('');
                console.log(data);
            }
        });
    });
});