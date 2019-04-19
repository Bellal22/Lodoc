<script src="//unpkg.com/vue/dist/vue.js"></script>
<script src="//unpkg.com/element-ui@2.4.2/lib/index.js"></script>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" id="template" role="navigation" style="margin-bottom: 0">

    <ul class="nav navbar-top-links navbar-right">
        <img width="30" height="30" src="http://www.shl-app.com/wp-content/uploads/Group-1663.png"
             class="img-responsive" alt="تطبيق سهل "/>
    </ul>

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="javascript:;">لوحة تحكم التطبيق </a>
    </div>
    <div class="navbar-header">

        <a style="margin-top:7px ; " class="btn btn-warning" href="{{url('http://locationdoctor.com')}}"><i class="fa fa-sign-out">
                &nbsp;خروج</i> </a>
    </div>
    <!-- /.navbar-header -->


    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                {{--<li>--}}
                {{--<a href="#"><i class="fa fa-mobile fa-fw"></i> <span class="fa arrow"></span>--}}
                {{--</a>--}}
                {{--<ul class="nav nav-second-level">--}}

                {{--</ul>--}}
                {{--<!-- /.nav-second-level -->--}}
                {{--</li>--}}

                <li><a href={{url('/services')}}><i class="fa fa-address-book"></i> المستخدمين</a></li>
                <li><a href={{url('/services_prices')}}><i class="fa fa-plus"></i> طلبات الأنضمام</a></li>
                <li><a href={{url('/contact_us')}}><i class="fa fa-product-hunt"></i> الأحصائيات </a></li>
                <li><a href={{url('/social_media')}}><i class="fa fa-credit-card"></i> الحسابات البنكية </a>
                </li>

            </ul>
            <center>
                Powered by <a href="http://alexforprog.com" target="_blank">AlexApps</a>
            </center>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

{{--side bar and header end--}}



