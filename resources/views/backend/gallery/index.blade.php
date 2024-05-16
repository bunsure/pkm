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
					<h3 class="m-portlet__head-text">Gallery Photo</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			@if(ucc())
				<a href="#" data-toggle="modal" data-target="#modal-form-tambah-photo" class="btn btn-success btn-sm m-btn m-btn--icon m-btn--pill"">
				<i class="la la-plus"></i> Upload Photo
				</a>
			@endif
			<hr>
			<div class="row">
				<div class="col-md-12">
		         	 <div id="list-photo" class="row">

                      </div>
		         </div>
			</div>
		</div>
	</div>
	<!--end::Portlet-->
</div>
@endsection

@section("modal")
	@if(ucc())
	{{Html::bsFormModalOpen('form-tambah-photo','Upload Photo','backend/gallery-photo/insert')}}
		<div class="form-group m-form__group row">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 col-form-label">Gambar<span class="required">*</span> 
			</label>
			<div class="col-md-8 col-sm-8 col-xs-12">
			   <input type="file"  id="gambar" 
              name="gambar" required accept=".jpg,.png">
			</div>
		</div>
		{{ Form::bsText('caption','Caption Photo','',true,'') }}
	{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}
	@endif

	{{Html::bsFormModalOpen('form-edit-caption','Edit Caption','backend/gallery-photo/update')}}
		{{ Form::bsHidden('id_gallery') }}
		<div class="form-group m-form__group row">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 col-form-label">Photo
			</label>
			<div class="col-md-5">
			   <img src="" id="photo-edit" class="img img-thumbnail">
			</div>
		</div>
		{{ Form::bsText('caption','Caption','',true,'') }}
	{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}


	{{Html::bsFormModalOpen('form-hapus-photo','Hapus Photo','backend/gallery-photo/delete')}}
		{{ Form::bsHidden('id_gallery') }}
		<div class="form-group m-form__group row">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 col-form-label">Photo
			</label>
			<div class="col-md-5">
			   <img src="" id="photo-hapus" class="img img-thumbnail">
			</div>
		</div>
		{{ Form::bsReadonly('caption','Caption','',true,'') }}
	{{Html::bsFormModalClose('<i class="la la-trash"></i> Hapus','danger')}}

	{{Html::bsModalOpenLg('view-image','Preview Photo')}}
	<center>
		<img src="" id="image-priview" class="img img-responsive img-thumbnail" style="width: 100%;">
	</center>
	{{Html::bsModalClose()}}
@endsection

@section("js")
<script type="text/javascript">
	$(function(){
		$validator_tambah = $("#form-tambah-photo").validate();
		$validator_edit = $("#form-edit-caption").validate();

		var base_gallery = "{{url('backend/gallery-photo/list')}}";
		var page = 0;
		var getlistphoto = function(url) {
			mApp.block("#list-photo", {
                overlayColor: "#000000",
                type: "loader",
                state: "primary",
                message: "Processing..."
            }), setTimeout(function() {
            }, 2e3);
            $("#list-photo").load(url, function(){
            	mApp.unblock("#list-photo");
				reloadPaging();
            })
        }
        var reloadPaging = function(){
        	$(".btn-page").on('click', function(e){
        		e.preventDefault();
        		$page = $(this).attr('href');
        		getlistphoto($page);
        	})
        }

        var reload_list_photo = function(){
        	currPage = $("#current_page").val();
        	getlistphoto(base_gallery + '?page='+ currPage);
        }

        getlistphoto(base_gallery + '?page=0');

        {{Html::jsModalShow('modal-form-tambah-photo')}}
			$validator_tambah.resetForm();
			$("#form-tambah-photo").clearForm();
		{{Html::jsClose()}}

        var callback_submit_tambah = function(){getlistphoto(base_gallery + '?page=0')}
		{{Html::jsSubmitFormModal('form-tambah-photo','callback_submit_tambah')}}


		{{Html::jsModalShow('modal-form-edit-caption')}}
			$validator_edit.resetForm();
			$("#form-edit-caption").clearForm();
			$id_gallery  = $(e.relatedTarget).data('id');
			$("#photo-edit").attr('src', '');
			$.get("{{url('backend/gallery-photo/get')}}/"+$id_gallery, function($data){
				{{Html::jsValueForm('form-edit-caption','input','id_gallery')}}
				$("#photo-edit").attr('src', $data.thumbs_url);
				{{Html::jsValueForm('form-edit-caption','input','caption')}}
			});
		{{Html::jsClose()}}

		{{Html::jsSubmitFormModal('form-edit-caption','reload_list_photo')}}

		{{Html::jsModalShow('modal-form-hapus-photo')}}
			$validator_edit.resetForm();
			$("#form-hapus-gambar").clearForm();
			$id_gallery  = $(e.relatedTarget).data('id');
			$("#photo-hapus").attr('src', '');
			$.get("{{url('backend/gallery-photo/get')}}/"+$id_gallery, function($data){
				{{Html::jsValueForm('form-hapus-photo','input','id_gallery')}}
				$("#photo-hapus").attr('src', $data.thumbs_url);
				{{Html::jsValueForm('form-hapus-photo','input','caption')}}
			});
		{{Html::jsClose()}}

		{{Html::jsSubmitFormModal('form-hapus-photo','reload_list_photo')}}


		{{Html::jsModalShow('modal-view-image')}}
			$image  = $(e.relatedTarget).data('image');
			$("#image-priview").attr('src','');
			$("#image-priview").attr('src',$image);
		{{Html::jsClose()}}
	})
</script>
@endsection