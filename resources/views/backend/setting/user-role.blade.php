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
					<h3 class="m-portlet__head-text">Setting Role User : {{$user->username}}</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<a href="#" data-toggle="modal" data-target="#modal-form-tambah-user-role" class="btn btn-success btn-sm m-btn m-btn--icon m-btn--pill"">
			<i class="la la-plus"></i> Tambah Role User
			</a>
			<hr>
			<div class="row">
				<div class="col-md-12">
		         	<?php 
		         	$kolom = array(
			         				['name'=>'No.','width'=>'2%'],
			         				['name'=>'Role Name','width'=>'93%'],
			         				['name'=>'Action','width'=>'5%'],
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
	{{Html::bsFormModalOpen('form-tambah-user-role','Tambah Role User','backend/setting-user/role/insert')}}
		{{ Form::bsHidden('id_user') }}
		{{ Form::bsSelect('id_role','Role',$list_role,true,'select2') }}
	{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}
	@endif

	@if(ucd())
	{{Html::bsFormModalOpen('form-hapus-user-role','Hapus Role User?','backend/setting-user/role/delete')}}
		{{ Form::bsHidden('uuid') }}
		{{ Form::bsReadonly('nama_role','Role','') }}
	{{Html::bsFormModalClose('<i class="la la-trash"></i> Hapus','warning')}}
	@endif

@endsection



@section("js")
<script type="text/javascript">
	$(function(){
		
		
		<?php 
		$field = array(
				['name'=>'','data'=>'DT_Row_Index','order'=>'false', 'search'=>'false','class'=>'text-center'],
				['name'=>'b.nama_role','data'=>'nama_role','order'=>'true', 'search'=>'true','class'=>''],
				['name'=>'','data'=>'action','order'=>'false', 'search'=>'false','class'=>'text-center'],
			);
		?>
		{{Html::jsDatatable('tabel1',$field,url('backend/setting-user/role/data/'.$user->uuid),25)}}


		$validator_tambah = $("#form-tambah-user-role").validate();

		{{Html::jsModalShow('modal-form-tambah-user-role')}}
			$validator_tambah.resetForm();
			$("#form-tambah-user-role").clearForm();
			$data= {'id_user':"{{Crypt::encrypt($user->id)}}"}
			{{Html::jsValueForm('form-tambah-user-role','hidden','id_user')}}
			{{Html::jsClearForm('form-tambah-user-role','select','id_role')}}
		{{Html::jsClose()}}

		var callback_submit_tambah = function(){$tabel1.ajax.reload(null, true);}
		{{Html::jsSubmitFormModal('form-tambah-user-role','callback_submit_tambah')}}

		{{Html::jsModalShow('modal-form-hapus-user-role')}}
			$("#form-hapus-role").clearForm();
			$uuid  = $(e.relatedTarget).data('uuid');
			$.get("{{url('backend/setting-user/role/get/')}}/"+$uuid, function($data){
				{{Html::jsValueForm('form-hapus-user-role','input','nama_role')}}
				{{Html::jsValueForm('form-hapus-user-role','input','uuid')}}
			});
		{{Html::jsClose()}}

		var callback_submit_hapus = function(){$tabel1.ajax.reload(null, true);}
		{{Html::jsSubmitFormModal('form-hapus-user-role','callback_submit_hapus')}}


		
	})
</script>
@endsection