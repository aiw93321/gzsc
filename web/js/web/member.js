var member ={
    search:function () {
        
    },
    add:function () {
       var nickname = $(".wrap_member_set .m-t input[name=nickname]");
        var name = nickname.val();
        var mobile =$(".wrap_member_set .m-t input[name=mobile]");
        var tel =mobile.val();
        if (name.length<1){
            layer.tips('当前用户名为空！',nickname);
            return;
        }
        if (tel.length<1){
            layer.tips('注册手机为空！',mobile);
            return;
        }
        $.ajax({
            url:'/web/member/set-submit',
            type:'POST',
            data:{
                name:name,
                tel:tel
            },
            dataType:'json',
            success:function (res) {
                // btn_target.removeClass('disabled');
                if ( res.code == '-1'){
                    layer.msg(res.msg);
                    return;
                }
                if ( res.code == '200'){
                    layer.msg(res.msg);
                    window.location.href="/web/member/index";
                    return;
                }
            }
        })
    }
}