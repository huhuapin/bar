<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>今日订单</title>
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
        .el-collapse-item__header {
            padding-left: 10px;
            font-size: 16px;
        }
        .title {
            margin:0 1px 0 auto;
        }
    </style>
</head>

<body>
    <div id="app">
        <mt-header title="个人中心">
            <a href="{{url('mine')}}" slot="left">
                <mt-button icon="back">我的</mt-button>
            </a>
            <mt-button icon="user" slot="right"></mt-button>
        </mt-header>
        <el-collapse accordion>
            @foreach($orders as $order)
            <el-collapse-item  name="{{$order->id}}">
                <template slot="title">
                    <div>{{$order->created_at}}</div>
                    <div class="title">￥{{$order->real_price}}</div>
                </template>
                <template>
                    <el-table :data="details[{{$loop->index}}]" style="width: 100%" :row-class-name="tableRowClassName">
                        <el-table-column prop="name" label="商品">
                        </el-table-column>
                        <el-table-column prop="num" label="数量">
                        </el-table-column>
                        <el-table-column prop="price" label="总价">
                        </el-table-column>
                    </el-table>
                </template>
            </el-collapse-item>
            @endforeach
        </el-collapse>
    </div>
</body>
<style>
    .el-table .total {
        background: rgb(112, 209, 99);
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
                cartlist: "",
                details:[],
            }
        },
        mounted:function (){
            var _this = this
            $.ajax({
                url: '{{url('todayOrder')}}',
                type: 'get',
                contentType: 'application/json',
                dataType: 'json',
                success: function (data) {
                    data.orders.forEach((order)=>{
                        var t = []
                        order.details.forEach((detail)=>{
                            t.push({
                                name: detail.goods.name,
                                num:detail.num,
                                price:detail.price * detail.num,
                            });
                        })
                        t.push({
                            name:'折扣',
                            num: order.discount,
                            price:'￥'+order.real_price
                        })
                        _this.details.push(t)
                    });
                    console.log( _this.details)

                },
            });
        }
        ,
        methods: {
            //添加最后一行特效
            tableRowClassName({ row, rowIndex}) {
                console.log(row)
                if (row.name == '折扣') {
                    return 'total'
                }
                return ''
            },

        }
    }
    )
</script>

</html>