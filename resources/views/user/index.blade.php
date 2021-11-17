<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
	<title>结账系统</title>
	<!-- import CSS -->
	<link rel="stylesheet" href="https://unpkg.com/mint-ui/lib/style.css">
	<!-- 引入样式 -->
	<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">

	<link rel="stylesheet" href="{{asset('css/dstyle.css')}}">
	<style>
		.right{
			text-align: right;
		}
		.list1 {
			display: flex;
			justify-content: space-between;
		}
	</style>
</head>

<body>
	<div id="app">
		<div class="header">
			<!-- <div class="content-wrapper">
			<div class="avatar">
				<img width="64" height="64" src="img/seller_avatar_256px.jpg">
			</div>
			<div class="content">
				<div class="title">
					<span class="brand"></span>
					<span class="name">粥品香坊（回龙观）</span>
				</div>
				<div class="description">
					蜂鸟专送/38分钟送达
				</div>
				<div class="support">
					<span class="icon decrease"></span>
					<span class="text">在线支付满28减5</span>
				</div>
			</div>
		</div> -->
			<mt-header title="选择商品">
				<a href=""  slot="right">
				<mt-button icon="user">设置</mt-button>
				</a>
			</mt-header>

			<div class="bulletin-wrapper" @click="alert">
				<span class="bulletin-title"></span><span
					class="bulletin-text">{{$notice->title}}</span>
				<i class="icon-keyboard_arrow_right"></i>
			</div>
			<div class="background">
				<img width="100%" height="100%" src="img/seller_avatar_256px.jpg">
			</div>
			<div class="detail fade-transition" style="display: none;" @click="hide">
				<div class="detail-wrapper clearfix">
					<div class="detail-main">
						<h1 class="name">XXX酒吧</h1>
						<div class="star-wrapper">
							<div class="star star-48">
								<span class="star-item on"></span><span class="star-item on"></span><span
									class="star-item on"></span><span class="star-item on"></span><span
									class="star-item off"></span>
							</div>
						</div>
						<div class="title">
							<div class="line"></div>
							<div class="text"></div>
							<div class="line"></div>
						</div>
						<div class="bulletin">
							<p class="content">{{$notice->notice}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="main">
			<div class="left-menu" id="left">
				<ul>
					@foreach($types as $type)
					<li><span>{{$type->name}}</span></li>
					@endforeach
				</ul>
			</div>
			<div class="con">
				@foreach($types as $type)
				<div class="right-con con-active" style="display: none;">
					<ul>
						@foreach($type->goods as $goods)
						<li>
							<div class="menu-img"><img src="img/pic.png" width="55" height="55"></div>
							<div class="menu-txt">
								<h4 data-icon="{{$goods->id}}">{{$goods->name}}</h4>
								<p class="list1"><span>{{$goods->description}}</span> <span class="right">库存：{{$goods->remain}}</span> </p>
								<p class="list2">
									<b>￥</b><b>{{$goods->price}}</b>
								</p>
								<div class="btn">
									<button class="minus">
										<strong></strong>
									</button>
									<i id="{{$goods->id}}">0</i>
									<button class="add">
										<strong></strong>
									</button>
									<i class="price">{{$goods->price}}</i>
								</div>

							</div>
						</li>
						@endforeach
					</ul>
				</div>
				@endforeach
			</div>
			<div class="up1"></div>
			<div class="shopcart-list fold-transition" style="">
				<div class="list-header">
					<h1 class="title">购物车</h1>
					<span class="empty">清空</span>
				</div>
				<div class="list-content">
					<ul></ul>
				</div>
			</div>
			<div class="footer">
				<div class="left">已选：
					<span id="cartN">
						<span id="totalcountshow">0</span>份　总计：￥<span id="totalpriceshow">0</span></span>元
				</div>
				<div class="right">
					<a id="btnselect" class="xhlbtn  disable" href="javascript:void(0)">去结算</a>
				</div>
			</div>
		</div>
		<!-- <div class="subFly">
		<div class="up"></div>
		<div class="down">
			<a class="close" href="javascript:">
				<img src="img/close.png" alt="">
			</a>
			<dl class="subName">
				<dt>
					<img class="imgPhoto" src="img/pic.png" alt="">
				</dt>
				<dd>
					<p data-icon=""></p>
					<p><span>¥ </span><span class="pce" style="font-size: 16px;font-weight: bold"></span></p>
					<p>
						<span>已选：“</span>
						<span class="choseValue"></span>
						<span>”</span>
					</p>
				</dd>
			</dl>
			<dl class="subChose">
				<dt>口味</dt>
				<dd class="m-active">辣味</dd>
				<dd>酸甜</dd>
			</dl>
			<dl class="subCount">
				<dt>购买数量</dt>
				<dd>
					<div class="btn">
						<button class="ms" style="display: inline-block;">
							<strong></strong>
						</button>
						<i style="display: inline-block;">1</i>
						<button class="ad">
							<strong></strong>
						</button>
						<i class="price">25</i>
					</div>
				</dd>
			</dl>
			<div class="foot">
				<span>加入购物车</span>
			</div>
		</div>

	</div> -->
	</div>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/add.js"></script>
	<script type="text/javascript" src="js/vue.min.js"></script>
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<!-- import Vue before Element -->
	<script src="https://unpkg.com/vue/dist/vue.js"></script>
	<!-- import JavaScript -->
	<script src="https://unpkg.com/mint-ui/lib/index.js"></script>
	<script src="https://unpkg.com/element-ui/lib/index.js"></script>
	<script>

		new Vue({
			el: '#app',
			mounted: function (){
				localStorage.removeItem('cartlist')
			},
			data() {
				return {
					cartlist: [],
				}
			},
			methods: {
				handleClose: function () {
					this.$toast('Hello world!')
				},
				alert: function () {
					$('.detail').show(200)
				},
				hide:function(){
					$('.detail').hide(200)
				},
            //添加最后一行特效
            tableRowClassName({ row, rowIndex }) {
					// if (rowIndex == this.$data.cartlist.length - 2) {
					//     return 't-discount'
					// }else 
					if (rowIndex == this.$data.cartlist.length - 1) {
						return 'total'
					}
					return ''
				},

			}
		}
		)
	</script>
</body>

</html>