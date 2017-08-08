<!DOCTYPE html>
<html lang="ko">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>관리자메인</title>
    <!-- Bootstrap -->
    <link href="/resource/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/resource/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/resource/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="/resource/admin/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    <!-- Custom Theme Style -->
    <link href="/resource/admin/build/css/custom.min.css" rel="stylesheet">
    <!--어드민 페이지네이션외 기타 bootstrap 외 확장 스타일시트-->
    <link href="/resource/admin/admin.css" rel="stylesheet">

	<script src="/basic/vue.js"></script>
    <!--원래 밑에가있었는데 혹시나해서 위로 올려둠-->
    <?foreach($ResourceTop as $k =>$r01):?><?=$r01.PHP_EOL?><?endforeach;?>
</head>
<body class="nav-md footer_fixed">

<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <?$this->view($leftmenu)?>
        </div>

        <?$this->view($topmenu)?>
        <!-- page content -->
        <div class="right_col" role="main">
            <?$this->view($template_name)?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?$this->view($footer)?>
        <!-- /footer content -->
    </div>
</div>
<!-- jQuery -->
<script src="/resource/admin/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/resource/admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/resource/admin/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="/resource/admin/vendors/nprogress/nprogress.js"></script>
<!-- jQuery custom content scroller -->
<script src="/resource/admin/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- iCheck -->
<script src="/resource/admin/vendors/iCheck/icheck.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="/resource/admin/build/js/custom.min.js"></script>
<script src="/resource/common.js"></script>
<?foreach($ResourceBottom as $k =>$r02):?><?=$r02.PHP_EOL?><?endforeach;?>
</body>
</html>
