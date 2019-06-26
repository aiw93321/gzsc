var account = {
    submit:function () {
        var parmas=[];
        var status = $('.wrap_search select[name=status]').val();
        if (status!=-1){
            parmas['status']=status;
        }
        var mix_kw = $('.wrap_search input[name=mix_kw]').val();
        if (mix_kw!=''){
            parmas['mix_kw']=mix_kw;
        }
        if (status==-1 && mix_kw==''){
            layer.msg('您是不是应该做些什么！');
            return;
        }
        var tr = "";
        $.ajax({
            url:'/web/account/query',
            type:'POST',
            data:{
                status:status,
                mix_kw:mix_kw
            },
            dataType:'json',
            success:function (res) {
                // btn_target.removeClass('disabled');
                if ( res.code == '-1'){
                    $("#lists_table>tbody").html(tr);
                    layer.msg(res.msg);
                    return;
                }
                if ( res.code == '200'){
                    $.each(res.data,function (i,v) {
                        tr+='<tr>';
                        tr+='<td>'+v.uid+'</td>';
                        tr+='<td>'+v.nickname+'</td>';
                        tr+='<td>'+v.mobile+'</td>';
                        tr+='<td>'+v.email+'</td>';
                        tr+='<td>';
                        tr+='<a  href="/web/account/info?id='+v.uid+'"><i class="fa fa-eye fa-lg"></i> </a>';
                        tr+='<a class="m-l" href="/web/account/set?id='+v.uid+'"><i class="fa fa-edit fa-lg"></i></a>';
                        tr+='<a class="m-l remove" href="javascript:void(0);" data="'+v.uid+'"><i class="fa fa-trash fa-lg"></i></a>';
                        tr+='</td>';
                        tr+='</tr>';
                    });
                    $("#lists_table>tbody").html(tr);
                    layer.msg(res.msg);
                    return;
                }
            }
        })
    },
    set:function (id) {
        var nickname = $('.wrap_account_set input[name=nickname]').val();
        var mobile = $('.wrap_account_set input[name=mobile]').val();
        var email = $('.wrap_account_set input[name=email]').val();
        var login_name = $('.wrap_account_set input[name=login_name]').val();
        var login_pwd = $('.wrap_account_set input[name=login_pwd]').val();
        $.ajax({
            url:'/web/account/add-set',
            type:'POST',
            data:{
                nickname:nickname,
                mobile:mobile,
                email:email,
                login_name:login_name,
                login_pwd:login_pwd,
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
                    return;
                }
            }
        })
    }
}