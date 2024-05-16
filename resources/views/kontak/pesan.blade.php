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
	<div class="col-lg-6" style="padding: 20px !important;">
		<div class="heading heading-primary heading-border heading-bottom-border"> 
	        <h4 class=heading-default>
	        	Kontak  <strong>Kami</strong>
	        </h4> 
	    </div> 
	    <form id="form-pesan" action="{{url('kirim-pesan')}}" method="post" enctype="multipart/form-data" >
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
						<label>Pesan *</label>
						<textarea rows="10" class="form-control" name="pesan" id="pesan" required="required"></textarea>
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
					<input type="submit" value="Kirim Pesan" class="btn btn-primary">
				</div>
			</div>
		</form>
		<hr class=invisible> 
	</div>
	<div class="col-lg-6" style="padding: 20px !important;">
		<h4 class="mt-sm"> Dinas Tenaga Kerja dan Perindustrian <br>Kabupaten Batang Hari</h4>
		<i class="fa fa-map-marker"></i>&nbsp;&nbsp;{!! config('instansi.alamat')!!}								
		<br><i class="fa fa-phone"></i>&nbsp;&nbsp;{!! config('instansi.telepon')!!}								
		<br><i class="fa fa-fax"></i>&nbsp;&nbsp;{!! config('instansi.fax')!!}								
		<br><i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:{!! config('instansi.email')!!}">{!! config('instansi.email')!!}</a><br>
		<hr>

		<div id="petakontak" class="google-map small mt-none mb-none"></div>
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3sZDKFRZf47zKvJyk_4sLvdUFVhGleJA&callback=initMap"></script>

<script>
  function initMap() {
    var originalMapCenter = new google.maps.LatLng(-1.7132967, 103.2627910);
	var map = new google.maps.Map(document.getElementById('petakontak'), {
  	  zoom: 15,
  	  center: originalMapCenter,
  	  zoomControl: true,
  	  mapTypeControl: true,
  	  scaleControl: false, 
  	  streetViewControl: false,
  	  rotateControl: false,
  	  fullscreenControl: true
	});
	var infowindow = new google.maps.InfoWindow({
	  content:"<center><strong>Dinas Tenaga Kerja dan Perindustrian Kabupaten Batang Hari</strong><br/>{!! config('instansi.alamat') !!} <br/><a href='https://www.google.com/maps/search/?api=1&query=-1.7132967,103.2627910' target='_blank'><i class='fa fa-location-arrow'></i> Lihat Petunjuk</a></center>"
	});
	infowindow.setPosition(originalMapCenter);
	infowindow.open(map);
	
  }

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
					swal("Berhasil!", $respon.message, "success");
					$('#form-pesan').clearForm();
					reload_captcha();
					$validator_pesan.resetForm();
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