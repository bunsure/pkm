<ul class="m-topbar__nav m-nav m-nav--inline">
	<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
		<a href="#" class="m-nav__link m-dropdown__toggle">
		<span class="m-topbar__userpic">
		<img src="{{asset('dashboard/assets/app/media/img/users/user4.jpg')}}" class="m--img-rounded m--marginless" alt=""/>
		</span>
		
		</a>
		<div class="m-dropdown__wrapper">
			<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
			<div class="m-dropdown__inner">
				<div class="m-dropdown__header m--align-center" style="background: url({!!url('dashboard/assets/app/media/img/misc/user_profile_bg.jpg')!!}); background-size: cover;">
					<div class="m-card-user m-card-user--skin-dark">
						<div class="m-card-user__details">
							<span class="m-card-user__name m--font-weight-500">{{Auth::user()->username}}</span>
						</div>
					</div>
				</div>
				<div class="m-dropdown__body">
					<div class="m-dropdown__content">
						<ul class="m-nav m-nav--skin-light">
							<li class="m-nav__item">
								<a href="{{url('backend/ganti-password')}}" class="m-nav__link">
								<i class="m-nav__link-icon la la-key"></i>
								<span class="m-nav__link-text">Ganti Password</span>
								</a>
							</li>
							<li class="m-nav__separator m-nav__separator--fit"></li>
							<li class="m-nav__item">
								<a href="{{url('logout')}}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</li>
</ul>