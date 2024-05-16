<?php
$path = Request::segment(2);
$menu_session  = Session::get('mswbadmin');
$menu_session = json_decode($menu_session);
?>
<div id="m_ver_menu" class="m-aside-menu m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
	<ul class="m-menu__nav m-menu__nav--dropdown-submenu-arrow ">
		<li class="m-menu__section ">
			<h4 class="m-menu__section-text">Menu</h4>
			<i class="m-menu__section-icon flaticon-more-v2"></i>
		</li>
		<li class="m-menu__item  " aria-haspopup="true">
			<a href="{{url('')}}" target="_blank" class="m-menu__link "><i class="m-menu__link-icon la la-location-arrow"></i><span class="m-menu__link-title">
				<span class="m-menu__link-wrap"><span class="m-menu__link-text">Lihat Website</span></span></a>
		</li>
		<li class="m-menu__item  " aria-haspopup="true">
			<a href="{{url('backend/')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-title">
				<span class="m-menu__link-wrap"><span class="m-menu__link-text">Beranda</span></span></a>
		</li>
		@foreach($menu_session as $mnu_induk)
		<?php
			$isOpen=false; 
			foreach($mnu_induk->child as $mnu_child){
				if($path==$mnu_child->url ){
					$isOpen=true;
				}
			}
		?>
		<li class="m-menu__item m-menu__item--submenu @if($isOpen) m-menu__item--open @endif"  id="mnu_g_{{$mnu_induk->id_menu}}" aria-haspopup="true" m-menu-submenu-toggle="hover">
			<a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon {{$mnu_induk->icon}}"></i><span class="m-menu__link-text">{{$mnu_induk->nama_menu}}</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
			<div class="m-menu__submenu " id="mnu_gc_{{$mnu_induk->id_menu}}">
				<span class="m-menu__arrow"></span>
				<ul class="m-menu__subnav">
					<li class="m-menu__item m-menu__item--parent " aria-haspopup="true">
						<span class="m-menu__link"><span class="m-menu__link-text">{{$mnu_induk->nama_menu}}</span></span>
					</li>
					@foreach($mnu_induk->child as $mnu_child)
					<?php
						$isActive=false; 
						if($path==$mnu_child->url ){
							$isActive=true;
						}
					?>
					<li class="m-menu__item @if($isActive) m-menu__item--active @endif " aria-haspopup="true" 
					id="mnu_c_{{$mnu_child->id_menu}}">
						<a href="{{url('backend/'.$mnu_child->url)}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
							<span class="m-menu__link-text">
							{{$mnu_child->nama_menu}}
							@if($mnu_child->url=='kotak-pesan')
								<?php 
								$mark = DB::table('pesan')->where('dibaca','0')->count();
								?>
								@if($mark>0)
								<span class="m-menu__link-badge">
									<span class="m-badge m-badge--danger">
										{!! $mark !!}
									</span>
								</span>
								@endif
							@endif

							@if($mnu_child->url=='kotak-pengaduan')
								<?php 
								$mark = DB::table('pengaduan')->where('dibaca','0')->count();
								?>
								@if($mark>0)
								<span class="m-menu__link-badge">
									<span class="m-badge m-badge--danger">
										{!! $mark !!}
									</span>
								</span>
								@endif
							@endif

							</span>
						</a>
					</li>	
					@endforeach				
				</ul>
			</div>
		</li>
		@endforeach
		 
	</ul>
</div>