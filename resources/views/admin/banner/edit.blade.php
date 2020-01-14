@extends('admin.layou.baselist')

<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form" method="POST"  action="{{url('back/banner',['id'=>$banner!= null?$banner['id']:'0'])}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="put">
            <div class="layui-form-item">
                <label for="link" class="layui-form-label">
                    <span class="x-red">*</span>轮播图
                </label>
                <div class="layui-input-inline">
                    <div class="site-demo-upbar">
                        <input type="file" name="file">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label  class="layui-form-label">缩略图
                </label>
                <img id="LAY_demo_upload" width="200" src="{{asset('admin/images/banner.png')}}">
            </div>
            <div class="layui-form-item">
                <label  class="layui-form-label">
                </label>
                （由于服务器资源有限，所以此处每次给你返回的是同一张图片)
            </div>

            <div class="layui-form-item">
                <label for="link" class="layui-form-label">
                    <span class="x-red">*</span>链接
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="link" name="href" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="desc" class="layui-form-label">
                    <span class="x-red">*</span>描述
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="desc" name="notes" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                <button type="submit" id="edit" class="layui-btn">提交</button>
            </div>
        </form>
    </div>
</div>