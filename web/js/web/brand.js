var brand ={

    //添加或者修改品牌信息
    set_submit:function () {
        var name = $('.wrap_brand_set input[name=name]');
        var name_target = name.val();
        var image_key = $('.wrap_brand_set .pic-each .del_image').attr("data");
        var mobile = $('.wrap_brand_set input[name=mobile]');
        var mobile_target = mobile.val();
        var address = $('.wrap_brand_set input[name=address]');
        var address_target = address.val();
        var description = $('.wrap_brand_set textarea[name=description]');
        var description_target = description.val();
        if (name_target.length<1){
            layer.tips('品牌名称不能为空！',name);
            return;
        }

        if ($('.wrap_brand_set .pic-each .del_image').size()<1){
            layer.msg('请上传品牌logo！');
            return;
        }

        if (mobile_target.length<1){
            layer.tips('手机号不能为空！',mobile);
            return;
        }
        if (address_target.length<1){
            layer.tips('地址栏目不能为空！',address);
            return;
        }
        if (description_target.length<1){
            layer.tips('品牌介绍不能为空！',description);
            return;
        }
        $.ajax({
            url:'/web/brand/set-submit',
            type:'POST',
            data:{
                name:name_target,
                image_key:image_key,
                mobile:mobile_target,
                address:address_target,
                description:description_target
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
                    window.location.href="/web/brand/info";
                    return;
                }
            }
        })
    },
    del_img:function () {
        $('.wrap_brand_set .del_image').unbind().click(function () {
            $(this).parent().remove();
        });
    }
    }




$(document).ready(function () {
    $(".wrap_brand_set .upload_pic_wrap input[name=pic]").change(function () {
        $(".wrap_brand_set .upload_pic_wrap").submit();
    });

    brand.del_img();
    // brand.img_show();
})