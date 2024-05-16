@extends("backend.layout")
@section("sisip")
<script src="{{asset('vendor/sweetalert/dist/sweetalert.min.js')}}"></script>
@endsection
@section("content")
 <div class="m-content">
	<!--begin::Portlet-->
	<div class="m-portlet">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<span class="m-portlet__head-icon m--hide">
					<i class="la la-gear"></i>
					</span>
					<h3 class="m-portlet__head-text">Ganti Password</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
				{{Html::bsForm('form-halaman','backend/ganti-password/submit')}}
					{{ Form::bsReadonly('username','Username',Auth::user()->username,true,'') }}
					{{ Form::bsPassword('password1','Password Baru','',true,'') }}
					{{ Form::bsPassword('password2','Ketik Ulang Password','',true,'') }}
					 <hr>
					{{ Form::bsSubmit()}}
				{{Html::bsFormClose()}}
		</div>
	</div>
 </div>
@endsection

@section("js")
<script type="text/javascript">
	$(function(){
		@if(Session::has('error'))
			swal('Gagal',"{{Session::get('error')}}","error");
		@endif

		@if(Session::has('success'))
			swal('Berhasil',"{{Session::get('success')}}","success");
		@endif
	})
</script>
@endsection