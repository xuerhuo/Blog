$(document).ready(function () {
    jQuery(".showimg").hover(function () {
        var position = jQuery(this).position().left + 55;
        var positiont = jQuery("table").width() / 2;
        if (position <= positiont) {
            jQuery(".topimg").css("left", position + "px");
            jQuery(".topimg").show();
            var imgUrl = jQuery(this)[0].src;
            jQuery(".topimg img").attr('src', imgUrl);
        } else {
            jQuery(".topimg").css({"left": position + "px", "margin-left": "-660px"});
            jQuery(".topimg").show();
            var imgUrl = jQuery(this)[0].src;
            jQuery(".topimg img").attr('src', imgUrl);
        }
    }, function () {
        jQuery(".topimg").hide();
        jQuery(".topimg img").attr('src', '');
    })
});