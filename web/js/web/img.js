var img = {
    img_show: function () {
        $('#brand_image_wrap').modal('show');
    },
    submit:function () {
        var image_key = $('#brand_image_wrap .upload_pic_wrap .pic-each .del_image').attr("data");
        if ($('#brand_image_wrap .upload_pic_wrap .pic-each .del_image').size()<1){
            layer.msg('请上传品牌logo！');
            return;
        }
        $.ajax({
            url:'/web/brand/img-submit',
            type:'POST',
            data:{
                image_key:image_key
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
                    window.location.href="/web/brand/images";
                    return;
                }
            }
        })
    },
    del:function (id) {
        $.ajax({
            url:'/web/brand/img-del',
            type:'POST',
            data:{
                id:id
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
                    window.location.href="/web/brand/images";
                    return;
                }
            }
        })
    }
}
    $(document).ready(function () {
        $("#brand_image_wrap .upload_pic_wrap input[name=pic]").change(function () {
            $("#brand_image_wrap .upload_pic_wrap").submit();
        })
    })