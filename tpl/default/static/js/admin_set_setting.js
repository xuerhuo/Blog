/**
 * Created by erhuo on 2017/2/17.
 */

window.onload = function () {
    var inputName = '';
    var _editor = '';
    addEvent(".wrap .title .c-menu a", "click", menuclick);
    addEvent(".wrap #c-menu-addsetting .bottom .post", "click", addSetting);
    initueditor();
}

function openuploadframe(name) {
    inputName = name;
    _editor.getDialog("insertimage").open();
}

function initueditor() {
    _editor = UE.getEditor('ueditor');
    _editor.ready(function () {

        _editor.setDisabled();
        _editor.hide();
        _editor.addListener("beforeinsertimage", function (t, arg) {
            uploadcallback(arg);
            console.log(t, arg);
            // console.log(JSON.stringify(arg));
        });
        _editor.addListener("afterupfile", function (t, arg) {
            uploadcallback(arg);
            console.log(t, arg);
            // console.log(JSON.stringify(arg));
        });
    });
}

function uploadcallback(obj) {
    var input = document.getElementsByName(inputName)[0];
    input.value = obj[0].src;
    alert("上传成功");
}
function menuclick() {
    if (document.querySelector("#c-menu-addsetting").style.display == "none") {
        document.querySelector("#c-menu-addsetting").style.display = 'block';
        document.querySelector("#c-menu-content").style.display = 'none';
        document.querySelectorAll(".wrap .title .c-menu a")[0].setAttribute("class", '');
        document.querySelectorAll(".wrap .title .c-menu a")[1].setAttribute("class", 'selected');
    } else {
        document.querySelector("#c-menu-addsetting").style.display = 'none';
        document.querySelector("#c-menu-content").style.display = 'block';
        document.querySelectorAll(".wrap .title .c-menu a")[0].setAttribute("class", 'selected');
        document.querySelectorAll(".wrap .title .c-menu a")[1].setAttribute("class", '');
    }
}
function addSetting(e) {
    e.preventDefault();
    var url = document.querySelector("#c-menu-addsetting form").action;
    var oparam = {
        "set_name": document.querySelector("#c-menu-addsetting input[name='set_name']").value,
        "option_type": document.querySelector("#c-menu-addsetting input[name='option_type']").value,
        "set_guid": document.querySelector("#c-menu-addsetting input[name='set_guid']").value,
        "tips": document.querySelector("#c-menu-addsetting input[name='tips']").value,
        "menu_alias": document.querySelector("#c-menu-addsetting input[name='menu_alias']").value,
        "data_table": document.querySelector("#c-menu-addsetting input[name='data_table']").value,
        "field": document.querySelector("#c-menu-addsetting input[name='field']").value,
    };
    if (oparam.option_type == '' || oparam.set_guid == '' || oparam.set_name == '') {
        alert("请填写空白处内容");
        return;
    }
    var param = objToUrl(oparam);
    post(url + "/ajax/1", param, function () {
        if (xmlhttp.readyState == 4) {
            alert("send success");
        }
    })
}