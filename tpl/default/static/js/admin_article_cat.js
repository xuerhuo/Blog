function cat_edit(x) {
    var cats = x.parentNode.parentNode.children;
    document.getElementsByName('cat_id')[0].value = cats[0].innerText;
    document.getElementsByName('cat_name')[0].value = cats[1].innerText;
    if (cats[2].innerText.length > 0) {
        selected(document.getElementsByName("parent_cat")[0], cats[2].innerText);
    } else {
        selected(document.getElementsByName("parent_cat")[0], 0);
    }
}
function clearInput() {
    var aIn = document.getElementsByTagName('input');
    for (var i = 0; i < aIn.length; i++) {
        aIn[i].value = '';
    }
    return false;
}
function selected(oSelect, sValue) {
    for (var i = 0; i < oSelect.options.length; i++) {
        if (oSelect.options[i].value == sValue || oSelect.options[i].innerText == sValue) {
            oSelect.options[i].setAttribute("selected", true);
        } else {
            oSelect.options[i].removeAttribute('selected');
        }
    }
    return;
}