<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="id" lang="id">

<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
 
<title>{{$titlepage}} | DINAS TENAGA KERJA DAN PERINDUSTRIAN</title>
<link href="{{asset('img/web/logo.png')}}" rel="shortcut icon" />
@section("meta-share")
@show
<meta name="Keywords" content="{{$titlepage}}, Batang Hari, Pemerintah Daerah, Kabupaten, Kabupaten Batang Hari, Muara Bulian, Serentak Bak Regam, Dinas Tenaga Kerja dan Perindustrian Kabupaten Batang Hari, 
Dinas Tenaga Kerja dan Perindustrian, Pengawasan"/>
<meta name="description" content="Dinas Tenaga Kerja dan Perindustrian {{$titlepage}}">
<meta name="author" content="Dinas Tenaga Kerja dan Perindustrian Kabupaten Batang Hari">
<meta name="copyright" content="Dinas Tenaga Kerja dan Perindustrian Kabupaten Batang Hari">
 
<meta name="rating" content="General">
<meta name="robots" content="all">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Favicon -->
<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon"/>
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Web Fonts -->
<link href="{{asset('css/font/font.css')}}" rel="stylesheet" type="text/css">
<!-- Vendor CSS -->
<link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/simple-line-icons/css/simple-line-icons.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/owl.carousel/assets/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/owl.carousel/assets/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{asset('vendor/magnific-popup/magnific-popup.min.css')}}">
<!-- Theme CSS -->
<link rel="stylesheet" href="{{asset('css/theme.css')}}">
<link rel="stylesheet" href="{{asset('css/theme-elements.css')}}">
<link rel="stylesheet" href="{{asset('css/theme-blog.css')}}">
<!-- Current Page CSS -->
<link rel="stylesheet" href="{{asset('vendor/rs-plugin/css/settings.css')}}" media="screen">
<link rel="stylesheet" href="{{asset('vendor/rs-plugin/css/layers.css')}}" media="screen">
<link rel="stylesheet" href="{{asset('vendor/rs-plugin/css/navigation.css')}}" media="screen">
<!-- Skin CSS -->
<link rel="stylesheet" href="{{asset('css/skins/default.css')}}">
<!-- Head Libs -->
<script async="async" src="{{asset('vendor/modernizr/modernizr.min.js')}}"></script>
 
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5c6e655370e9220011ed1e47&product=sticky-share-buttons' async='async'></script>

</head>
<body>
<div class='body'>
	<header id="header" class="header-narrow header-semi-transparent" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 57, "stickySetTop": "-60px", "stickyChangeLogo": false}'>
	<div class="header-body">
		<div class="header-top header-top-style-4">
			<div class="container">
				<!-- <div class="header-search">
					<div class="input-group">
						<input class="form-control" placeholder="Cari..." name="cari" id="cari" type="text" onkeyup="cari()">
						<div class="iconcari"></div>
					</div>
				</div> -->
				<nav class="header-nav-top pull-right">
				<ul class="nav nav-pills">
					<li class="hidden-xs">
						<span class="ws-nowrap"><i class="fa fa-envelope-o"></i><a href="https://webmail.batangharikab.go.id/" style="color:#fff;" target="_blank">E-mail</a></span>
					</li>
					<li>
						<span class="ws-nowrap"><b><i class="fa fa-check-square-o"></i><a href="http://portalaplikasi.batangharikab.go.id/" style="color:#fff;" target="_blank">Portal Aplikasi</a></b></span>
					</li>
				</ul>
				</nav>
			</div>
		</div>
		<div class="header-container container">
			<div class="header-row">
				<div class="header-column">
					<div class="header-logo">
						<a href="{{url('/')}}" style="padding-left: 5px; padding-top: 5px;">
							<img width="280" height="40" src="{{asset('img/web/disnakerin.png')}}" alt="Logos">
						</a>
					</div>
				</div>
				<div class="header-column">
					<div class="header-row">
						<div class="header-nav header-nav-stripe">
							<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
							<i class="fa fa-bars"></i>
							</button>
							<div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1 collapse">
								<nav>
								@include("main-nav")
								</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</header>
<div role='main' class='main'>
	<!-- <section class="page-header page-header-custom-backgroundb" style="background-image:url('{{asset('img/header/headerd.png')}}');background-position:center;">
	</section> -->
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<div class='container' style="background-color: white; padding: 20px;">
		@section("content")
		@show
	</div>
	<footer class="short" id="footer">
		<div class="footer-copyright">
			<div class="container">
				<div class="row center">
					<div class="col-md-12">
						<hr class="short">
						<p style="line-height:14px;">
							@include("info-instansi")
						<p>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>
</div>
<!-- Vendor -->
<script src="{{asset('vendor/jquery.js')}}"></script>
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/jquery.appear/jquery.appear.min.js')}}"></script>
<script src="{{asset('vendor/jquery.easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
@section("sisip_js")
@show
<!-- Theme Base, Components and Settings -->
<script src="{{asset('js/theme.js')}}"></script>
<!--vendor-->
<script src="{{asset('vendor/owl.carousel/owl.carousel.min.js')}}"></script>
<!-- Current Page Vendor and Views -->
<script src="{{asset('vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<!-- Admin Extension Specific Page Vendor -->
<!-- Admin Extension Examples-->
<!-- Theme Initialization Files -->
<script src="{{asset('js/theme.init.js')}}"></script>
<!--<script src="http://maps.google.com/maps/api/js"></script>-->
<!--Examples-->
<!-- wa script -->
<script> var url = 'https://widget.bot.space/js/widget.js'; 
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url; 
var options = {"enabled":true,"chatButtonSetting":{"backgroundColor":"#13C656","ctaText":"","borderRadius":"6","marginLeft":"20",
"marginBottom":"20","marginRight":"20","position":"right"},"brandSetting":{"brandName":"Dinas Tenaga Kerja dan Perindustrian",
"brandSubTitle":"Pemerintah Kabupaten Batang Hari","brandImg":"{{asset('img/web/logo.png')}}",
"welcomeText":"Hi Kamu yang disana!\nAda yang bisa saya bantu?","backgroundColor":"#01805E","ctaText":"Start Chat",
"borderRadius":"6","autoShow":false,"phoneNumber":"+6288747529347"}}; s.onload = function() { CreateWhatsappChatWidget(options); }; 
var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x); </script>
@section("js")
@show
</body>
</html>