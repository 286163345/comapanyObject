@extends('admin.layou.baselist')
@section('nav')
    @include('admin.layou.nav')
    @endsection
@section('content')
    <div class="layui-card-body ">
        <xblock>
            <button class="layui-btn layui-btn-danger" data-url="{{URL::current()}}" id="delAll">
                <i class="layui-icon">&#xe640;</i>批量删除
            </button>
            <button class="layui-btn" onclick="xadmin.open('添加','{{url('back/banner/create')}}',600,400)">
                <i class="layui-icon">&#xe608;</i>添加
            </button>
        </xblock>
        <table class="layui-table layui-form">
            <thead>
            <tr>
                <th width="20">
                    <input type="checkbox"  lay-filter="allChoose" lay-skin="primary">
{{--                    <button class="layui-btn" id="scheck">全选</button>--}}
                </th>
                <th>ID</th>
                <th>缩略图</th>
                <th>链接</th>
                <th>描述</th>
                <th>显示状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="x-img">
            @foreach($banner as $value)
            <tr>
                <th width="20">
                    <input type="checkbox" class="item_id" name="item_id" lay-skin="primary" value="{{$value['id']}}">
                </th>
                <td>{{$value['id']}}</td>
                <td><img src="{{asset($value['simg'])}}" class="simg" width="200" alt="">点击图片试试</td>
{{--                <td><img src="{{\Illuminate\Support\Facades\Storage::url($value['simg'])}}" class="simg" width="200" alt="">点击图片试试</td>--}}
                <td>{{$value['href']}}</td>
                <td>{{$value['notes']}}</td>
{{--                <td class="td-status">--}}
{{--                <td class="td-status"> <span class="layui-btn layui-btn-normal layui-btn-mini">已显示</span></td>--}}
{{--                </td>--}}
                <td>
                    <input type="checkbox" name="switch"  lay-text="显示|禁用"  checked="" lay-skin="switch" lay-filter="switchButton">
                </td>
                <td class="td-manage">
{{--                    <a style="text-decoration:none" onclick="banner_stop(this,'10001')" href="javascript:;" title="不显示">--}}
{{--                        <i class="layui-icon">&#xe601;</i>--}}
{{--                    </a>--}}
                    <button class="layui-btn layui-btn layui-btn-xs"  onclick='xadmin.open("编辑","{{url('back/banner/'.$value['id'].'/edit')}}",600,400)' ><i class="layui-icon">&#xe642;</i>编辑</button>
                    <button class="layui-btn-danger layui-btn layui-btn-xs del"  data-href="{{ url('back/banner',$value['id']) }}" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>

        <div id="page"></div>
    </div>
    @endsection
<script>
    /*停用*/
    function banner_stop(obj,id){
        layer.confirm('确认不显示吗？',function(index){
            //发异步把用户状态进行更改
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="banner_start(this,id)" href="javascript:;" title="显示"><i class="layui-icon">&#xe62f;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-disabled layui-btn-mini">不显示</span>');
            $(obj).remove();
            layer.msg('不显示!',{icon: 5,time:1000});
        });
    }

    /*启用*/
    function banner_start(obj,id){
        layer.confirm('确认要显示吗？',function(index){
            //发异步把用户状态进行更改
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="banner_stop(this,id)" href="javascript:;" title="不显示"><i class="layui-icon">&#xe601;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">已显示</span>');
            $(obj).remove();
            layer.msg('已显示!',{icon: 6,time:1000});
        });
    }
</script>