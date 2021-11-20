<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - FooTable</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="{{asset('css/bootstrap.min.css?v=3.3.6')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.css?v=4.4.0')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/footable/footable.core.css')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css?v=4.1.0')}}" rel="stylesheet">
    <style>
        button i {
            margin-left: 6px;
        }
        td img {
            max-width: 160px;
            max-height: 160px;
        }
    </style>

</head>

<body class="gray-bg">
@if(session('success'))
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{session('success')}}
    </div>
@endif
    <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>商品列表</h5>

                            <div class="ibox-tools">
                                <a class="collapse-link" href="{{url('goods/create')}}">
                                    <button type="button" class="btn btn-w-m btn-primary">新增<i class="fa fa-plus"></i></button>
                                </a>
                            </div>
                        </div>

                        <div class="ibox-content table-responsive">
                            <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                   placeholder="搜索表格...">

                            <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>名称</th>
                                            <th>描述</th>
                                            <th>图片</th>
                                            <th>类型</th>
                                            <th>价格</th>
                                            <th>库存</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($goods as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->description}}</td>
                                            <td><img src="{{asset('storage')}}/{{$item->img}}" alt=""></td>
                                            <td>{{$item->type->name}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->remain}}</td>
                                            <td><a href="{{url('goods')}}/{{$item->id}}/edit"><i class="fa fa-edit text-navy"></i> 修改</a>
                                                <a href="{{url('goods')}}/{{$item->id}}/delete"><i class="fa fa-close text-danger"></i> 删除</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
                                                <ul class="pagination pull-right"></ul>
                                            </td>
                                        </tr>
                                    </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- 全局js -->
<script src="{{asset('js/jquery.min.js?v=2.1.4')}}"></script>
<script src="{{asset('js/bootstrap.min.js?v=3.3.6')}}"></script>
<script src="{{asset('js/plugins/footable/footable.all.min.js')}}"></script>

<!-- 自定义js -->
<script src="{{asset('js/content.js?v=1.0.0')}}"></script>
    <script>
        $(document).ready(function() {

            $('.footable').footable();
            $('.footable2').footable();

        });

    </script>

    
    

</body>

</html>
