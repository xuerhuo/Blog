window.onload = function () {
    var flushqcloudbutton = document.querySelector(".flush-qcloud");
    addEvent(".flush-qcloud", "click", flushqcloud);
}
function flushqcloud() {
    var getfile_api = site_url + 'admin/cache/api/ajax/1';
    var filelist = "sdf";
    post(getfile_api, objToUrl({'method': 'getfile', 'cache-type': 'qcloud'}), function () {
        if (xmlhttp.readyState == 4) {
            var data = JSON.parse(xmlhttp.responseText);
            if (data.status == true) {
                alert("获取文件列表完毕");
                filelist = data.data;
                updateqcloudfile(filelist);
            }
        }
    });
}
function updateqcloudfile(filelist) {
    var updatefile_api = site_url + 'admin/cache/api/ajax/1';
    for (var x = 0; x < 10; x++) {

        var data = syncpost(updatefile_api, objToUrl({
            'method': 'updatefile',
            'cache-type': 'qcloud',
            'file': filelist[x]
        }), function (xmlhttp) {
            displaylog(xmlhttp, x, filelist.length);
        });
    }
}
function displaylog(info, now, all) {
    var data = JSON.parse(info.responseText);
    var textarea = document.querySelector(".information");
    var innertext = textarea.value;
    console.info(innertext, data.message);
    textarea.value = innertext + "\n第" + now + "/" + all + "个" + data.message;
}