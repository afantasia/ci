<!DOCTYPE html>
<html lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>공생 관리자 시스템 </title>
	<!-- Bootstrap -->
	<link href="/resource/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="/resource/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="/resource/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- Animate.css -->
	<link href="/resource/admin/vendors/animate.css/animate.min.css" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="/resource/admin/build/css/custom.min.css" rel="stylesheet">
	<script src="/resource/admin/vendors/jquery/dist/jquery.min.js"></script>
	<script src="/resource/common.js"></script>
</head>
<body class="login">
<div>
	<a class="hiddenanchor" id="signup"></a>
	<a class="hiddenanchor" id="signin"></a>
	<div class="login_wrapper">
		<div class="animate form login_form">
			<section class="login_content">
				<form id="loginForm" action="javascript:Login();">
					<h1>관리자 로그인</h1>
					<div>
						<input type="text" class="form-control" name='email' placeholder="관리자ID" required="" />
					</div>
					<div>
						<input type="password" class="form-control" name="password" placeholder="패스워드" required="" />
					</div>
					<div>
						<button class="btn btn-default submit" href="javascript:Login()">로그인</button>
					</div>
					<div class="clearfix"></div>
				</form>
			</section>
		</div>
	</div>
</div>
</body>
</html>
