window.onload = function () {
    var inputName='';
    var _editor='';
    var uploadType='';
    initueditor();
}
function openuploadframe(name,type) {
    inputName=name;
    uploadType=type;
    if(type.indexOf("img")) {
        _editor.getDialog("insertimage").open();
    }else if(type.indexOf("file")){
        _editor.getDialog("attachment").open();
    }
}
function initueditor() {
    _editor = UE.getEditor('ueditor');
    _editor.ready(function () {

        _editor.setDisabled();
        _editor.hide();
        _editor.addListener("beforeinsertimage", function (t, arg) {
            uploadcallback(arg);
            console.log(t,arg);
            // console.log(JSON.stringify(arg));
        });
        _editor.addListener("afterupfile", function (t, arg) {
            uploadcallback(arg);
            console.log(t,arg);
            // console.log(JSON.stringify(arg));
        });
    });
}
function uploadcallback(obj) {
    if(uploadType=='img'||uploadType=='file'){
        var input=document.getElementsByName(inputName)[0];
        console.log(obj,input);
        input.value=obj[0].src != undefined ? obj[0].src : obj[0].url;
    }else if(uploadType=='imgs'){
        var textareaNode=document.getElementsByName(inputName)[0];
        textareaNode.value=JSON.stringify(obj);
    }
    alert("上传成功");
}