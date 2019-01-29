$(document).ready(function(){
    $('.side_bar').click(function () {
        $('.ui.sidebar').sidebar('setting', 'transition', 'overlay').sidebar('toggle');
    });
});


