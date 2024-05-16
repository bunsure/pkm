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
					<h3 class="m-portlet__head-text">Halaman Dokumen Pembelajaran</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			@if(ucc())
				<a href="#"  data-toggle="modal" data-target="#modal-form-tambah-dokumen" class="btn btn-success btn-sm m-btn m-btn--icon m-btn--pill"">
				<i class="la la-plus"></i> Upload File Baru
				</a>
			@endif
			<hr>
			<div class="row">
				<div class="col-md-12">
		         	<?php 
		         	$kolom = array(
		         				['name'=>'No.','width'=>'5%'],
		         				['name'=>'Nama Dokumen','width'=>'60%'],
		         				['name'=>'Uploaded At','width'=>'17%'],
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
	 @if(ucc())
	{{Html::bsFormModalOpen('form-tambah-dokumen','Upload Dokumen','backend/dokumen/insert')}}
		{{ Form::bsText('nama','Nama Dokumen','',true,'') }}
		<div class="form-group m-form__group row">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 col-form-label">Dokumen (pdf, word, excel, jpg, png)<span class="required">*</span> 
			</label>
			<div class="col-md-8 col-sm-8 col-xs-12">
			   <input type="file"  id="dokumen" 
              name="dokumen" required accept=".jpg,.png,.pdf,.xls,.xlsx,.doc,.docx">
			</div>
		</div>
	{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}
	@endif

	@if(ucu())
	{{Html::bsFormModalOpen('form-edit-dokumen','Ubah Nama Dokumen','backend/dokumen/update')}}
		{{ Form::bsText('nama','Nama Dokumen','',true,'') }}
		{{ Form::bsHidden('id_dokumen','') }}
	{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}
	@endif

	@if(ucd())
	{{Html::bsFormModalOpen('form-hapus-dokumen','Hapus Dokumen','backend/dokumen/delete')}}
		{{ Form::bsReadonly('nama','Nama Dokumen','',true,'') }}
		{{ Form::bsHidden('id_dokumen','') }}
	{{Html::bsFormModalClose('<i class="la la-trash"></i> Hapus','warning')}}
	@endif

@endsection

@section("js")
<script type="text/javascript">
	$(function(){
		
		<?php 
		$field = array(
				['name'=>'','data'=>'DT_Row_Index','order'=>'false', 'search'=>'false','class'=>'text-center'],
				['name'=>'a.nama','data'=>'nama','order'=>'false', 'search'=>'true','class'=>''],
				['name'=>'a.created_at','data'=>'created_at','order'=>'true', 'search'=>'true','class'=>'text-center'],
				['name'=>'','data'=>'action','order'=>'false', 'search'=>'false','class'=>'text-center'],
			);
		?>
		{{Html::jsDatatable('tabel1',$field,url('backend/dokumen/dt'),10)}}

		$validator_tambah = $("#form-tambah-dokumen").validate();
		{{Html::jsModalShow('modal-form-tambah-dokumen')}}
			$validator_tambah.resetForm();
			$("#form-tambah-dokumen").clearForm();
		{{Html::jsClose()}}
		$(function(){

		})
        var callback_submit_tambah = function(){ $tabel1.ajax.reload(null, false);}
		{{Html::jsSubmitFormModal('form-tambah-dokumen','callback_submit_tambah')}}

		$validator_edit = $("#form-edit-dokumen").validate();
		{{Html::jsModalShow('modal-form-edit-dokumen')}}
			$validator_edit.resetForm();
			$id_dokumen  = $(e.relatedTarget).data('id');
			$("#form-edit-dokumen").clearForm();
			$.get("{{url('backend/dokumen/get')}}/"+$id_dokumen, function($data){
				{{Html::jsValueForm('form-edit-dokumen','input','id_dokumen')}}
				{{Html::jsValueForm('form-edit-dokumen','input','nama')}}
			});
		{{Html::jsClose()}}
		{{Html::jsSubmitFormModal('form-edit-dokumen','callback_submit_tambah')}}

		{{Html::jsModalShow('modal-form-hapus-dokumen')}}
			$validator_edit.resetForm();
			$id_dokumen  = $(e.relatedTarget).data('id');
			$("#form-hapus-dokumen").clearForm();
			$.get("{{url('backend/dokumen/get')}}/"+$id_dokumen, function($data){
				{{Html::jsValueForm('form-hapus-dokumen','input','id_dokumen')}}
				{{Html::jsValueForm('form-hapus-dokumen','input','nama')}}
			});
		{{Html::jsClose()}}
		{{Html::jsSubmitFormModal('form-hapus-dokumen','callback_submit_tambah')}}

	})

</script>
@endsection