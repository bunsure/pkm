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
					<h3 class="m-portlet__head-text">Widget</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<div class="row">
				<div class="col-md-12">
						<table class="table table-bordered table-condensed table-striped">
							<thead>
								<tr>
									<th width="5%">No.</th>
									<th width="80%">Nama Widget</th>
									<th width="15%">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1;?>
								@foreach($widget as $w)
								<tr>
									<td>{{$no++}}</td>
									<td>{{$w->nama_widget}}</td>
									<td align="center">
										<a href="{{url('backend/widget/edit/'.$w->id_widget)}}">Edit Widget</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
		         </div>
			</div>
		</div>
	</div>
	<!--end::Portlet-->
</div>
@endsection

@section("modal")
	
@endsection

@section("js")
<script type="text/javascript">
	$(function(){
		 

	})

</script>
@endsection