$(document).ready(function () {
    layui.use(['form', 'jquery', 'layer'], function(){
        form = layui.form;
        form.on('switch(switchButton)', function (data) {
            var contexts;
            var x = data.elem.checked;//判断开关状态
            if (x==true) {
                contexts = "你确定要启用么?";
            } else {
                contexts = "你确定要禁用么?";
            }
            layer.confirm(contexts,function() {

            })
            return false;
        });
    });
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    /*公共删除*/
    $('.del').on('click', function () {
        console.log(1111111);
        var d_url = $(this).data('href');
        delList(d_url);
    })
    function delList(d_url){
        layer.confirm('确认要删除吗？',function() {
            $.ajax({
                // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "DELETE",
                url: d_url,
                dataType: 'json',
                success: function (msg) {
                    layer.msg(msg.message,{icon: 6,anim:6,time:1000},function(){
                        location.replace(location.href);
                    });
                },
                error: function (msg) {
                    layer.msg(msg.error,{icon: 5,anim:6,time:1000});
                }
            });
        });
    }

    // 分类展开收起的分类的逻辑
    //
    $(function(){
        $("tbody.x-cate tr[fid!='0']").hide();
        // 栏目多级显示效果
        $('.x-show').click(function () {
            if($(this).attr('status')=='true'){
                $(this).html('&#xe625;');
                $(this).attr('status','false');
                cateId = $(this).parents('tr').attr('cate-id');
                $("tbody tr[fid="+cateId+"]").show();
            }else{
                cateIds = [];
                $(this).html('&#xe623;');
                $(this).attr('status','true');
                cateId = $(this).parents('tr').attr('cate-id');
                getCateId(cateId);
                for (var i in cateIds) {
                    $("tbody tr[cate-id="+cateIds[i]+"]").hide().find('.x-show').html('&#xe623;').attr('status','true');
                }
            }
        })
    })

    var cateIds = [];
    function getCateId(cateId) {
        $("tbody tr[fid="+cateId+"]").each(function(index, el) {
            id = $(el).attr('cate-id');
            cateIds.push(id);
            getCateId(id);
        });
    }
})