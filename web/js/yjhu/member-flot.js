$(document).ready(function () {
    'use strict';
    
    var startDate = new Date(new Date().getTime() - 30 * 24 * 3600 * 1000);
    var endDate = new Date();
    var accumulatedFlag = 0;
    
    function memberFlotDraw(results) {
        if ($('#member-flot').size() != 1) {
            return;
        }

        var plot = $.plot($("#member-flot"), [{
            data: results['data'],
            label: "会员",
            lines: {
                lineWidth: 1,
            },
            shadowSize: 0

        }, {
            data: results['data1'],
            label: "粉丝",
            lines: {
                lineWidth: 1,
            },
            shadowSize: 0

        }], {
            series: {
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0.05
                        }, {
                            opacity: 0.01
                        }]
                    }
                },
                points: {
                    show: true,
                    radius: 3,
                    lineWidth: 1
                },
                shadowSize: 2
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: "#eee",
                borderColor: "#eee",
                borderWidth: 1
            },
            colors: ["#d12610", "#37b7f3", "#52e136"],
            xaxis: {
                mode: 'time',
                timezone: 'browser',
                ticks: results['length'] < 15 ? results['length'] : 15,
            },
            yaxis: {
                ticks: 6,
                tickDecimals: 0,
                tickColor: "#eee",
            },
            legend: {
                position: 'nw',
            }
        });


        function showTooltip(x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y + 15,
                left: x - 25,
                border: '1px solid #333',
                padding: '4px',
                color: '#fff',
                'border-radius': '3px',
                'background-color': '#333',
                opacity: 0.80
            }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
        $("#member-flot").bind("plothover", function(event, pos, item) {
            $("#x").text(pos.x.toFixed(2));
            $("#y").text(pos.y.toFixed(2));

            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(0);
                    var content = new Date(parseInt(x)).toLocaleDateString() + '<br>' + item.series.label + y + '人';

                    showTooltip(item.pageX, item.pageY,  content);
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
    }
    
    function memberFlotAjax() {
        var args = {
            'classname':    '\\app\\models\\MUser',
            'funcname':     'getMemberTimeline',
            'params':       {
                'startDate':  startDate.getFullYear() + '-' + (startDate.getMonth() + 1) + '-' + startDate.getDate() ,
                'endDate':   endDate.getFullYear() + '-' + (endDate.getMonth() + 1) + '-' + endDate.getDate(),
                'accumulatedFlag': accumulatedFlag,
                'targetOfficeId': target_office_id,
            } 
        };
        var el = $('#member-flot').closest(".portlet").children(".portlet-body");
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
                memberFlotDraw(ret);
            },                        
            error:      function(){
                alert('发送失败。');
            }
        });
        
    }
    
    $('input[name="member-flot-accumulated"]').change( function() {
        if ($(this).attr('id') === 'member-flot-accumulated-off') {
            accumulatedFlag = 0;
        } else {
            accumulatedFlag = 1;
        }
        memberFlotAjax();
    })
    
    $('input[name="member-flot-daterange"]').change( function() {
        if ($(this).attr('id') === 'member-flot-daterange-7days') {
            startDate = new Date(new Date().getTime() - 7 * 24 * 3600 * 1000);
        } else if ($(this).attr('id') === 'member-flot-daterange-14days') {
            startDate = new Date(new Date().getTime() - 14 * 24 * 3600 * 1000);
        } else {
            startDate = new Date(new Date().getTime() - 30 * 24 * 3600 * 1000);
        }
        memberFlotAjax();
    })
    
    $('#outlet-selection').change(function () {
        alert($(this).val());
        target_office_id = $(this).val();
        redirectTo();
    });
    
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
            $('#member-flot-daterange span').html(start.format('LL') + ' 至 ' + end.format('LL'));
            startDate = start.toDate();
            endDate = end.toDate();
            memberFlotAjax();
        }
        cb(moment().subtract(30, 'days'), moment());

        $('#member-flot-daterange').daterangepicker({
            opens: 'left',
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



