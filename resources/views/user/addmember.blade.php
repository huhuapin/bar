<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>新开会员</title>
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

        .el-collapse-item__header,
        .el-collapse-item__wrap {
            padding-left: 10px;
        }

        .title {
            margin: 0 1px 0 auto;
        }
        .member-info {
            font-size: 12px;
            margin: 8px;
            display: block;
            color: rgb(224, 48, 48);
            text-align: right;
        }
    </style>
</head>

<body>
    <div id="app">
        <mt-header title="充值会员">
            <a href="{{url('mine')}}" slot="left">
                <mt-button icon="back">我的</mt-button>
            </a>
            <mt-button icon="user" slot="right"></mt-button>
        </mt-header>
            <div class="page-part">
                <label class="mint-radiolist-title">会员</label>
                <mt-field label="手机号" placeholder="请输入手机号" type="tel" v-model="formData.tel" @input="changeTel">
                </mt-field>
                <mt-field label="姓名" placeholder="请输入姓名" type="name" v-model="formData.name">
                </mt-field>
                <div class="member-info" v-if="(formData.account >= 0)">余额： @{{formData.account}}</div>
                <mt-field label="充值金额" placeholder="请输入金额" type="number" v-model="formData.number">
                </mt-field>
            </div>
            <div class="page-part">
                <mt-field label="备注" placeholder="备注" type="textarea" rows="4" v-model="formData.other"></mt-field>
            </div>
            <mt-button size="large" type="primary" @click.native="handleSubmit">充值</mt-button>

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
                formData:{
                    _token:"{{csrf_token()}}",
                    tel:"{{$member->tel}}",
                    name:"{{$member->name}}",
                    number:null,
                    account:{{$member->account?$member->account:'-1'}},
                    other:null,
                }
            }
        },
        methods: {
            handleClose: function () {
                this.$toast('Hello world!')
            },
            changeTel: function (e) {


                //待完成，获取会员余额
                if (e.length != 11) {
                    this.formData.account = -1;
                } else {
                    var _this = this
                    $.ajax({
                        url: '{{url('member')}}/' + e,
                        type: 'get',
                        contentType: 'application/json',
                        dataType: 'json',
                        success: function (data) {
                            _this.formData.account = data.account;
                            _this.formData.name = data.name
                        },
                    });
                }
            },
            handleSubmit:function () {
                var _this = this
                $.ajax({
                    url: '{{url('member')}}',
                    type: 'post',
                    data: _this.formData,
                    dataType: 'json',
                    success: function (data) {
                        if (data.code == 200) {
                            _this.$messagebox.alert(data.message,'成功').then(action=>{
                                window.location.href = "{{url('member')}}/"+data.data.id+"/edit";
                            })
                        } else {
                            _this.$message.error(data.message)
                        }
                    }
                })
            }

        }
    }
    )
</script>

</html>