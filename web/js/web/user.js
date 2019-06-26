var user = {

    // init:function(){
    //     this.eventBind();
    // },
    eventBind:function() {
        $('.save').click(function () {
            // var btn_target = $(this);
            // if (btn_target.hasClass('disabled')){
            //     layer.msg('正在处理，请勿重复提交！');
            //     return false;
            // }
           var name = $('.user_edit_wrap input[name=nickname]').val();
           var email = $('.user_edit_wrap input[name=email]').val();
           if (name.length < 1){
               layer.msg('请输入正确的用户名！');
               return;
           }
            if (email.length < 1){
                layer.msg('请输入正确的邮箱地址！');
                return;
            }
            // btn_target.addClass('disabled');
            $.ajax({
                url:'/web/user/modify-edit',
                type:'POST',
                data:{
                    name:name,
                    email:email
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
                        return;
                    }
                }
            })
        })
    },

    pwd:function () {
        var btn_target = $(this);
        if (btn_target.hasClass('disabled')){
            layer.msg('正在处理，请勿重复提交！');
            return false;
        }
        var old_password = document.getElementById('old_password').value;
        var new_password = document.getElementById('new_password').value;
        if (old_password.length < 1){
            layer.msg('请输入正确的原始的密码！');
            return;
        }
        if (new_password.length < 1){
            layer.msg('请输入正确的修改密码！');
            return;
        }
        btn_target.addClass('disabled');
        $.ajax({
            url:'/web/user/modify-pwd',
            type:'POST',
            data:{
                old_password:old_password,
                new_password:new_password
            },
            dataType:'json',
            success:function (res) {
                btn_target.removeClass('disabled');
                if ( res.code == '-1'){
                    layer.msg(res.msg);
                    return;
                }
                if ( res.code == '200'){
                    layer.msg(res.msg);
                    return;
                }
            }
        })
    }
};

// $(document).ready(function () {
//     user.init();
// });