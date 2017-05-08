jQuery(function () {
    jQuery(".c-menu a").click(function () {
        var index = jQuery(this).index();
        jQuery(this).addClass("selected").siblings("a").removeClass("selected");
        jQuery(".c-ment-content").eq(index).show().siblings(".c-ment-content").hide();
    });
    //按钮单击时执行
    $("#submit1").click(function () {
        //Ajax调用处理
        var alias = document.getElementById("alias").value;
        var tpl = document.getElementById("tpl").value;
        var sect = document.getElementById("sect").value;
        var SubmitInfo = {
            alias: alias,
            tpl: tpl,
            sect: sect
        };
        var url = 'http://www.hechuancheng.com/admin/set/curdmodel/ajax/1';
        $.ajax({
            type: "POST",
            url: url,
            data: SubmitInfo,
            dataType: "json",
            success: function (data) {
                if (data.status == '1') {
                    alert("提交成功！");
                    //  window.location= window.location;
                }
            },
            complete: function (XMLHttpRequest, textStatus) {
                return;
            },
            error: function () {
                return;
            }
        });

    });
    $("#submit2").click(function () {
        //Ajax调用处理
        var setname = document.getElementById("set_name").value;
        var optiontype = document.getElementById("option_type").value;
        var menualias = document.getElementById("menu_alias").value;
        var setguid = document.getElementById("set_guid").value;
        var tips = document.getElementById("tips").value;
        var data_table = document.getElementById("data_table").value;
        var field = document.getElementById("field").value;
        var SubmitInfo = {
            set_name: setname,
            option_type: optiontype,
            menu_alias: menualias,
            set_guid: setguid,
            tips: tips,
            data_table: data_table,
            field: field
        };
        var url = 'http://www.hechuancheng.com/admin/set/setting/method/addsetting/ajax/1';
        $.ajax({
            type: "POST",
            url: url,
            data: SubmitInfo,
            dataType: "json",
            success: function (data) {
                console.log(data.status);
                if (data.status != false) {
                    alert("提交成功！");
                    // window.location= window.location;
                }
            },
            complete: function (XMLHttpRequest, textStatus) {
                return;
            },
            error: function () {
                return;
            }
        });

    });
});