<!DOCTYPE html>
<html class="x-admin-sm">
@include('admin.layou.headcss')
<body>
@section('nav')
    @show
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                @section('content')
                    @show
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(function(){
        //添加修改删除成功提示框
        var message = '{{$message}}';
        if(message != ''){
            layer.msg(message,{icon: 6,anim:6,time:2000});
        }
    });
    //弹框关闭
    $(document).on('click', '.layui-layer-close', function() {
        // xadmin.close();
        // xadmin.father_reload();
        window.location.reload();
    })

</script>

</html>