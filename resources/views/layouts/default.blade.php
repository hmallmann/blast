<html lang="pt">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Blast App</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- jQuery 2.2.3 -->
        <script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="/css/admin/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/css/admin/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
{{--        <link rel="stylesheet" href="/css/admin/skins/_all-skins.min.css">--}}
        <link rel="stylesheet" href="/css/admin/skins/skin-blue.css">

        <link rel="stylesheet" href="/css/admin/admin.css">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('layouts.components.header')
            @include('layouts.components.menu')

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        @yield('header')
                    </h1>
                </section>
                <section class="content">
                    @yield('content')
                </section>
            </div>
        </div>



        <!-- Bootstrap 3.3.6 -->
        <script src="/js/admin/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="/plugins/fastclick/fastclick.js"></script>
        <!-- jvectormap -->
        <script src="/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- AdminLTE App -->
        <script src="/js/admin/app.min.js"></script>

        <script>
            $(function () {
                $(".table-striped").DataTable();
            });
        </script>
    </body>
</html>
