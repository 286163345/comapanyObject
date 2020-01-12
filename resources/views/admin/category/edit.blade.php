@extends('admin.layou.baselist')

<div class="layui-fluid">
    <div class="layui-row">
        <form method="POST" action="{{url('back/category',['id'=>$category!= null?$category['id']:'0'])}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="fid" value="{{$fid?$fid:0}}">
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>分类名</label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="name" required="" lay-verify="nikename" autocomplete="off" class="layui-input" @if ($category != null) value="{{$category['name']}}" @endif></div>
            </div>
{{--            <div class="layui-form-item">--}}
{{--                <label for="L_username" class="layui-form-label">--}}
{{--                    --}}{{--<span class="x-red">*</span>--}}{{--排序</label>--}}
{{--                <div class="layui-input-inline">--}}
{{--                    <input type="text" id="L_username" name="orderBy" required="" lay-verify="nikename" autocomplete="off" class="layui-input" @if ($category != null) value="{{$category['name']}}" @endif></div>--}}
{{--            </div>--}}
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                <button type="submit" id="edit" class="layui-btn">提交</button></div>
        </form>
    </div>
</div>