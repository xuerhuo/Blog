window.onload = function () {
    var inputName = '';
    var _editor = '';
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