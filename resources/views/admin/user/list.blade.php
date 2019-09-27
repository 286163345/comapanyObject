@extends('admin.layou.baselist')
@section('nav')
    @include('admin.layou.nav')
    @endsection
@section('content')
    <div class="layui-card-body ">
        <form class="layui-form layui-col-space5">
            <div class="layui-inline layui-show-xs-block">
                <input class="layui-input"  autocomplete="off" placeholder="开始日" name="start" id="start">
            </div>
            <div class="layui-inline layui-show-xs-block">
                <input class="layui-input"  autocomplete="off" placeholder="截止日" name="end" id="end">
            </div>
            <div class="layui-inline layui-show-xs-block">
                <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-inline layui-show-xs-block">
                <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </div>
        </form>
    </div>
    <div class="layui-card-header">
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="xadmin.open('添加用户','{{url('back/user/create')}}',600,400)"><i class="layui-icon"></i>添加</button>
    </div>
    <div class="layui-card-body layui-table-body layui-table-main">
        <table class="layui-table layui-form">
            <thead>
            <tr>
                <th>
                    <input type="checkbox" lay-filter="checkall" name="" lay-skin="primary">
                </th>
                <th>ID</th>
                <th>用户名</th>
                <th>邮箱</th>
                <th>创建时间</th>
                <th>更新时间</th>
                <th>操作</th></tr>
            </thead>
            <tbody>
            <tr>
                @foreach($user as $value)
                    <td>
                        <input type="checkbox" name="id" value="1"   lay-skin="primary">
                    </td>
                    <td>{{$value['id']}}</td>
                    <td>{{$value['name']}}</td>
                    <td>{{$value['email']}}</td>
                    <td>{{$value['created_at']}}</td>
                    <td>{{$value['updated_at']}}</td>
                    <td class="td-manage">
                        <a title="编辑"  onclick="xadmin.open('编辑','{{url('back/user'.$value['id'].'/edit')}}',600,400)" href="javascript:;">
                            <i class="layui-icon">&#xe642;</i>
                        </a>
                        <a title="删除" data-href="{{ url('back/user',$value['id']) }}" id="" href="javascript:;">
                            <i class="layui-icon">&#xe640;</i>
                        </a>
                    </td>
                    @endforeach
            </tbody>
        </table>
    </div>
    <div class="layui-card-body ">
        <div class="page">
            <div>
                <a class="prev" href="">&lt;&lt;</a>
                <a class="num" href="">1</a>
                <span class="current">2</span>
                <a class="num" href="">3</a>
                <a class="num" href="">489</a>
                <a class="next" href="">&gt;&gt;</a>
            </div>
        </div>
    </div>
    @endsection