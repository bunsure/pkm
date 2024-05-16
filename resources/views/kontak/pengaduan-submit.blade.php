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
	 <form id="form-pesan" action="{{url('kirim-pengaduan-akhir')}}" method="post" enctype="multipart/form-data" >
	<div class="col-lg-7" style="padding: 20px !important;">
		<div class="heading heading-primary heading-border heading-bottom-border"> 
	        <h4 class=heading-default>
	        	Kotak  <strong>Pengaduan</strong>
	        </h4> 
	    </div> 
	   
	    	{{csrf_field()}}
	    	<div class="hidden" id="listidupload">
	    		
	    	</div>
	    	<input type="hidden" name="id_pengaduan" value="{{$pengaduan->id_pengaduan}}">
			<div class="row mb-sm">
				<div class="form-group">
					<div class="col-md-12">
						<label>Nama Lengkap *</label>
						<input type="text" class="form-control" name="nama_lengkap" id="nama" 
						value="{{$pengaduan->nama_lengkap}}" required="required">
					</div>
				</div>
			</div>
			<div class="row mb-sm">
				<div class="form-group">
					<div class="col-md-12">
						<label>Nomor Identitas (KTP/SIM) *</label>
						<input type="text" class="form-control" name="nomor_id" id="nomor_id" 
						value="{{$pengaduan->nomor_id}}" required="required">
					</div>
				</div>
			</div>
			<div class="row mb-sm">
				<div class="form-group">
					<div class="col-md-12">
						<label>Organisasi/Perorangan *</label>
						<input type="text" class="form-control" name="organisasi" id="organisasi" 
						value="{{$pengaduan->organisasi}}"
						placeholder="Umum, Masyarakat,  Lainnya" required="required">
					</div>
				</div>
			</div>
			<div class="row mb-sm">
				<div class="form-group">
					<div class="col-md-6">
						<label>Alamat Email *</label>
						<input type="email" class="form-control" name="email" id="email" 
						value="{{$pengaduan->email}}"
						required="required">
					</div>
					<div class="col-md-6">
						<label>Telp/Hp. *</label>
						<input type="text" class="form-control" name="phone" id="phone" 
						value="{{$pengaduan->phone}}"
						required="required">
					</div>
				</div>
			</div>
			<div class="row mb-sm">
				<div class="form-group">
					<div class="col-md-12">
						<label>Subjek *</label>
						<input type="text" class="form-control" name="subjek" id="subjek" 
						value="{{$pengaduan->subjek}}"
						required="required">
					</div>
				</div>
			</div>
			<div class="row mb-sm">
				<div class="form-group">
					<div class="col-md-12">
						<label>Isi Pengaduan *</label>
						<textarea rows="10" class="form-control" name="isi_pengaduan" id="isi_pengaduan" 
						required="required">{{$pengaduan->isi_pengaduan}}</textarea>
					</div>
				</div>
			</div>
            <hr class="invisible short">
            <div class="tampil"></div>
			
		
		<hr class=invisible> 
	</div>

	<div class="col-lg-5" style="padding: 20px !important;">
		<h4 class="mt-sm">Upload <b>Dokumen Pendukung</b></h4>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info">
					<ul>
						<li>Silahkan Upload Kartu Identitas Pelapor dan Dokumen Pendukung Lainnya. File yang diupload dapat berupa Gambar atau Dokumen (pdf, doc, xls).</li> 
						<li>Perhatian! Format nama file yang diupload harap disesuaikan dengan isi file misalnya: ktp.jpg, photo-bukti.jpg. Ukuran File Maksimal 2MB</li>
					</ul>
				</div>
			</div>
			<div class="col-md-12" id="list-file">
				<div class="alert alert-default">
				<input type="file"  id="dokumen1" name="dokumen1"  accept=".jpg,.png,.pdf,.xls,.xlsx,.doc,.docx"><br>
				<input type="file"  id="dokumen2" name="dokumen2"  accept=".jpg,.png,.pdf,.xls,.xlsx,.doc,.docx"><br>
				<input type="file"  id="dokumen3" name="dokumen3"  accept=".jpg,.png,.pdf,.xls,.xlsx,.doc,.docx"><br>
				<input type="file"  id="dokumen4" name="dokumen4"  accept=".jpg,.png,.pdf,.xls,.xlsx,.doc,.docx"><br>
				<input type="file"  id="dokumen5" name="dokumen4"  accept=".jpg,.png,.pdf,.xls,.xlsx,.doc,.docx"><br>
			</div>
			</div>
		</div>
		<hr>
		<div class="row">
				<div class="col-md-12">
					<button type="submit" class="btn btn-primary" id="submit-pengaduan">
						<i class="fa fa-send"></i> Kirim Pengaduan
					</button>
				</div>
		</div>
	</div>
	</form>
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
  		swal('1 Langkah Lagi','Silahkan Lampirkan/Upload Dokumen Pendukung Untuk Melengkapi Pengaduan Anda',"success");
  		$('#form-pesan').ajaxForm({
			beforeSubmit:function(){ blockUI();},
			success:function($respon){
				$.unblockUI();
				
				if ($respon.status==true){
					window.location="{{url('kotak-pengaduan/info-pengaduan/')}}/"+ $respon.id
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