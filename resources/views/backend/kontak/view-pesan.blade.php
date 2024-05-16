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
					<h3 class="m-portlet__head-text">Lihat Pesan</h3>
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
							<td width="25%">Nama Pengirim</td>
							<td>:</td>
							<td  width="72%">{{$pesan->nama_lengkap}}</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td>
								{{$pesan->email}}
							</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>:</td>
							<td>
								{{$pesan->phone}}
							</td>
						</tr>
						<tr>
							<td>Subjek</td>
							<td>:</td>
							<td>
								{{$pesan->subjek}}
							</td>
						</tr>
						<tr>
							<td>Isi Pesan</td>
							<td>:</td>
							<td>
								{{$pesan->pesan}}
							</td>
						</tr>
						<tr>
							<td>Dikirim</td>
							<td>:</td>
							<td>
								{{$pesan->created_at}}
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