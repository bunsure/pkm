@foreach($gambar as $g)
<div class="col-md-3">
	<center><small><a href="#" data-toggle="modal" data-target="#modal-form-edit-caption" data-id="{{$g->id_gambar}}">Edit</a> | <a href="#"  data-toggle="modal" data-target="#modal-form-hapus-gambar" data-id="{{$g->id_gambar}}">Hapus</a></small></center>
	<img src="{{url($g->thumbs)}}" class="img img-thumbnail" width="100%"><br>
	<small>
		<center>{{$g->caption}}</center><br>
	</small>
	<input type="hidden" name="id_gambar[]" value="{{$g->id_gambar}}">
</div>
@endforeach


{{Html::bsFormModalOpen('form-edit-caption','Edit Caption','backend/list-gambar/update-caption')}}
	{{ Form::bsHidden('id_gambar') }}
	<div class="form-group m-form__group row">
		<label class="control-label col-md-3 col-sm-3 col-xs-12 col-form-label">Gambar
		</label>
		<div class="col-md-5">
		   <img src="" id="gambar-edit" class="img img-thumbnail">
		</div>
	</div>
	{{ Form::bsText('caption','Caption','',true,'') }}
{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}


{{Html::bsFormModalOpen('form-hapus-gambar','Hapus Gambar','backend/list-gambar/delete')}}
	{{ Form::bsHidden('id_gambar') }}
	<div class="form-group m-form__group row">
		<label class="control-label col-md-3 col-sm-3 col-xs-12 col-form-label">Gambar
		</label>
		<div class="col-md-5">
		   <img src="" id="gambar-hapus" class="img img-thumbnail">
		</div>
	</div>
	{{ Form::bsReadonly('caption','Caption','',true,'') }}
{{Html::bsFormModalClose('<i class="la la-trash"></i> Hapus','danger')}}

<script type="text/javascript">
	$(function(){
		$validator_edit = $("#form-edit-caption").validate();

		{{Html::jsModalShow('modal-form-edit-caption')}}
			$validator_edit.resetForm();
			$("#form-edit-caption").clearForm();
			$id_gambar  = $(e.relatedTarget).data('id');
			$.get("{{url('backend/list-gambar/get')}}/"+$id_gambar, function($data){
				{{Html::jsValueForm('form-edit-caption','input','id_gambar')}}
				$("#gambar-edit").attr('src', $data.thumbs_url);
				{{Html::jsValueForm('form-edit-caption','input','caption')}}
			});
		{{Html::jsClose()}}

		{{Html::jsSubmitFormModal('form-edit-caption','reload_list_gambar')}}

		{{Html::jsModalShow('modal-form-hapus-gambar')}}
			$validator_edit.resetForm();
			$("#form-hapus-gambar").clearForm();
			$id_gambar  = $(e.relatedTarget).data('id');
			$.get("{{url('backend/list-gambar/get')}}/"+$id_gambar, function($data){
				{{Html::jsValueForm('form-hapus-gambar','input','id_gambar')}}
				$("#gambar-hapus").attr('src', $data.thumbs_url);
				{{Html::jsValueForm('form-hapus-gambar','input','caption')}}
			});
		{{Html::jsClose()}}

		{{Html::jsSubmitFormModal('form-hapus-gambar','reload_list_gambar')}}
		 

	})
</script>