<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>会员列表</title>
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
        .expand {
            padding-left: 20px;
        }
        .expand div {
            margin: 1rem 0;
            line-height: 1.7;
        }
    </style>
</head>

<body>
    <div id="app">
        <mt-header title="会员列表">
            <a href="{{url('mine')}}" slot="left">
                <mt-button icon="back">我的</mt-button>
            </a>
            <mt-button icon="user" slot="right"></mt-button>
        </mt-header>
        <template>
            <el-table :data="memberlist" style="width: 100%">
                <el-table-column type="expand">
                    <template #default="props">
                        <div class="expand">
                            <div><b>开户时间:</b>  @{{ props.row.created_at }}</div>
                            <div><b>备注:</b>  @{{ props.row.remark }}</div>
                            <a :href="'{{url('member')}}/'+props.row.id+'/edit'">
                                <el-button type="primary" size="mini" round>充值</el-button>
                            </a>
                        </div>
                    </template>
                </el-table-column>

                <el-table-column prop="name" label="姓名" sortable>
                </el-table-column>
                <el-table-column prop="tel" label="手机" sortable>
                </el-table-column>
                <el-table-column prop="account" label="余额" sortable>
                </el-table-column>
            </el-table>
        </template>
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
                memberlist: [],
            }
        },
        mounted:function () {
            var _this = this
            $.ajax({
                url: '{{url('myMember')}}',
                type: 'get',
                contentType: 'application/json',
                dataType: 'json',
                data:_this.formData,
                success: function (data) {
                    _this.memberlist = data
                },
            });
        }
        ,
        methods: {
            handleClose: function () {
                this.$toast('Hello world!')
            },


        }
    }
    )
</script>

</html>