$(document).ready( function () {
    'use strict';
    
    var startDate = new Date(new Date().getTime() - 30 * 24 * 3600 * 1000);
    var endDate = new Date();
    
    function downloadUrlReload() {
        var url = download_url;
        url += '&datetime_start=\'' + startDate.getFullYear() + '-' + (startDate.getMonth() + 1) + '-' + startDate.getDate() + '\'';
        url += '&datetime_end=\'' + endDate.getFullYear() + '-' + (endDate.getMonth() + 1) + '-' + endDate.getDate() + '\'';
        $('#member-promotion-download').attr('href', url);
    }
    
    $('#organization_tree').jstree({
        "core" : {
            "themes" : {
                "responsive": false
            },
            "check_callback" : true
        },
        "types" : {
            "default" : {
                "icon" : "fa fa-sitemap icon-state-warning icon-lg"
            },
            "file" : {
                "icon" : "fa fa-file icon-state-warning icon-lg"
            }
        },
        "plugins": [ "contextmenu", "types"],
        'contextmenu': {
            'select_node': false,
            'items' : { 
                "create" : {
                    "label"             : "新建",
                    "action"            : function (data) {
                        var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                        var args = {
                            'classname':    '\\app\\models\\ClientOrganization',
                            'funcname':     'createAjax',
                            'params':       {
                                'client_id': 1,
                                'superior_id': obj.li_attr.organization_id,
                                'organization_title': '新建部门'
                            } 
                        };
                        $.ajax({
                            url:        ajax_url,
                            type:       "GET",
                            cache:      false,
                            dataType:   "json",
                            data:       "args=" + JSON.stringify(args),
                            success:    function(ret) { 
                                if (0 === ret['ret_code']) {
                                    inst.create_node(obj, {'text': '新建部门'}, "last", function (new_node) {
                                        new_node.text = '新建部门';
                                        new_node.li_attr = {'organization_id': ret['organization_id']};
//                                        inst.refresh_node(new_node);
                                        //setTimeout(function () { inst.edit(new_node); },0);
                                    });
                                }
                            },                        
                            error:      function(){
                                alert('发送失败。');
                            }
                        });                       
                    }
                },
                "rename" : {
                    "label"             : "更名",
                    "action"            : function (data) {
                        var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                        inst.edit(obj); 
                    }
                },
                "remove" : {
                    "label"             : "删除",
                    "action"            : function (data) {
                        var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                        if (obj.parent == '#') {
                            alert('根部门，不能删除！');
                            return;
                        }
                        var args = {
                            'classname':    '\\app\\models\\ClientOrganization',
                            'funcname':     'deleteAjax',
                            'params':       {
                                'organization_id': obj.li_attr.organization_id
                            } 
                        };
                        $.ajax({
                            url:        ajax_url,
                            type:       "GET",
                            cache:      false,
                            dataType:   "json",
                            data:       "args=" + JSON.stringify(args),
                            success:    function(ret) { 
                                if (0 === ret['ret_code']) {
                                    if(inst.is_selected(obj)) {
                                        inst.delete_node(inst.get_selected());
                                    }
                                    else {
                                        inst.delete_node(obj);
                                    }
                                } else {
                                    alert('该部门有下属部门，或员工，或门店，不能删除！');
                                }
                            },                        
                            error:      function(){
                                alert('发送失败。');
                            }
                        });                                              
                    }
                }                
            }
        }
    });
    
    $('#organization_tree').on("changed.jstree", function (e, data) {
        //        alert(data.node.li_attr.organization_id); 
        target_organization = data.node.li_attr.organization_id;
        redirectTo();
    });
    
    $('#organization_tree').on("rename_node.jstree", function (event, data) {
//        alert('organization_id='+data.node.li_attr.organization_id + ',text='+data.text+',old='+data.old);
        if (data.text == data.old)
            return;
        var args = {
            'classname':    '\\app\\models\\ClientOrganization',
            'funcname':     'renameAjax',
            'params':       {
                'organization_id': data.node.li_attr.organization_id,
                'organization_title': data.text,
            } 
        };
        $.ajax({
            url:        ajax_url,
            type:       "GET",
            cache:      false,
            dataType:   "json",
            data:       "args=" + JSON.stringify(args),
            success:    function(ret) { 
                if (0 === ret['ret_code']) {                                    
                }
            },                        
            error:      function(){
                alert('发送失败。');
            }
        });
    });
    
    $('#search').click( function () {
//        alert($('#search-key').val());
        redirectToSearch($('#search-key').val());
    });
    
    $('#search-key').keydown( function (e) {
        if (e.keyCode == 13) {
//            alert($('#search-key').val());
            redirectToSearch($('#search-key').val());
        }
    });
    
    function memberPromotionTopListReload(ret) {
        var content = '';
        for (var i = 0; i < ret.length; i++) {
            content += '<li><div class="col1"><div class="cont"><div class="cont-col1"><div><img style="width:32px;height:32px" src="';
            content += ret[i].imgurl + '" /></div></div><div class="cont-col2"><div class="desc"><a href="';
            content += ret[i].href + '">' + ret[i].name + '</a></div></div></div></div><div class="col2"><div class="date" style="padding:0px;">';
            content += ret[i].members + '</div></div></li>';
        }
        $('#member-promotion-top-list').html(content);
    }
    
    function memberPromotionTopListAjax() {
        var args = {
            'classname':    '\\app\\models\\MUser',
            'funcname':     'getMemberPromotionTopListAjax',
            'params':       {
                'cat': 0,
                'limit': 20,
                'datetime_start':  startDate.getFullYear() + '-' + (startDate.getMonth() + 1) + '-' + startDate.getDate() + ' 00:00:00' ,
                'datetime_end':   endDate.getFullYear() + '-' + (endDate.getMonth() + 1) + '-' + endDate.getDate() + ' 23:59:59',
            } 
        };
        var el = $('#member-promotion-top-list').closest(".portlet").children(".portlet-body");
        Metronic.blockUI({
            target: el,
            animate: true,
            overlayColor: 'none'
        });
        $.ajax({
            url:        "/wx/web/index.php?r=wapx/wapxajax",
            type:       "GET",
            cache:      false,
            dataType:   "json",
            data:       "args=" + JSON.stringify(args),
            success:    function(ret) { 
//                alert(JSON.stringify(ret));
                Metronic.unblockUI(el);
                memberPromotionTopListReload(ret);
            },                        
            error:      function(){
                //alert('发送失败。');
            }
        });        
    }
    
    $(function() {
        moment.locale('zh-CN', {
            months : [
                "1月", "2月", "3月", "4月", "5月", "6月", "7月",
                "8月", "9月", "10月", "11月", "12月"
            ],
            monthsShort : [
                "1月", "2月", "3月", "4月", "5月", "6月", "7月",
                "8月", "9月", "10月", "11月", "12月"
            ],
            weekdays : [
                "星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"
            ],
            weekdaysShort : ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
            weekdaysMin : ["日", "一", "二", "三", "四", "五", "六"],
            longDateFormat : { LL: "YYYY年MMMD日"},
            meridiem : function (hour, minute, isLowercase) {
                if (hour < 9) {
                    return "早上";
                } else if (hour < 11 && minute < 30) {
                    return "上午";
                } else if (hour < 13 && minute < 30) {
                    return "中午";
                } else if (hour < 18) {
                    return "下午";
                } else {
                    return "晚上";
                }
            },
        });

        function cb(start, end) {
            $('#member-promotion-daterange span').html(start.format('LL') + ' 至 ' + end.format('LL'));
            startDate = start.toDate();
            endDate = end.toDate();
            downloadUrlReload();
            memberPromotionTopListAjax();
        }
        cb(moment().subtract(30, 'days'), moment());

        $('#member-promotion-daterange').daterangepicker({
            opens: 'right',
            drops: 'down',
            startDate: startDate,
            endDate: endDate,
            locale: {
                applyLabel: '确定',
                cancelLabel: '取消',
                fromLabel: '开始',
                toLabel: '结束',
                customRangeLabel: '自定义日期区间'
            },
            ranges: {
               '最近2周': [moment().subtract(2, 'w'), moment()],
               '最近1个月': [moment().subtract(1, 'M'), moment()],
               '最近1季度': [moment().subtract(1, 'Q'), moment()],
               '本月': [moment().startOf('month'), moment().endOf('month')],
               '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
               '本季度': [moment().startOf('quarter'), moment().endOf('quarter')],
               '上季度': [moment().subtract(1, 'Q').startOf('quarter'), moment().subtract(1, 'Q').endOf('quarter')],
            }
        }, cb);

    });
});
