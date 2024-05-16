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
	        	Informasi  <strong>Pengaduan</strong>
	        </h4> 
	    </div> 
	    <div class="col-md-12">
	    	<table class="table table-striped">
	    		 <tr>
	    			<td width="20%">Nomor Pengaduan</td>
	    			<td>:</td>
	    			<td width="78%">
	    				{{$pengaduan->nomor_pengaduan}}
	    			</td>
	    		</tr>
	    		<tr>
	    			<td width="20%">Nama Lengkap</td>
	    			<td>:</td>
	    			<td width="78%">
	    				{{$pengaduan->nama_lengkap}}
	    			</td>
	    		</tr>
	    		<tr>
	    			<td>Nomor Identitas</td>
	    			<td>:</td>
	    			<td>
	    				{{$pengaduan->nomor_id}}
	    			</td>
	    		</tr>
	    		<tr>
	    			<td>Organisasi</td>
	    			<td>:</td>
	    			<td>
	    				{{$pengaduan->organisasi}}
	    			</td>
	    		</tr>
	    		<tr>
	    			<td>Email</td>
	    			<td>:</td>
	    			<td>
	    				{{$pengaduan->email}}
	    			</td>
	    		</tr>
	    		<tr>
	    			<td>Telepon</td>
	    			<td>:</td>
	    			<td>
	    				{{$pengaduan->phone}}
	    			</td>
	    		</tr>
	    		<tr>
	    			<td>Subjek</td>
	    			<td>:</td>
	    			<td>
	    				{{$pengaduan->subjek}}
	    			</td>
	    		</tr>
	    		<tr>
	    			<td>Isi Pengaduan</td>
	    			<td>:</td>
	    			<td>
	    				{{$pengaduan->isi_pengaduan}}
	    			</td>
	    		</tr>
	    		<tr>
	    			<td>Dokumen</td>
	    			<td>:</td>
	    			<td>
	    				<ul>
	    				@foreach($dokumen as $d)
	    					<li>
	    						<a href="{{url($d->filename)}}" target="_blank">{{$d->nama_dokumen}}</a>
	    					</li>
	    				@endforeach
	    				</ul>
	    			</td>
	    		</tr>
	    	</table>
	    </div>		 
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
 
@endsection

@section("js")
<script>
   

</script>
@endsection