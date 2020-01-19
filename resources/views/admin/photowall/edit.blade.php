@extends('admin.layou.baselist')

<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form" method="POST"  action="{{url('back/photoWall',['id'=>$photoWall!= null?$photoWall['id']:'0'])}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="put">
            <div class="layui-form-item">
                <label for="link" class="layui-form-label">名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" autocomplete="off" class="layui-input" @if (!empty($photoWall['name'])) value="{{$photoWall['name']}}" @endif>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="link" class="layui-form-label">
                    <span class="x-red">*</span>轮播图
                </label>
                <div class="layui-input-inline">
                    <div class="site-demo-upbar">
                        <input type="file" name="file" id="image">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label  class="layui-form-label">缩略图
                </label>
                <img id="LAY_demo_upload" width="200" @if (!empty($photoWall['simg'])) src="{{asset($photoWall['simg'])}}" @else src="{{asset('admin/images/banner.png')}}" @endif>
            </div>
            <div class="layui-form-item">
                <label  class="layui-form-label">
                </label>
{{--                （由于服务器资源有限，所以此处每次给你返回的是同一张图片)--}}
            </div>

            <div class="layui-form-item">
                <label for="link" class="layui-form-label">链接</label>
                <div class="layui-input-inline">
                    <input type="text" id="link" name="href" autocomplete="off" class="layui-input" @if (!empty($photoWall['href'])) value="{{$photoWall['href']}}" @endif>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="desc" class="layui-form-label">描述</label>
                <div class="layui-input-inline">
                    <input type="text" id="desc" name="notes" autocomplete="off" class="layui-input" @if (!empty($photoWall['notes'])) value="{{$photoWall['notes']}}" @endif>
                </div>
{{--                <div class="layui-form-mid layui-word-aux">--}}
{{--                    <span class="x-red">*</span>--}}
{{--                </div>--}}
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                <button type="submit" id="edit" class="layui-btn">提交</button>
            </div>
        </form>
    </div>
</div>
@section('javaScript')
    <script>
        //上传图片前预览
        $('#image').on('change', function () {
            var imgdate = $(this).get(0);
            var showing = $('#LAY_demo_upload');
            console.log(window.URL.createObjectURL(imgdate.files[0]));
            if (imgdate.files && imgdate.files[0]) {
                showing.attr('src',window.URL.createObjectURL(imgdate.files[0]))
            }
        })
    </script>
@endsection