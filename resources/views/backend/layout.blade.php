<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
<meta charset="utf-8"/>
<title>Web Administrator </title>
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
<link href="{{asset('dashboard/assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('dashboard/assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('dashboard/assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/animate.css')}}" rel="stylesheet">
<link href="{{asset('css/line-awesome.min.css')}}" rel="stylesheet">
<link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('css/select2-bootstrap.min.css')}}" rel="stylesheet">
 
<link href="{{asset('css/notify.css')}}" rel="stylesheet">
<!--end::Base Styles -->
<link rel="shortcut icon" href="{{asset('dashboard/assets/demo/default/media/img/logo/favicon.ico')}}"/>
<script src="{{asset('dashboard/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
@section("sisip")
@show
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
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
	<!-- BEGIN: Header -->
	<header id="m_header" class="m-grid__item m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
	<div class="m-container m-container--fluid m-container--full-height">
		<div class="m-stack m-stack--ver m-stack--desktop">
			<!-- BEGIN: Brand -->
			<div class="m-stack__item m-brand m-brand--skin-dark ">
				<div class="m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-stack__item--middle m-brand__logo">
						<a href="{{url('backend/')}}" class="m-brand__logo-wrapper"><img alt="" src="{{asset('dashboard/assets/demo/default/media/img/logo/logo_default_dark.png')}}"/></a>
					</div>
					<div class="m-stack__item m-stack__item--middle m-brand__tools">
						<!-- BEGIN: Left Aside Minimize Toggle -->
						<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block "><span></span></a>
						<!-- END -->
						<!-- BEGIN: Responsive Aside Left Menu Toggler -->
						<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block"><span></span></a>
						<!-- END -->
						<!-- BEGIN: Responsive Header Menu Toggler -->
						<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block"><span></span></a>
						<!-- END -->
						<!-- BEGIN: Topbar Toggler -->
						<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block"><i class="flaticon-more"></i></a>
						<!-- BEGIN: Topbar Toggler --></div>
				</div>
			</div>
			<!-- END: Brand -->
			<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
				<!-- BEGIN: Horizontal Menu -->
				<button class="m-aside-header-menu-mobile-close m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
				<!-- END: Horizontal Menu -->
				<!-- BEGIN: Topbar -->
				<div id="m_header_topbar" class="m-topbar m-stack m-stack--ver m-stack--general m-stack--fluid">
					<div class="m-stack__item m-topbar__nav-wrapper">
						@include("backend.topbar")
					</div>
				</div>
				<!-- END: Topbar -->
			</div>
		</div>
	</div>
	</header>
	<!-- END: Header -->
	<!-- begin::Body -->
	<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
		<!-- BEGIN: Left Aside -->
		<button class="m-aside-left-close m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
		<div id="m_aside_left" class="m-grid__item	m-aside-left m-aside-left--skin-dark ">
			<!-- BEGIN: Aside Menu -->
			@include("backend.sidebar")
			<!-- END: Aside Menu -->
		</div>
		<!-- END: Left Aside -->
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			@section("content")
			@show
		</div>
	</div>
	<!-- end:: Body -->
	<!-- begin::Footer -->
	<footer class="m-grid__item m-footer ">
	<div class="m-container m-container--fluid m-container--full-height m-page__container">
		<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
			<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
				<span class="m-footer__copyright">
				2018 &copy; Diskominfo Batang Hari - Website Administrator 
				</span>
			</div>
		</div>
	</div>
	</footer>
	<!-- end::Footer --></div>
<!-- end:: Page -->
<!-- begin::Quick Sidebar -->

<div id="m_scroll_top" class="m-scroll-top">
	<i class="la la-arrow-up"></i>
</div>


@section("modal")
@show
<script type="text/javascript">
    $base_url = '{{url("/")}}';
</script>

<script src="{{asset('js/bootbox.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap-notify.js')}}"></script>
<script src="{{asset('js/jquery.form.min.js')}}"></script>
<script src="{{asset('js/jquery.mask.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/jquery.number.min.js')}}"></script>
<script src="{{asset('js/moment-with-locales.js')}}"></script>
<script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
<script src="{{asset('js/init.js')}}"></script>
@section("js")
@show
</body>
</html>