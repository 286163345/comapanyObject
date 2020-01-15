@extends('admin.layou.baselist')
@section('nav')
    @include('admin.layou.nav')
@endsection
@section('content')
    <div class="layui-card-body ">
{{--        <form method="POST" action="{{url('back/category')}}">--}}
{{--            <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
{{--            <div class="layui-input-inline layui-show-xs-block">--}}
{{--                <input class="layui-input" placeholder="分类名" name="name">--}}
{{--                <input type="hidden" name="fid" value="0">--}}
{{--            </div>--}}
{{--            <div class="layui-input-inline layui-show-xs-block">--}}
{{--                <button class="layui-btn" type="submit" onclick="xadmin.open('添加用户','{{url('back/category/create')}}',600,400)"><i class="layui-icon"></i>增加</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--        <hr>--}}
        <blockquote class="layui-elem-quote">头顶的添加直接添加的是顶级类目,子类目需要在下面添加</blockquote>
    </div>
    <div class="layui-card-header">
        <button class="layui-btn layui-btn-danger" data-url="{{URL::current()}}" id="delAll">
            <i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" type="submit" onclick="xadmin.open('添加用户','{{url('back/category/create')}}',460,200)"><i class="layui-icon"></i>增加</button>
    </div>
    <div class="layui-card-body ">
        <table class="layui-table layui-form">
            <thead>
            <tr>
                <th width="20">
                    <input type="checkbox" lay-filter="allChoose" lay-skin="primary">
                </th>
                <th width="70">ID</th>
                <th width="70">fid</th>
                <th>栏目名</th>
                <th width="50">排序</th>
                <th width="80">状态</th>
                <th width="250">操作</th>
            </thead>
            <tbody class="x-cate">
            @foreach($category as $k => $v)
                <tr cate-id='{{$v['id']}}' fid='{{$v['fid']}}' >
                    <td>
                        <input type="checkbox" class="item_id" name="item_id" value="{{$v['id']}}" lay-skin="primary">
                    </td>
                    <td>{{$v['id']}}</td>
                    <td>{{$v['fid']}}</td>
                    <td>
                        @if($v['fid'] != 0) &nbsp;&nbsp;&nbsp;&nbsp; @endif
                        <i class="layui-icon x-show" status='true'>&#xe623;</i>
                        {{$v['name']}}
                    </td>
                    <td><input type="text" class="layui-input x-sort" name="order" value="{{$v['order_by']}}"></td>
                    <td>
                        <input type="checkbox" name="switch"  lay-text="启用|禁用"  checked="" lay-skin="switch" lay-filter="switchButton">
                    </td>
                    <td class="td-manage">
                        <button class="layui-btn layui-btn layui-btn-xs"  onclick='xadmin.open("编辑","{{url('back/category/'.$v['id'].'/edit')}}",460,200)' ><i class="layui-icon">&#xe642;</i>编辑</button>
                        <button class="layui-btn layui-btn-warm layui-btn-xs"  onclick='xadmin.open("编辑","{{url('back/category/create')}}?fid={{$v['id']}}",460,200)' ><i class="layui-icon">&#xe642;</i>添加子栏目</button>
                        <button class="layui-btn-danger layui-btn layui-btn-xs del"  data-href="{{ url('back/category',$v['id']) }}" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
