@extends("backend.layout")
@section("sisip")
<script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
@endsection
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
					<h3 class="m-portlet__head-text">View Lowongan Kerja</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<div class="col-md-12">
				 	<table class="table table-condensed">
				 		<tr>
				 			<td><small>Tgl Posting: {{$loker->tgl_posting}} | Author: {{$loker->create_by}}</small><br>
								<b>{{$loker->judul}}</b>
				 			</td>
				 		</tr>
				 		<tr>
				 			<td>
				 				<label>Isi Lowongan</label>
				 				{!! $loker->isi !!}
				 			</td>
				 		</tr>
				 		<tr>
				 			<td>
				 				<b>Gambar Berita</b>
				 				<hr>
				 				<div class="row">
				 					 
				 						@foreach($gambar as $g)
										<div class="col-md-3">
											<img src="{{url($g->thumbs)}}" class="img img-thumbnail" width="100%"><br>
											<small>
												<center>{{$g->caption}}</center><br>
											</small>
										</div>
										@endforeach
				 					 
				 				</div>
				 			</td>
				 		</tr>
				 	</table>
			</div>
		</div>
	</div>
	<!--end::Portlet-->
</div>
@endsection
 