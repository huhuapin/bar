<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    <title>结算订单</title>
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

        .member-info {
            font-size: 12px;
            margin: 8px;
            display: block;
            color: rgb(224, 48, 48);
            text-align: right;
        }
        .mint-popup-right{
            width: 100%;
            height: 100%;
        }
        .mint-popup-right .modal {
            position: absolute;
            width: 90%;
            top: 50%;
            left: 5%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%)
        }
        .message{
            margin-top: 50px;
            margin-bottom: 50px;
            font-size: 22px;
            text-align: center;
        }
        .mint-toast-icon {
            display: block;
            text-align: center;
            font-size: 110px;
            color: lawngreen;
        }
    </style>
</head>

<body>
<div id="app">
    <mt-header title="结算订单">
        <a href="javascript:history.go(-1);" slot="left">
            <mt-button icon="back">返回</mt-button>
        </a>
        <mt-button icon="user" slot="right"></mt-button>
    </mt-header>
    <template>
        <el-table :data="cartlist" style="width: 100%" :row-class-name="tableRowClassName">
            <el-table-column prop="name" label="商品">
            </el-table-column>
            <el-table-column prop="num" label="数量">
            </el-table-column>
            <el-table-column prop="price" label="总价">
            </el-table-column>
        </el-table>
    </template>
    <div class="page-part">
        <mt-radio title="折扣" :options="options" v-model="formData.discount" @change="changeDiscount">
        </mt-radio>
        <mt-field label="桌号" placeholder="请输入桌号" type="number" v-model="formData.table_num"></mt-field>
    </div>
    <div class="page-part">
        <label class="mint-radiolist-title">会员</label>
        <mt-field label="手机号" placeholder="请输入手机号" type="tel" v-model="formData.tel" @input="changeTel">
        </mt-field>
        <div class="member-info" v-if="account >= 0">余额： @{{account}}</div>
    </div>
    <div class="page-part">
        <mt-field label="备注" placeholder="备注" type="textarea" rows="4" v-model="formData.other"></mt-field>
    </div>
    <mt-button size="large" type="primary" @click.native="handleSubmit">提交</mt-button>
    <mt-popup
            v-model="popupVisible"
            position="right" style="display: none;">
        <div class="modal">
            <i class="mint-toast-icon mintui mintui-success"></i>
            <div class="message">@{{message}}</div>
            <mt-button size="large" type="primary" @click="backToIndex">返回首页</mt-button>
        </div>
    </mt-popup>
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
            mounted: function () {
                //读取缓存
                this.readCache();
                //加载折扣
                this.loadDiscount()
            },
            data() {
                return {
                    popupVisible:false,
                    message:"",
                    cartlist: [], //购物车清单
                    totalPrice: 0, //总价格
                    totalCount: 0, //总数
                    account: -1, //余额
                    // t_discount:0,
                    discount_rate: 1, //折扣率
                    formData: {     //表单数据
                        discount: '1',//折扣
                        other: null,
                        tel:null,
                        table_num:null,
                    },
                    options: [{
                        label: '无',
                        value: '1',
                    }]
                }

            },
            methods: {
                //添加最后一行特效
                tableRowClassName({row, rowIndex}) {
                    // if (rowIndex == this.$data.cartlist.length - 2) {
                    //     return 't-discount'
                    // }else
                    if (rowIndex == this.$data.cartlist.length - 1) {
                        return 'total'
                    }
                    return ''
                },
                changeDiscount: function (e) {
                    console.log(e)
                    this.discount_rate = parseFloat(e)
                    this.updateFormData()

                },
                changeTel: function (e) {
                    //待完成，根据会员见面金额
                    if (e.length != 11) {
                        this.account = -1;
                    } else {
                        var _this = this
                        $.ajax({
                            url: '{{url('member')}}/' + e,
                            type: 'get',
                            contentType: 'application/json',
                            dataType: 'json',
                            success: function (data) {
                                _this.account = data.account;
                                if (data.discount < this.totalPrice * this.discount_rate) {
                                    //余额不足，是否充值
                                    //待测试
                                    _this.$messagebox.confirm("余额不足，是否重置？").then(action => {
                                        console.log(action)
                                        if (action == 'confirm') {
                                            //跳转到重置页面
                                            window.location.href = '{{url('deposit')}}/' + e;
                                        }
                                    });
                                }
                            },
                        });
                    }
                    this.updateFormData()
                },
                updateFormData: function () {
                    // this.cartlist[this.cartlist.length-2].price = -this.t_discount
                    // this.cartlist[this.cartlist.length-1].price = Math.max(Math.floor(this.totalPrice * this.discount_rate * 100) / 100 - this.t_discount,0) + '元'
                    console.log('totalPrice' + this.totalPrice)
                    this.cartlist[this.cartlist.length - 1].price = Math.floor(this.totalPrice * this.discount_rate * 100) / 100 + '元'
                },
                handleSubmit: function () {
                    console.log(this.formData)
                    data = {
                        _token: "{{csrf_token()}}",
                        cartlist: JSON.parse(localStorage.getItem("cartlist")),
                        discount: parseFloat(this.formData.discount),
                        other: this.formData.other,
                        tel: this.formData.tel,
                        table_num: parseInt(this.formData.table_num),
                    }
                    console.log(data)
                    var _this = this
                    $.ajax({
                        url: '{{url('order')}}',
                        type: 'post',
                        contentType: 'application/json',
                        data: JSON.stringify(data),
                        // dataType: 'json',
                        success: function (data) {
                            if (data.code == 200) {
                                _this.popupVisible = true
                                _this.message = data.message
                            } else {
                                _this.$message.error(data.message)
                            }
                        },

                    });
                },
                readCache: function () {
                    var cartlist = JSON.parse(localStorage.getItem("cartlist"))
                    console.log(typeof (cartlist))
                    if (cartlist == null) {
                        location.href = "{{url('cartList')}}"
                    } else {
                        totalCount = 0
                        totalPrice = 0.0
                        for (key in cartlist) {
                            this.cartlist.push({
                                id: cartlist[key][0],
                                name: cartlist[key][1],
                                price: '￥' + cartlist[key][2] * cartlist[key][3],
                                num: cartlist[key][3]
                            })
                            totalCount += cartlist[key][3]
                            totalPrice += cartlist[key][2] * cartlist[key][3]
                        }
                        // this.cartlist.push({
                        //     id:"",
                        //     name:"会员折扣",
                        //     price:0,
                        //     num:"-",
                        // })
                        this.cartlist.push({
                            id: 0,
                            name: "合计",
                            price: totalPrice + '元',
                            num: totalCount,
                        })
                        this.totalCount = totalCount
                        this.totalPrice = totalPrice
                        console.log(this.cartlist)
                    }
                },
                loadDiscount: function () {
                    var _this = this
                    $.ajax({
                        url: '{{url('discountJson')}}',
                        type: 'get',
                        contentType: 'application/json',
                        dataType: 'json',
                        success: function (data) {
                            console.log(data)
                            data.forEach((option) => {
                                _this.options.push({
                                    'label': option.description,
                                    'value': String(option.discount)
                                })
                            })
                        },
                    });
                },
                backToIndex:function (){
                    window.location.href="{{url('/cartList')}}"
                }
            }
        },
    )
</script>

</html>