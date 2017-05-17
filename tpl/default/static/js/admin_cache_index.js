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
    updatefile_api = site_url + 'admin/cache/api/ajax/1';
    for (x = 0; x < filelist.length; x++) {
        var data = ansypost(updatefile_api, objToUrl({
            'method': 'updatefile',
            'cache-type': 'qcloud',
            'file': filelist[x]
        }), (function (responsetext) {
            var data = JSON.parse(responsetext);
            displaylog(data.message, data.num, filelist.length);
        }));
    }
}
function displaylog(info, now, all) {
    var textarea = document.querySelector(".information");
    var innertext = textarea.value;
    textarea.value = "第" + now + "/" + all + "个" + info + "\n" + innertext;
    return true;
}