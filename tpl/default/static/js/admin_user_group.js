function group_edit(x) {
    var cats = x.parentNode.parentNode.children;
    document.getElementsByName('id')[0].value = cats[0].innerText;
    document.getElementsByName('group_name')[0].value = cats[1].innerText;
    if (cats[2].innerText.length > 0) {
        selected(document.getElementsByName("parent_group")[0], cats[2].innerText);
    } else {
        selected(document.getElementsByName("parent_group")[0], 0);
    }
}
