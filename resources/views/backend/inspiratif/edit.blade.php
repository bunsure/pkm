@extends("backend.layout")
@section("sisip")
<script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
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
					<h3 class="m-portlet__head-text">Edit Sosok Inspiratif</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<div class="col-md-12">
				{{Html::bsForm('form-inspiratif','backend/halaman-inspiratif/update')}}
					{{ Form::bsHidden('uuid', $inspiratif->uuid)}}
					{{ Form::bsText('judul','Judul Sosok Inspiratif',$inspiratif->judul,true,'') }}
					{{ Form::bsTextarea('isi','Isi Sosok Inspiratif',$inspiratif->isi,true,'') }}
					{{ Form::bsText('tgl_posting','Tanggal Posting',$inspiratif->tgl_posting,true,'') }}
					<hr>
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-9">
							<span>
							<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-form-upload-gambar">
								<i class="fa fa-upload"></i> Upload Gambar
							</button>
							</span>
							<hr>
							<div class="row" id="list-gambar">
								
							</div>
						</div>
					</div>
					
					<hr>
					{{ Form::bsSubmit()}}
				{{Html::bsFormClose()}}
			</div>
		</div>
	</div>
	<!--end::Portlet-->
</div>
@endsection

@section("modal")
	@if(ucc())
	{{Html::bsFormModalOpen('form-upload-gambar','Upload Gambar','backend/halaman-inspiratif/upload-gambar')}}
		<div class="form-group m-form__group row">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 col-form-label">Gambar<span class="required">*</span> 
			</label>
			<div class="col-md-8 col-sm-8 col-xs-12">
			   <input type="file"  id="gambar" 
              name="gambar" required accept=".jpg,.png">
			</div>
		</div>
		{{ Form::bsText('caption','Caption Gambar','',true,'') }}
	{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}
	@endif
@endsection

@section("js")
<script type="text/javascript">
	var reload_list_gambar = function(){
		$("#list-gambar").load("{{url('backend/list-gambar/session/'.$inspiratif->uuid)}}");
	}
	$(function(){
		reload_list_gambar();
		
		 @if(Session::has('error'))
            showAlert('<b>Terjadi Kesalahan</b>,  Periksa Inputan Form');
         @endif
         CKEDITOR.replace( 'isi', {
            extraPlugins: 'image2,justify,iframe',
            filebrowserImageUploadUrl: '{{URL::to('backend/upload-gambar-editor')}}',
         });

         $validator_gambar = $("#form-upload-gambar").validate();

         $("#tgl_posting").datepicker({format:'yyyy-mm-dd'});
         $("#tgl_posting").mask('0000-00-00');

        {{Html::jsModalShow('modal-form-upload-gambar')}}
			$validator_gambar.resetForm();
			$("#form-upload-gambar").clearForm();
		{{Html::jsClose()}}


		{{Html::jsSubmitFormModal('form-upload-gambar','reload_list_gambar')}}


	})
</script>
@endsection