<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
<meta charset="utf-8"/>
<title>Login </title>
<meta name="description" content="Form repeater examples">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<!--begin::Web font -->
<script src="{{asset('dashboard/libs/webfont/1.6.16/webfont.js')}}"></script>
<script>
  WebFont.load({
    google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
    active: function() {
        sessionStorage.fonts = true;
    }
  });
</script>
<!--end::Web font -->
<!--begin::Base Styles -->
<link href="{{asset('dashboard/assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('dashboard/assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
<!--end::Base Styles -->
<link rel="shortcut icon" href="{{asset('dashboard/assets/demo/default/media/img/logo/favicon.ico')}}"/>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','../../../../../../../www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-37564768-1', 'auto');
  ga('send', 'pageview');
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','../../../../../../../www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-37564768-1', 'auto');
  ga('send', 'pageview');
</script>
</head>
<!-- end::Head -->
<!-- begin::Body -->
<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<div class="m-grid m-grid--hor m-grid--root m-page">
    
			
				<div class="m-grid__item m-grid__item--fluid m-grid m-grid--desktop m-grid--ver-desktop m-grid--hor-tablet-and-mobile m-login m-login--6" id="m_login">
	<div class="m-grid__item   m-grid__item--order-tablet-and-mobile-2  m-grid m-grid--hor m-login__aside " style="background-image: url(dashboard/assets/app/media/img/bg/bg-4.jpg);">
		<div class="m-grid__item">
			<div class="m-login__logo">
				<a href="#">
					<img src="dashboard/assets/app/media/img/logos/logo-4.png">
				</a>
			</div>
		</div>

		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver">
			<div class="m-grid__item m-grid__item--middle">
				<span class="m-login__title">Selamat Datang Di Halaman Administrator Website</span>
				<span class="m-login__subtitle">Pemerintah Kab. Batang Hari</span>
			</div>
		</div>

		<div class="m-grid__item">
			<div class="m-login__info">
				<div class="m-login__section">
					<a href="#" class="m-link">&copy 2019 Diskominfo Batang Hari</a>
				</div>
			</div>
		</div>
	</div>

	<div class="m-grid__item m-grid__item--fluid  m-grid__item--order-tablet-and-mobile-1  m-login__wrapper">
		
		<!--begin::Body-->
		<div class="m-login__body">

			<!--begin::Signin-->
			<div class="m-login__signin">
				<div class="m-login__title">
					<h3>Login dengan Akun Anda</h3>
				</div>
				<form class="m-login__form m-form" action="{{url('submit-login')}}" method="post">
				<!--begin::Form-->
				
					{{csrf_field()}}
					<div class="form-group m-form__group">
						<input class="form-control m-input" type="text" placeholder="Username" name="username" autocomplete="off">
					</div>
					<div class="form-group m-form__group">
						<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" 
						name="password">
					</div>
				
				<!--end::Form-->

				<!--begin::Action-->
				<div class="m-login__action">
					<a href="#" class="m-link">
						<span>Forgot Password ?</span>
					</a>
					<a href="#">
						<button type="submit" id="m_login_signin_submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign In</button>
					</a>
				</div>
				<!--end::Action-->
				</form>
				
			</div>
			<!--end::Signin-->
		</div>
		<!--end::Body-->
	</div>
</div>

</div>
<!-- end:: Page -->
<script src="{{asset('dashboard/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootbox.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
		@if(Session::has('error'))
		bootbox.alert("{!! Session::get('error') !!}");
		@endif
	})
</script>
</body>
</html>