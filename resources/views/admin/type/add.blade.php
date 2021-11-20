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
                    <p>在这里您可以自行添加商品类型</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>增加类型</h5>
                </div>
                <div class="ibox-content">
                    <div class="error">
                        <span></span>
                    </div>
                    <form class="form-horizontal m-t" id="addForm" action="{{url('type')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="col-sm-3 control-label">名称：</label>
                            <div class="col-sm-8">
                                <input id="name" name="name"  class="form-control" type="text">
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
                // compound rule
                name: {
                    required: true,
                },
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