<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 单据</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="{{asset('css/bootstrap.min.css?v=3.3.6')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.css?v=4.4.0')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/footable/footable.core.css')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css?v=4.1.0')}}" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-content p-xl">
                <div class="row">
                    <div class="col-sm-6">
                        @if($order->member)

                        <address>
                            <strong>{{$order->member->name}}</strong><br>
                            <abbr title="Phone">TEL：</abbr> {{$order->member->tel}}
                        </address>
                        @endif

                    </div>

                    <div class="col-sm-6 text-right">
                        <h4>桌号：</h4>
                        <h4 class="text-navy">{{$order->table_num}}</h4>
                        <address>
                            <strong>收银员：</strong><br>
                            {{$order->user?$order->user->name:"已删除"}}<br>
                            <abbr title="Phone">TEL：</abbr>  {{$order->user?$order->user->tel:"已删除"}}
                        </address>
                        <p>
                            <span><strong>时间：</strong> {{$order->created_at->toDateTimeString()}}</span>
                        </p>
                    </div>
                </div>

                <div class="table-responsive m-t">
                    <table class="table invoice-table">
                        <thead>
                        <tr>
                            <th>清单</th>
                            <th>数量</th>
                            <th>单价</th>
                            <th>总价</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->details as $detail)
                        <tr>
                            <td>
                                <div><strong>{{$detail->goods?$detail->goods->name:"已删除"}}</strong>
                                </div>
                            </td>
                            <td>{{$detail->num}}</td>
                            <td>&yen;{{$detail->price}}</td>
                            <td>&yen;{{$detail->total_price}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /table-responsive -->

                <table class="table invoice-total">
                    <tbody>
                    <tr>
                        <td><strong>总价：</strong>
                        </td>
                        <td>&yen;{{$order->total_price}}</td>
                    </tr>
                    <tr>
                        <td><strong>折扣：</strong>
                        </td>
                        <td>{{$order->discount?$order->discount*10 ."折":"赠送"}}</td>
                    </tr>
                    <tr>
                        <td><strong>总计：</strong>
                        </td>
                        <td>&yen;{{$order->real_price}}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-right">
                    <a href="{{url('adminOrder')}}/{{$order->id}}/delete">
                    <button class="btn btn-primary"><i class="fa fa-dollar"></i> 删除此订单</button>
                    </a>
                </div>

                <div class="well m-t"><strong>注意：</strong> 谨慎删除！
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 全局js -->
<script src="{{asset('js/jquery.min.js?v=2.1.4')}}"></script>
<script src="{{asset('js/bootstrap.min.js?v=3.3.6')}}"></script>


<!-- 自定义js -->
<script src="{{asset('js/content.js?v=1.0.0')}}"></script>


</body>

</html>
