<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--360浏览器优先以webkit内核解析-->
    <title> - 面板</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css?v=4.1.0" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4">
                    <div class="row row-sm text-center">
                        <div class="col-xs-6">
                            <div class="panel padder-v item">
                                <div class="h1 text-info font-thin h1">{{count($todayMembers)}}</div>
                                <span class="text-muted text-xs">新增会员</span>
                                <div class="top text-right w-full">
                                    <i class="fa fa-caret-down text-warning m-r-sm"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel padder-v item bg-info">
                                <div class="h1 text-fff font-thin h1">{{count($todayOrders)}}</div>
                                <span class="text-muted text-xs">今日订单</span>
                                <div class="top text-right w-full">
                                    <i class="fa fa-caret-down text-warning m-r-sm"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel padder-v item bg-primary">
                                <div class="h1 text-fff font-thin h1">{{count($todayOrders)?$weekOrders->last()->all_price:0}}</div>
                                <span class="text-muted text-xs">今日销售额</span>
                                <div class="top text-right w-full">
                                    <i class="fa fa-caret-down text-warning m-r-sm"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel padder-v item">
                                <div class="font-thin h1">{{array_sum(array_pluck($weekOrders->toArray(),'all_price'))}}</div>
                                <span class="text-muted text-xs">一周销售额</span>
                                <div class="bottom text-left">
                                    <i class="fa fa-caret-up text-warning m-l-sm"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8" style="padding-right:0;">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="border-bottom:none;background:#fff;">
                            <h5>一周数据</h5>
                        </div>
                        <div class="ibox-content" style="border-top:none;">
                            <div id="yesterday" style="height:217px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
        </div>
    </div>
</div>
<!-- 全局js -->
<script src="js/jquery.min.js?v=2.1.4"></script>
<script src="js/bootstrap.min.js?v=3.3.6"></script>
<script src="js/plugins/layer/layer.min.js"></script>
<!-- Flot -->
<script src="js/plugins/flot/jquery.flot.js"></script>
<script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/plugins/flot/jquery.flot.resize.js"></script>
<script src="js/plugins/flot/jquery.flot.pie.js"></script>
<!-- 自定义js -->
<script src="js/content.js"></script>
<!--flotdemo-->
<script type="text/javascript">
    $(function() {
        var count = []
        var price = []
        @foreach($weekOrders as $weekOrder)
            count.push([new Date('{{$weekOrder->date}}').getTime(),{{ $weekOrder->all_count }}])
            price.push([new Date('{{$weekOrder->date}}').getTime(),{{$weekOrder->all_price}}])
        @endforeach

        function euroFormatter(v, axis) {
            return "&yen;"+v.toFixed(axis.tickDecimals);
        }

        function doPlot(position) {
            $.plot($("#yesterday"), [{
                data: count,
                label: "订单量"
            }, {
                data: price,
                label: "销售金额",
                yaxis: 2
            }], {
                xaxes: [{
                    mode: 'time',
                    timeBase: "milliseconds",
                    tickSize: [1, "day"],
                    timeformat: "%y-%m-%d"
                }],
                yaxes: [{
                    min: 0
                }, {
                    alignTicksWithAxis: position == "right" ? 1 : null,
                    position: position,
                    tickFormatter: euroFormatter
                }],
                legend: {
                    position: 'sw'
                },
                // colors: ["#f7f9fb"],
                colors: ["#FF0000", "#0022FF"],
                grid: {
                    color: "#999999",
                    hoverable: true,
                    clickable: true,
                    // tickColor: "#f7f9fb",
                    borderWidth:0,

                },
                tooltip: true,
                tooltipOpts: {
                    content: "%s %x 为 %y",
                    xDateFormat: "%y-%0m-%0d",

                    onHover: function(flotItem, $tooltipEl) {
                        // console.log(flotItem, $tooltipEl);
                    }
                },
                series: {
                    lines: {
                        show: true,
                        fill: true
                    }
                }
            });
        }

        doPlot("right");

        $("button").click(function() {
            doPlot($(this).text());
        });
    });
</script>
</body>

</html>
