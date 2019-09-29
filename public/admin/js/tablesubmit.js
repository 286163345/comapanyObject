$(document).ready(function () {
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
})