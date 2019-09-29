@extends('admin.layou.baselist')

<div class="layui-fluid">
    <div class="layui-row">
        <form method="POST" action="{{url('back/user',['id'=>$user['id']])}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="put">
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>用户名</label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="name" required="" lay-verify="nikename" autocomplete="off" class="layui-input" value="{{$user['name']}}"></div>
            </div>
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>邮箱</label>
                <div class="layui-input-inline">
                    <input type="email" id="L_email" name="email" readonly="" lay-verify="email" autocomplete="off" class="layui-input" value="{{$user['email']}}"></div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>将会成为您唯一的登入名</div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">密码</label>
                <div class="layui-input-inline">
                    <input type="password" id="L_pass" name="password" lay-verify="pass" autocomplete="off" class="layui-input"></div>
                <div class="layui-form-mid layui-word-aux">6到16个字符,不填写则不修改</div></div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">确认密码</label>
                <div class="layui-input-inline">
                    <input type="password" id="L_repass" name="repass" lay-verify="repass" autocomplete="off" class="layui-input"></div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                <button type="submit" id="edit" class="layui-btn">修改</button></div>
        </form>
    </div>
</div>