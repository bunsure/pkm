@extends("backend.layout")
@section("content")
<?php
loadHelper('akses');
$list_menu_induk = DB::table('menu')->select('id_menu as value','nama_menu as text')->where('id_menu_induk',0)->get();
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
					<h3 class="m-portlet__head-text">Setting Admin Role</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<a href="#" data-toggle="modal" data-target="#modal-form-tambah-role" class="btn btn-success btn-sm m-btn m-btn--icon m-btn--pill"">
			<i class="la la-plus"></i> Tambah Role
			</a>
			<hr>
			<div class="row">
				<div class="col-md-12">
		         	<?php 
		         	$kolom = array(
		         				['name'=>'No.','width'=>'30px'],
		         				['name'=>'Nama Role','width'=>''],
		         				['name'=>'Menu','width'=>''],
		         				['name'=>'Action','width'=>'50px'],
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
{{Html::bsFormModalOpen('form-tambah-role','Tambah Role','backend/setting-role/insert')}}
	{{ Form::bsText('nama_role','Nama Role','',true,'') }}
{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}
@endif

@if(ucu())
{{Html::bsFormModalOpen('form-edit-role','Edit Role','backend/setting-role/update')}}
	{{ Form::bsHidden('uuid') }}
	{{ Form::bsText('nama_role','Nama Role','',true,'') }}
{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}
@endif

@if(ucd())
{{Html::bsFormModalOpen('form-hapus-role','Anda Yakin Ingin Menghapus Data Berikut?','backend/setting-role/delete')}}
	{{ Form::bsHidden('uuid') }}
	{{ Form::bsReadonly('nama_role','Nama Role') }}
{{Html::bsFormModalClose('<i class="la la-trash"></i> Hapus','warning')}}
@endif
@endsection

@section("js")
<script type="text/javascript">
	$(function(){
		$validator_tambah = $("#form-tambah-role").validate();
		$validator_edit = $("#form-edit-role").validate();

		<?php 
			$field = array(
					['name'=>'a.id_role','data'=>'id_role','order'=>'true', 'search'=>'true','class'=>'text-center'],
					['name'=>'a.nama_role','data'=>'nama_role','order'=>'true', 'search'=>'true','class'=>''],
					['name'=>'','data'=>'menu','order'=>'false', 'search'=>'false','class'=>'text-center'],
					['name'=>'','data'=>'action','order'=>'false', 'search'=>'false','class'=>'text-center'],
				);
			?>
		{{Html::jsDatatable('tabel1',$field,url('backend/setting-role/dt'),25)}}

		{{Html::jsModalShow('modal-form-tambah-role')}}
			$validator_tambah.resetForm();
			$("#form-tambah-role").clearForm();
			{{Html::jsClearForm('form-tambah-role','select','id_menu_induk')}}
		{{Html::jsClose()}}

		{{Html::jsModalShow('modal-form-edit-role')}}
			$validator_edit.resetForm();
			$("#form-edit-role").clearForm();
			{{Html::jsClearForm('form-edit-role','select','id_menu_induk')}}
			$uuid  = $(e.relatedTarget).data('uuid');
			$.get("{{url('backend/setting-role/get')}}/"+$uuid, function($data){
				{{Html::jsValueForm('form-edit-role','input','nama_role')}}
				{{Html::jsValueForm('form-edit-role','input','uuid')}}
			});
		{{Html::jsClose()}}

		{{Html::jsModalShow('modal-form-hapus-role')}}
			$("#form-hapus-role").clearForm();
			$uuid  = $(e.relatedTarget).data('uuid');
			$.get("{{url('backend/setting-role/get')}}/"+$uuid, function($data){
				{{Html::jsValueForm('form-hapus-role','input','nama_role')}}
				{{Html::jsValueForm('form-hapus-role','input','uuid')}}
			});
		{{Html::jsClose()}}


		var callback_submit_tambah = function(){$tabel1.ajax.reload(null, true);}
		{{Html::jsSubmitFormModal('form-tambah-role','callback_submit_tambah')}}

		var callback_submit_update = function(){$tabel1.ajax.reload(null, false);}
		{{Html::jsSubmitFormModal('form-edit-role','callback_submit_update')}}

		var callback_submit_delete = function(){$tabel1.ajax.reload(null, false);}
		{{Html::jsSubmitFormModal('form-hapus-role','callback_submit_delete')}}

	})
</script>
@endsection