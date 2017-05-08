$(document).ready(function () {
    $(".menu .menuf li div").click(function () {
        $(this).parent().find("ul").slideToggle();

        if ($(this).parent().find(".open").hasClass("open") == false) {
            $(".menu .menuf li>.open").parent().find("ul").slideUp();
        }

        $(".menu .menuf li>.open").removeClass("open");
        $(this).addClass("open");


        if ($(this).find(".glyphicon-chevron-down").hasClass("glyphicon-chevron-down") == true) {
            $(this).find("span:last-child").removeClass("glyphicon-chevron-down");
            $(this).find("span:last-child").addClass("glyphicon-chevron-left");//上拉
        } else {
            $(".glyphicon-chevron-down").addClass("glyphicon-chevron-left");
            $(".glyphicon-chevron-down").removeClass("glyphicon-chevron-down");//取消所有向下状态
            $(this).find("span:last-child").removeClass("glyphicon-chevron-left");
            $(this).find("span:last-child").addClass("glyphicon-chevron-down");//下弹
        }

    });
    $(".menu .menuf .menus>li>a").click(function () {
        $(".menu .menuf .menus .menusactive").removeClass("menusactive");
        $(this).addClass("menusactive");

        $(".menu .menuf li>.opened").removeClass("opened");
        $(this).parent().parent().parent().find("div").addClass("opened");

    });

    //切换ifram
    $(".menu .menuf .menus li a").click(function () {
        $("#windows").attr("src", $(this).attr("href"));
        return false;
    });
});