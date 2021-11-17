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

        .logout {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div id="app">
        <mt-header title="修改信息">
            <a href="{{url('mine')}}" slot="left">
                <mt-button icon="back">返回</mt-button>
            </a>
            <mt-button icon="user" slot="right"></mt-button>
        </mt-header>


            <input type="hidden" name="_method" value="PUT">
            <mt-field label="姓名" placeholder="请输入姓名" type="text" v-model="formData.name" required="true"></mt-field>
            <mt-field label="手机号" placeholder="请输入手机号" type="tel" v-model="formData.tel" required="true"></mt-field>
            
            <div class="page-part">
                <label class="mint-radiolist-title">修改密码</label>
                <mt-field label="原密码" placeholder="原密码" type="password" rows="4" v-model="formData.oldPwd"></mt-field>
                <mt-field label="新密码" placeholder="新密码" type="password" rows="4" v-model="formData.newPwd"></mt-field>
                <mt-field label="确认密码" placeholder="确认密码" type="password" rows="4" v-model="formData.pwdConf"></mt-field>

            </div>
            <mt-button size="large" type="primary" @click="handleSubmit">提交</mt-button>


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
                formData:{
                    name:"{{$user->name}}",
                    tel:"{{$user->tel}}",
                    oldPwd:"",
                    newPwd:"",
                    pwdConf:"",
                    _token:"{{csrf_token()}}"
                }
            }
        },
        methods: {
            handleSubmit:function(e){
                if(this.formData.name == "") {
                    this.$toast("输入姓名")
                    return false
                }else if(this.formData.tel.length != 11) {
                    this.$toast("手机号有误！")
                    return false
                }if(this.formData.oldPwd != "") {
                    if(this.formData.newPwd == "" || this.formData.newPwd != this.formData.pwdConf) {
                        this.$toast("密码两次输入不一致")
                        return false
                    }
                }
                var _this = this
                $.ajax({
                    url: '{{url('mine')}}/1',
                    type: 'PUT',
                    // contentType: 'application/json',
                    dataType: 'json',
                    data:_this.formData,
                    success: function (data) {
                        if (data.code == 200) {
                            _this.$message.success(data.message)
                        } else {
                            _this.$message.error(data.message)
                        }
                    },
                });
            }
        }
    }
    )
</script>

</html>