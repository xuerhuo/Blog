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
                filelist = data.data[0];
            }
        }
    });
    console.log(filelist);
    for (var x in filelist) {
        console.log(x);
    }
}