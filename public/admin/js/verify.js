$(function () {
    $("#edit").on('click',function () {
        var passReplace = /(.+){6,12}$/;
        if(!passReplace.test($("#L_pass").val()) && $("#L_pass").val() != ''){
            layer.msg('密码必须6到12位!',{icon: 5,anim:6,time:2000});
            return false;
        }
        if ($('#L_pass').val() != $('#L_repass').val()) {
            layer.msg('两次密码不一致!',{icon: 5,anim:6,time:2000});
            return false;
        }
    })
    $("#add").on('click',function () {
        var passReplace = /(.+){6,12}$/;
        if(!passReplace.test($("#L_pass").val()) && $("#L_pass").val() != ''){
            layer.msg('密码必须6到12位!',{icon: 5,anim:6,time:2000});
            return false;
        }
        if ($('#L_pass').val() == '') {
            layer.msg('密码不能为空!',{icon: 5,anim:6,time:2000});
            return false;
        }else if($('#L_pass').val() != $('#L_repass').val()){
            layer.msg('两次密码不一致!',{icon: 5,anim:6,time:2000});
            return false;
        }
    })
})