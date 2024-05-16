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
					<h3 class="m-portlet__head-text">Media</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			@if(ucc())
				<a href="#" data-toggle="modal" data-target="#modal-form-tambah-media" class="btn btn-success btn-sm m-btn m-btn--icon m-btn--pill"">
				<i class="la la-plus"></i> Upload Gambar
				</a>
			@endif
			<hr>
			<div class="row">
				<div class="col-md-12">
		         	 <div id="list-media" class="row">

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
	{{Html::bsFormModalOpen('form-tambah-media','Upload Photo/Gambar','backend/media/insert')}}
		<div class="form-group m-form__group row">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 col-form-label">Gambar<span class="required">*</span> 
			</label>
			<div class="col-md-8 col-sm-8 col-xs-12">
			   <input type="file"  id="gambar" 
              name="gambar" required accept=".jpg,.png">
			</div>
		</div>
	{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}
	@endif


	{{Html::bsFormModalOpen('form-hapus-media','Hapus Photo dan Gambar','backend/media/delete')}}
		{{ Form::bsHidden('id_media') }}
		<div class="form-group m-form__group row">
			<label class="control-label col-md-3 col-sm-3 col-xs-12 col-form-label">Photo/Gambar
			</label>
			<div class="col-md-5">
			   <img src="" id="photo-hapus" class="img img-thumbnail">
			</div>
		</div>
	{{Html::bsFormModalClose('<i class="la la-trash"></i> Hapus','danger')}}

@endsection

@section("js")
<script type="text/javascript">
	$(function(){
		$validator_tambah = $("#form-tambah-media").validate();
		 
		var base_gallery = "{{url('backend/media/list')}}";
		var page = 0;
		var getlistmedia = function(url) {
			mApp.block("#list-media", {
                overlayColor: "#000000",
                type: "loader",
                state: "primary",
                message: "Processing..."
            }), setTimeout(function() {
            }, 2e3);
            $("#list-media").load(url, function(){
            	mApp.unblock("#list-media");
				reloadPaging();
            })
        }
        var reloadPaging = function(){
        	$(".btn-page").on('click', function(e){
        		e.preventDefault();
        		$page = $(this).attr('href');
        		getlistmedia($page);
        	})
        }

        var reload_list_photo = function(){
        	currPage = $("#current_page").val();
        	getlistmedia(base_gallery + '?page='+ currPage);
        }

        getlistmedia(base_gallery + '?page=0');

        {{Html::jsModalShow('modal-form-tambah-media')}}
			$validator_tambah.resetForm();
			$("#form-tambah-media").clearForm();
		{{Html::jsClose()}}

        var callback_submit_tambah = function(){getlistmedia(base_gallery + '?page=0')}
		{{Html::jsSubmitFormModal('form-tambah-media','callback_submit_tambah')}}



		{{Html::jsModalShow('modal-form-hapus-media')}}
			 
			$("#form-hapus-gambar").clearForm();
			$id_media  = $(e.relatedTarget).data('id');
			$("#photo-hapus").attr('src', '');
			$.get("{{url('backend/media/get')}}/"+$id_media, function($data){
				{{Html::jsValueForm('form-hapus-media','input','id_media')}}
				$("#photo-hapus").attr('src', $data.thumbs_url);
			});
		{{Html::jsClose()}}

		{{Html::jsSubmitFormModal('form-hapus-media','reload_list_photo')}}


	})
</script>
@endsection