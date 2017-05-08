/**
 * Created by erhuo on 2017/2/17.
 */

function addEvent(id, event, funcName) {
    var elements = document.querySelectorAll(id);
    if (elements.length > 0) {
        for (var i = 0; i < elements.length; i++) {
            elements[i].addEventListener(event, funcName);
        }
    }
}
function selectorsExec(selector, funcname) {
    objs = document.querySelectorAll(selector);
    for (var i = 0; i < objs.length; i++) {
        funcname(objs[i]);
    }
}

function post(url, param, callback) {
    if (window.XMLHttpRequest) {
// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (xmlhttp == null) {
        alert("xmlhttp init error")
        return;
    }
    if (url.indexOf("?") > -1) {
        url = url + "&" + Math.random();
    } else {
        url = url + "?" + Math.random();
    }
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(param);
    xmlhttp.onreadystatechange = callback;//发送事件后，收到信息了调用函数
}
function objToUrl(param) {
    var url = "";
    for (var name in param) {
        url = url + name + "=" + encodeURIComponent(param[name]) + "&";
    }
    url.substring(0, url.length - 1);
    return url;
}
function msg(text) {
    alert(text);
}
function getRequest() {
    var url = window.location.href + "/";
    return url;
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