$(function () {
    //加的效果，调出底部菜单
    $("#left li:first-child").addClass("active");
    var e;
    var cartlist = {}
    $(".add").click(function () {
        // $(".subFly").show();
        //获取加购信息
        e = $(this).prev();
        var parent = $(this).parent();
        var name = parent.parent().children("h4").text()
        var price = parseFloat(parent.prev().children("b:nth-child(2)").text());
        var src = $(this).parent().parent().prev().children()[0].src;
        var id = $(this).parent().parent().children("h4").attr("data-icon");


        var num = parseInt(e.text());
        if (num <= 0) {
            num = 1
            var data = [id, name, price, num]
            cartlist[id] = data
            add(data)
            e.css("display", "inline-block");
            e.prev().css("display", "inline-block")
        } else {
            num++
            var data = [id, name, price, num]
            add(data)
        }
        $('.shopcart-list').show();
        $('#btnselect').removeClass('disable')
        //设置加购数量
        e.text(num)


        // var data=[m,taste,sum,acount,price,dataIconN];


        // $(".subName dd p:nth-child(1)").html(name);
        // $(".pce").text(price);
        // $(".imgPhoto").attr('src',src);
        // $(".price").text(price);
        // $(".choseValue").text($(".subChose .m-active").text());
        // $(".subName dd p:first-child").attr("data-icon",dataIcon)
    });
    //调出数量变化
    $(".minus").click(function () {
        $('.shopcart-list').show();
        //获取减购信息
        var e = $(this).next();
        var id = $(this).parent().parent().children("h4").attr("data-icon");
        var num = parseInt(e.text())
        if(--num <= 0) {
            num = 0
            e.css("display", "none");
            e.prev().css("display", "none")
            delete cartlist[id]
            rendCart(cartlist)
        }else{
            let data=[id,"",0,num]
            add(data)
        }
        e.text(num)
    });
    var dd;

    // //计算金额
    // $(".ad").click(function () {
    //     var n = parseFloat($(this).prev().text())+1;
    //        if (n == 0) { return; }
    //     $(this).prev().text(n);
    //     var danjia = $(this).next().text();//获取单价
    //     var a = $("#totalpriceshow").html();//获取当前所选总价
    //     $("#totalpriceshow").html((a * 1 + danjia * 1).toFixed(2));//计算当前所选总价
    //     var nm = $("#totalcountshow").html();//获取数量

    //     $("#totalcountshow").html(nm*1+1);
    // });

    // $(".up").click(function(){
    //     $(".subFly").hide();
    // });
    // $(".foot").click(function () {
    //     var n = $('.ad').prev().text();
    //     var num = parseFloat(n) + 1;
    //     if (num == 0) { return; }
    //     $('.ad').prev().text(num);
    //     var danjia = $('.ad').next().text();//获取单价
    //     var a = $("#totalpriceshow").html();//获取当前所选总价
    //     $("#totalpriceshow").html((a * 1 + danjia * 1).toFixed(2));//计算当前所选总价
    //     var nm = $("#totalcountshow").html();//获取数量
    //     $("#totalcountshow").html(nm * 1 + 1);
    //     jss();//  改变按钮样式
    //     $(".subFly").hide();
    //     var ms = e.text(num - 1);
    //     if (ms != 0) {
    //         e.css("display", "inline-block");
    //         e.prev().css("display", "inline-block")
    //     }
    //     var m = $(".subName dd:nth-child(2) p:nth-child(1)").text();
    //     var taste = $(".subChose .m-active").text();
    //     var acount = n;
    //     var sum = parseFloat($(".subName dd p:nth-child(2) span:nth-child(2)").text()) * acount;
    //     var price = parseFloat($(".subName dd p:nth-child(2) span:nth-child(2)").text());
    //     var dataIconN = $(this).parent().children(".subName").children("dd").children("p:first-child").attr("data-icon")
    //     var data = [m, taste, sum, acount, price, dataIconN];
    //     console.log(data)
    //     add(data);

    // });
    // $(".subChose dd").click(function () {
    //     $(this).addClass("m-active").siblings().removeClass("m-active");
    //     $(".choseValue").text($(".subChose .m-active").text());
    // })


    // //减的效果
    // $(".ms").click(function () {
    //     var n = $(this).next().text();
    //     console.log(n);
    //     if (n > 1) {
    //         var num = parseFloat(n) - 1;
    //         $(this).next().text(num);//减1

    //         var danjia = $(this).nextAll(".price").text();//获取单价
    //         var a = $("#totalpriceshow").html();//获取当前所选总价
    //         $("#totalpriceshow").html((a * 1 - danjia * 1).toFixed(2));//计算当前所选总价

    //         var nm = $("#totalcountshow").html();//获取数量
    //         $("#totalcountshow").html(nm * 1 - 1);
    //     }

    //     //如果数量小于或等于0则隐藏减号和数量
    //     if (num <= 0) {
    //         $(this).next().css("display", "none");
    //         $(this).css("display", "none");
    //         jss();//改变按钮样式
    //         return
    //     }
    // });

    function add(data) {
        console.log(data)
        //判断购物车中是否包含当前物品
        if (cartlist.hasOwnProperty(data[0])) {
            cartlist[data[0]][3] = data[3]
            rendCart(cartlist)
        } else {
            cartlist[data[0]] = data
            rendCart(cartlist)
        }
    }
    function rendCart(data) {
        $(".list-content>ul").html("")
        count = 0
        total = 0
        for (let key in cartlist) {
            if (cartlist[key][3] <= 0) {
                delete cartlist[key]
                continue
            }
            $(".list-content>ul").append(
                '<li class="food"><div><span class="accountName" data-icon="' + data[key][0] + '">' + data[key][1] + '</span></div><div><span>￥</span><span class="accountPrice">' + data[key][2] * data[key][3] + '</span></div><div class="btn"><button class="ms2" style="display: inline-block;"><strong></strong></button> <i style="display: inline-block;">' + data[key][3] + '</i><button class="ad2"> <strong></strong></button><i style="display: none;">' + data[key][2] + '</i></div></li>');

            var display = $(".shopcart-list.fold-transition").css('display');
            if (display == "block") {
                $("document").click(function () {
                    $(".shopcart-list.fold-transition").hide();
                })
            }
            count += data[key][3]
            total += data[key][2] * data[key][3]
        }
        $("#totalcountshow").text(count)
        $("#totalpriceshow").text(parseFloat(total))
        if (count == 0) {
            $(".shopcart-list").hide();
            $("#btnselect").addClass('disable')
        }
    }
    /* 购物车加减*/

    $(document).on('click', '.ad2', function () {
        id = $(this).parent().prev().prev().children("span:nth-child(1)").data('icon')
        console.log(id)
        if(cartlist.hasOwnProperty(id)){
            cartlist[id][3]++
            $("#"+id).text(cartlist[id][3])
            rendCart(cartlist)
        }else{
            alert('购物车错误！，请刷新页面重试')
        }
    });


    $(document).on('click', '.ms2', function () {
        id = $(this).parent().prev().prev().children("span:nth-child(1)").data('icon')
        console.log(id)
        if(cartlist.hasOwnProperty(id)){
            cartlist[id][3]--
            var e = $("#"+id)
            //购物车没东西了
            if(cartlist[id][3] <= 0) {
                e.css("display", "none");
                e.prev().css("display", "none")
                e.text(0)
                delete cartlist[id]
                rendCart(cartlist)
            }else{
                e.text(cartlist[id][3]?cartlist[id][3]:0)
            }
            rendCart(cartlist)
        }else{
            alert('购物车错误！，请刷新页面重试')
        }
        
    });

    //结算按钮
    $('#btnselect').click(function(){
        console.log(cartlist)
        if (!cartlist || Object.keys(cartlist).length === 0) {
            return false
        }
        localStorage.setItem("cartlist",JSON.stringify(cartlist))
        window.location.href="cart"
    })




    function jss() {
        var m = $("#totalcountshow").html();
        if (m > 0) {
            $(".right").find("a").removeClass("disable");
        } else {
            $(".right").find("a").addClass("disable");
        }
    };
    //选项卡
    $(".con>div").hide();
    $(".con>div:eq(0)").show();
    $(".left-menu li").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        var n = $(".left-menu li").index(this);
        $(".left-menu li").index(this);
        $(".con>div").hide();
        $(".con>div:eq(" + n + ")").show();
    });

    // $(".subFly").hide();
    // $(".close").click(function () {
    //     $(".subFly").hide();
    // });

    $(".footer>.left").click(function () {
        var content = $(".list-content>ul").html();
        if (content != "") {
            $(".shopcart-list.fold-transition").toggle();
            // $(".up1").toggle();
        }
    });
    /*  wk ADD  */
    $(".chg-shopcart-head .ydmenu").click(function () {
        var content = $(".list-content>ul").html();
        if (content != "") {
            $(".shopcart-list.fold-transition").toggle();
            $(".up1").toggle();
        }
    });
    /*  wk ADD  */
    $(".up1").click(function () {
        $(".up1").hide();
        $(".shopcart-list.fold-transition").hide();
    })
    $(".empty").click(function () {
        $(".list-content>ul").html("");
        $("#totalcountshow").text("0");
        $("#totalpriceshow").text("0");
        $(".minus").next().text("0");
        $(".minus").hide();
        $(".minus").next().hide();
        $(".shopcart-list").hide();
        $(".up1").hide();
        cartlist = {}
        localStorage.removeItem("cartlist")
        jss();//改变按钮样式
    });


});
