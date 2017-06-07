/**
 * Created by erhuo on 2017/2/21.
 */
window.onload = function () {
    addEvent("#comment button", "click", postcoment);
    articlemarkdown();
}
function postcoment(e) {
    // e.preventDefault();
    var comment_content = document.querySelector("#comment_content").value;
    var comment_name = document.querySelector("#comment_name").value;
    var id = document.querySelector("#article_id").value;
    var url = this.parentNode.action;
    var param = objToUrl({
        "comment_name": comment_name,
        "comment_content": comment_content,
        "method": "add",
        "type": "article",
        "id": id
    });
    post(url + "/ajax/1", param, commentcallback);

}
function commentcallback() {
    if (xmlhttp.readyState == 4) {
        var data = JSON.parse(xmlhttp.responseText);
        if (data.status) {
            msg("评论成功");
        } else {
            msg("评论失败");
        }
    }
}
function mark() {
    alert("terst");
    if (xmlhttp.readyState == 4) {
        markdown = xmlhttp.responseText;
        alert(markdown);
    }
    alert(markdown);
}
function articlemarkdown() {

    var testEditormdView, testEditormdView2;
    var markdown = document.querySelector("#article_content #markdown").innerHTML;
    document.querySelector("#article_content #markdown").style.display = "none";
    //a(markdown);
    // function a(markdown) {
    //    alert(markdown);

    post(getRequest() + "ajax/1", null, function () {
        if (xmlhttp.readyState == 4) {
            markdown = xmlhttp.responseText;
            editormd.markdownToHTML("markdown-view", {
                markdown: markdown,//+ "\r\n" + $("#append-test").text(),
                htmlDecode: true,       // 开启 HTML 标签解析，为了安全性，默认不开启
                //htmlDecode      : "style,script,iframe",  // you can filter tags decode
                //toc             : false,
                tocm: true,    // Using [TOCM]
                //tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
                //gfm             : false,
                //tocDropdown     : true,
                // markdownSourceCode : true, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
                //emoji           : true,
                taskList: true,
                tex: true,  // 默认不解析
                flowChart: true,  // 默认不解析
                sequenceDiagram: true,  // 默认不解析

            });
        }
    });
    //alert(markdown);
    /* testEditormdView = editormd.markdownToHTML("markdown-view", {
     markdown        : markdown ,//+ "\r\n" + $("#append-test").text(),
     htmlDecode      : true,       // 开启 HTML 标签解析，为了安全性，默认不开启
     //htmlDecode      : "style,script,iframe",  // you can filter tags decode
     //toc             : false,
     tocm            : true,    // Using [TOCM]
     //tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
     //gfm             : false,
     //tocDropdown     : true,
     // markdownSourceCode : true, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
     emoji           : true,
     taskList        : true,
     tex             : true,  // 默认不解析
     flowChart       : true,  // 默认不解析
     sequenceDiagram : true,  // 默认不解析

     });*/
    //    }
    //console.log("返回一个 jQuery 实例 =>", testEditormdView);

    // 获取Markdown源码
    //console.log(testEditormdView.getMarkdown());

    //alert(testEditormdView.getMarkdown());

    //alert(markdown);
    /*     testEditormdView2 = editormd.markdownToHTML("markdown", {
     markdown: markdown,
     //htmlDecode      : "style,script,iframe",  // you can filter tags decode
     htmlDecode      : true,
     //emoji           : true,
     taskList        : true,
     tex             : true,  // 默认不解析
     flowChart       : true,  // 默认不解析
     sequenceDiagram : true,  // 默认不解析
     });*/

}
