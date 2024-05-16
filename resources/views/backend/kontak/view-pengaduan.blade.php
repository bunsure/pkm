@extends("backend.layout")
@section("content")
<?php
loadHelper('akses');
?>
<div class="m-content">
	<!--begin::Portlet-->
	<div class="m-portlet">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<span class="m-portlet__head-icon m--hide">
					<i class="la la-gear"></i>
					</span>
					<h3 class="m-portlet__head-text">Detail Pengaduan</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<div class="row">
				
				<div class="col-md-12">
		         	 <a href="{{url('backend/kotak-pesan')}}" class="btn btn-default btn-sm">Kembali</a>
					<hr>
					<table class="table table-condensed">
						<tr>
							<td width="25%">Nomor Pengaduan</td>
							<td>:</td>
							<td  width="74%">{{$pengaduan->nomor_pengaduan}}</td>
						</tr>
						<tr>
							<td width="25%">Nama Pengirim</td>
							<td>:</td>
							<td  width="74%">{{$pengaduan->nama_lengkap}}</td>
						</tr>
						<tr>
							<td>Organisasi/Instansi</td>
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
							<td>Phone</td>
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
							<td>Dikirim</td>
							<td>:</td>
							<td>
								{{$pengaduan->created_at}}
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
			</div>
			 
		</div>
	</div>
	<!--end::Portlet-->
</div>
<style type="text/css">
	tr.unread{
		background:  #eac675 !important;
	}
</style>
@endsection

@section("modal")
	  

@endsection

@section("js")
 
@endsection