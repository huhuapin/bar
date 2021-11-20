<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 表单验证 jQuery Validation</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{asset('css/bootstrap.min.css?v=3.3.6')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.css?v=4.4.0')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/footable/footable.core.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css?v=4.1.0')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/plugins/iCheck/custom.css')}}">
    <style>
        .error span {
            color: red;
        }
    </style>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>简介</h5>
                </div>
                <div class="ibox-content">
                    <p>在这里您可以自行修改商品</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>修改商品</h5>
                </div>
                <div class="ibox-content">
                    <div class="error">
                        <span></span>
                    </div>
                    <form class="form-horizontal m-t" enctype="multipart/form-data" id="addForm" action="{{url('goods')}}/{{$goods->id}}" method="post">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="form-group">
                            <label class="col-sm-3 control-label">商品名：</label>
                            <div class="col-sm-8">
                                <input id="name" name="name" class="form-control" type="text"
                                       aria-required="true" aria-invalid="false" class="valid" value="{{$goods->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">描述：</label>
                            <div class="col-sm-8">
                                <input id="description" name="description"  class="form-control" type="text" value="{{$goods->description}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">图片：</label>
                            <div class="col-sm-8">
                                <input id="img" name="img" class="form-control" type="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">类型：</label>
                            <div class="col-sm-8">
                                <select name="type" id="type" class="form-control">
                                @foreach($types as $type)
                                        <option value="{{$type->id}}" @if($goods->type_id == $type->id) selected @endif>{{$type->name}}</option>
                                @endforeach
                                </select>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请选择商品类型</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">价格：</label>
                            <div class="col-sm-8">
                                <input id="price" name="price" class="form-control" type="number" value="{{$goods->price}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">库存：</label>
                            <div class="col-sm-8">
                                <input id="remain" name="remain" class="form-control" type="number" value="{{$goods->remain}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit">提交</button>
                            </div>
                        </div>
                    </form>
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
<script src="{{asset('js/plugins/iCheck/icheck.min.js')}}"></script>

<!-- jQuery Validation plugin javascript-->
<script src="{{asset('js/plugins/validate/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/plugins/validate/messages_zh.min.js')}}"></script>

<script src="{{asset('js/demo/form-validate-demo.js')}}"></script>

<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        $("#addForm").validate({
            //errorClass: "label.error", //默认为错误的样式类为：error
            onkeyup: false,
            rules: {
                // simple rule, converted to {required:true}
                // compound rule
                name: {
                    required: true,
                },
                description:"required",
                type:"required",
                price:{
                    number: true,
                    required: true
                },
                remain: {
                    digits:true,
                    required:true
                }
            },
            invalidHandler: function(event, validator) {
                // 'this' refers to the form
                var errors = validator.numberOfInvalids();
                if (errors) {
                    var message = errors == 1
                        ? 'You missed 1 field. It has been highlighted'
                        : 'You missed ' + errors + ' fields. They have been highlighted';
                    $("div.error span").html(message);
                    $("div.error").show();
                } else {
                    $("div.error").hide();
                }
            }
        });

    });

</script>

</body>

</html>