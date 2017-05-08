$(document).ready(function () {
    $(".menu-list li").css('text-indent', function () {
        var x = $(this).attr('data-level');
        return x * 4 + "ch";
    })
});