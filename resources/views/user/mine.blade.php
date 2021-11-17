<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>个人中心</title>
    <!-- import CSS -->
    <link rel="stylesheet" href="https://unpkg.com/mint-ui/lib/style.css">
    <!-- 引入样式 -->
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <style>
        body {
            background-color: #fafafa;
            margin: 0;
        }

        th {
            font-weight: bold;
        }

        .page-part {
            margin-top: 15px;
        }

        .bg-primary {
            color: #f4f3f9;
            background-color: #7266ba;
        }

        .panel {
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            line-height: 1.42857143;
            font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 13px;
            text-align: center;
            box-sizing: border-box;
            margin-top: 20px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            box-shadow: none;
            padding-top: 15px;
            padding-bottom: 15px;
            position: relative;
            color: #f4f3f9;
            background-color: #7266ba;
        }

        .font-thin {
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            text-align: center;
            box-sizing: border-box;
            font-family: inherit;
            font-weight: 500;
            line-height: 1.1;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 36px;
            color: #fff;
        }

        .text-mute {
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            line-height: 1.42857143;
            font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 13px;
            text-align: center;
            box-sizing: border-box;
            color: #d6d3e6;
        }

        .big-info {
            color: #dcf2f8;
            background-color: #23b7e5;
        }

        .el-col-12 {
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            line-height: 1.42857143;
            font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 13px;
            color: #676a6c;
            text-align: center;
            box-sizing: border-box;
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
            float: left;
            width: 50%;
        }

        .logout {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div id="app">
        <mt-header title="个人中心">
            <a href="{{url('cartList')}}" slot="left">
                <mt-button icon="back">首页</mt-button>
            </a>
            <mt-button icon="user" slot="right"></mt-button>
        </mt-header>
        <el-row>
            <el-col :span="12">
                <div class="panel padder-v item bg-primary">
                    <div class="text-fff font-thin">{{count($orders)}}</div>
                    <span class="text-muted text-xs">今日订单</span>
                </div>
            </el-col>
            <el-col :span="12">
                <div class="panel padder-v item bg-info">
                    <div class="h1 text-fff font-thin h1">￥{{$total_price}}</div>
                    <span class="text-muted text-xs">今日营收</span>
                </div>
            </el-col>
        </el-row>

        <mt-cell title="修改信息" to="{{url('mine')}}/1" is-link value="">
        </mt-cell>
        <mt-cell title="今日订单" to="{{url('order')}}" is-link value="">
        </mt-cell>
        <mt-cell title="我的会员" to="{{url('member')}}" is-link value="查看">
        </mt-cell>
        <mt-cell title="新开会员" to="{{url('member/0/edit')}}" is-link value="+">
        </mt-cell>
        <div class="logout">
            <mt-button size="large" type="danger" @click.native="handleSubmit">提交</mt-button>
        </div>
    </div>
</body>
<style>
    .el-table .total {
        background: rgb(112, 209, 99);
    }

    .el-table .t-discount {
        background: #c2ccbe;
    }

    .el-table .t-discount td:nth-child(3) div {
        color: red;
    }
</style>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<!-- import Vue before Element -->
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<!-- import JavaScript -->
<script src="https://unpkg.com/mint-ui/lib/index.js"></script>
<script src="https://unpkg.com/element-ui/lib/index.js"></script>
<script>

    new Vue({
        el: '#app',
        data() {
            return {

            }
        },
        methods: {
            handleClose: function () {
                this.$toast('Hello world!')
            },


        }
    }
    )
</script>

</html>