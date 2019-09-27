<ul class="layui-nav right" lay-filter="">
    <li class="layui-nav-item">
        <a href="javascript:;">admin</a>
        <dl class="layui-nav-child">
            <!-- 二级菜单 -->
            <dd>
                <a onclick="xadmin.open('个人信息','http://www.baidu.com')">个人信息</a></dd>
            <dd>
                <a onclick="xadmin.open('切换帐号','http://www.baidu.com')">切换帐号</a></dd>
            <dd>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    退出
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </dd>
        </dl>
    </li>
    {{--@guest--}}
        {{--<li><a href="{{ route('login') }}">Login</a></li>--}}
        {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
    {{--@else--}}
        {{--<li class="dropdown">--}}
            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>--}}
                {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
            {{--</a>--}}

            {{--<ul class="dropdown-menu">--}}
                {{--<li>--}}
                    {{--<a href="{{ route('logout') }}"--}}
                       {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                        {{--Logout--}}
                    {{--</a>--}}

                    {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                        {{--{{ csrf_field() }}--}}
                    {{--</form>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</li>--}}
    {{--@endguest--}}
    <li class="layui-nav-item to-index">
        <a href="/">前台首页</a></li>
</ul>
