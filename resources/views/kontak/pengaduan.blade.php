@extends("layout-page")
@section("content")
<style type="text/css">
	#view-captcha{
		background: #fefefe;
		padding: 5px;
		border: 1px solid #eee;
	}
</style>
<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet"> 
<style type="text/css">
	.captcha{
		font-family: 'Indie Flower', cursive;
		font-weight: bold;
		font-size: 1.6em !important;
		color: #555;
	}
</style>
<div class="row">
	<div class="col-lg-8" style="padding: 20px !important;">
		<div class="heading heading-primary heading-border heading-bottom-border"> 
	        <h4 class=heading-default>
	        	Kotak  <strong>Pengaduan</strong>
	        </h4> 
	    </div> 
	    <form id="form-pesan" action="{{url('kirim-pengaduan')}}" method="post" enctype="multipart/form-data" >
	    	{{csrf_field()}}
			<div class="row mb-sm">
				<div class="form-group">
					<div class="col-md-12">
						<label>Nama Lengkap *</label>
						<input type="text" class="form-control" name="nama_lengkap" id="nama" required="required">
					</div>
				</div>
			</div>
			<div class="row mb-sm">
				<div class="form-group">
					<div class="col-md-12">
						<label>Nomor Identitas (KTP/SIM) *</label>
						<input type="text" class="form-control" name="nomor_id" id="nomor_id" required="required">
					</div>
				</div>
			</div>
			<div class="row mb-sm">
				<div class="form-group">
					<div class="col-md-12">
						<label>Organisasi/Perorangan *</label>
						<input type="text" class="form-control" name="organisasi" id="organisasi" placeholder="Umum, Masyarakat,  Lainnya" required="required">
					</div>
				</div>
			</div>
			<div class="row mb-sm">
				<div class="form-group">
					<div class="col-md-6">
						<label>Alamat Email *</label>
						<input type="email" class="form-control" name="email" id="email" required="required">
					</div>
					<div class="col-md-6">
						<label>Telp/Hp. *</label>
						<input type="text" class="form-control" name="phone" id="phone" required="required">
					</div>
				</div>
			</div>
			<div class="row mb-sm">
				<div class="form-group">
					<div class="col-md-12">
						<label>Subjek *</label>
						<input type="text" class="form-control" name="subjek" id="subjek" required="required">
					</div>
				</div>
			</div>
			<div class="row mb-sm">
				<div class="form-group">
					<div class="col-md-12">
						<label>Isi Pengaduan *</label>
						<textarea rows="10" class="form-control" name="isi_pengaduan" id="isi_pengaduan" required="required"></textarea>
					</div>
				</div>
			</div>
			<div class="row mb-sm">
				<div class="form-group">
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-12">
								<label>Tulis ulang captcha : <span id="view-captcha"></span></label>
							</div>
							<div class="col-md-4">
								<input id="captcha" name="captcha" type="text" class="form-control">
							</div>
						</div>
            		</div>
            	</div>
            </div>
            <hr class="invisible short">
            <div class="tampil"></div>
			<div class="row">
				<div class="col-md-12">
					<input type="submit" value="Lanjutkan" class="btn btn-primary">
				</div>
			</div>
		</form>
		<hr class=invisible> 
	</div>
	<div class="col-lg-4" style="padding: 20px !important;">
		<h4 class="mt-sm"> Dinas Tenaga Kerja dan Perindustrian <br>Kabupaten Batang Hari</h4>
		<i class="fa fa-map-marker"></i>&nbsp;&nbsp;{!! config('instansi.alamat')!!}								
		<br><i class="fa fa-phone"></i>&nbsp;&nbsp;{!! config('instansi.telepon')!!}								
		<br><i class="fa fa-fax"></i>&nbsp;&nbsp;{!! config('instansi.fax')!!}								
		<br><i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:{!! config('instansi.email')!!}">{!! config('instansi.email')!!}</a><br>
		<hr class="invisible short" />
	</div>
</div>
@endsection
@section("sisip_js")
<script src="{{asset('vendor/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{asset('js/jquery.form.min.js')}}"></script>
<script src="{{asset('js/jquery.mask.min.js')}}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery.blockUI.js')}}"></script>
@endsection

@section("js")
<script>
  var reload_captcha = function(){ $("#view-captcha").load('{{url('getcaptcha')}}');}
  reload_captcha();
  var blockUI = function(){
  		$.blockUI({ 
	                message: '<b style="font-size:1.2em !important">Sedang Proses...</b>', 
	                css: { border: '3px solid #555',padding: '15px', backgroundColor: '#000', 
	                '-webkit-border-radius': '10px', '-moz-border-radius': '10px', opacity: .5, color: '#fff'} 
	            }); 
  }
  $(function(){
  		$validator_pesan = $("#form-pesan").validate();

  		$('#form-pesan').ajaxForm({
			beforeSubmit:function(){ blockUI();},
			success:function($respon){
				$.unblockUI();
				
				if ($respon.status==true){
					window.location="{{url('kotak-pengaduan/submit/')}}/"+ $respon.id
				}else{
					swal("Gagal!", $respon.message, "error");
					reload_captcha();
				}
			},
			error:function(){
				swal('Gagal','Terjadi Kesalahan Sistem!',"error");
				$("#form-pesan button[type=submit]").button('reset');
				reload_captcha();
				$.unblockUI();
			}
		}); 

  });

</script>
@endsection