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
					<h3 class="m-portlet__head-text">Halaman Lowongan Kerja</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			@if(ucc())
				<a href="{{url('/backend/loker/new')}}" class="btn btn-success btn-sm m-btn m-btn--icon m-btn--pill"">
				<i class="la la-plus"></i> Tambah Lowongan
				</a>
			@endif
			<hr>
			<div class="row">
				<div class="col-md-12">
		         	<?php 
		         	$kolom = array(
		         				['name'=>'No.','width'=>'5%'],
		         				['name'=>'Lowongan Kerja','width'=>'52%'],
		         				['name'=>'Tgl Posting','width'=>'15%'],
		         				['name'=>'Create By','width'=>'10%'],
		         				['name'=>'Action','width'=>'18%'],
		         			);
		         	?>
	         		{{Html::bsDatatable('tabel1',$kolom)}}
		         </div>
			</div>
		</div>
	</div>
	<!--end::Portlet-->
</div>
@endsection

@section("modal")
	@if(ucd())
	{{Html::bsFormModalOpen('form-hapus-loker','Anda Yakin Ingin Menghapus Lowongan Berikut?','backend/loker/delete')}}
		{{ Form::bsHidden('uuid') }}
		{{ Form::bsReadonly('judul','Judul') }}
	{{Html::bsFormModalClose('<i class="la la-trash"></i> Hapus Lowongan','warning')}}
	@endif
@endsection

@section("js")
<script type="text/javascript">
	$(function(){
		
		<?php 
		$field = array(
				['name'=>'','data'=>'DT_Row_Index','order'=>'false', 'search'=>'false','class'=>'text-center'],
				['name'=>'a.judul','data'=>'judul','order'=>'false', 'search'=>'true','class'=>''],
				['name'=>'a.tgl_posting','data'=>'tgl_posting','order'=>'true', 'search'=>'true','class'=>'text-center'],
				['name'=>'a.create_by','data'=>'create_by','order'=>'false', 'search'=>'false','class'=>'text-center'],
				['name'=>'','data'=>'action','order'=>'false', 'search'=>'false','class'=>'text-center'],
			);
		?>
		{{Html::jsDatatable('tabel1',$field,url('backend/loker/dt'),10)}}

		{{Html::jsModalShow('modal-form-hapus-loker')}}
			$("#form-hapus-loker").clearForm();
			$uuid  = $(e.relatedTarget).data('uuid');
			$.get("{{url('backend/loker/get')}}/"+$uuid, function($data){
				{{Html::jsValueForm('form-hapus-loker','input','judul')}}
				{{Html::jsValueForm('form-hapus-loker','input','uuid')}}
			});
		{{Html::jsClose()}}

		var callback_submit_delete = function(){$tabel1.ajax.reload(null, false);}
		{{Html::jsSubmitFormModal('form-hapus-loker','callback_submit_delete')}}
	})
</script>
@endsection