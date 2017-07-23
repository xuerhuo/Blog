// $(document).ready(function () {
//     jQuery(".showimg").hover(function () {
//         var position = jQuery(this).position().left + 55;
//         var positiont = jQuery("table").width() / 2;
//         if (position <= positiont) {
//             jQuery(".topimg").css("left", position + "px");
//             jQuery(".topimg").show();
//             var imgUrl = jQuery(this)[0].src;
//             jQuery(".topimg img").attr('src', imgUrl);
//         } else {
//             jQuery(".topimg").css({"left": position + "px", "margin-left": "-660px"});
//             jQuery(".topimg").show();
//             var imgUrl = jQuery(this)[0].src;
//             jQuery(".topimg img").attr('src', imgUrl);
//         }
//     }, function () {
//         jQuery(".topimg").hide();
//         jQuery(".topimg img").attr('src', '');
//     })
// });
// $(document).ready(function () {
//
// });
window.onload = function () {
    addEvent(".showimg", "click", imgshow);
}

function imgshow() {
    var divNode = document.createElement("div");
    divNode.style.cssText = "    top: 0px;\
    bottom: 0px;\
    left: 0px;\
    right: 0px;\
    background-color: rgb(0, 0, 0);\
    position: fixed;\
    opacity: 0.93;";
    var bodyNode = document.querySelector("body");

    var divNode2 = document.createElement("div");
    divNode2.style.cssText = "\
    background-color:#000000\
    display:inline-block;\
    margin: 0 auto;\
    text-align:center;\
    width:100%;\
    max-height:80%;\
    ";

    var imgNode = document.createElement("img");
    imgNode.src = this.src;
    imgNode.style.cssText = "height: 100%;\
    display: inline-block;";

    divNode2.appendChild(imgNode);

    divNode.appendChild(divNode2);
    bodyNode.appendChild(divNode);

    divNode.addEventListener("click", function () {
        bodyNode.removeChild(divNode);
    })

}

function buquanpic(obj, url) {
    console.log(obj);
    var src = obj.src;
    console.log(url);
    obj.src = site_url + "/data/file/" + url;
    console.log(obj.src);
}