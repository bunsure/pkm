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
					<h3 class="m-portlet__head-text">Setting Menu Role : {{$role->nama_role}}</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<a href="#" data-toggle="modal" data-target="#modal-form-tambah-rolemenu" class="btn btn-success btn-sm m-btn m-btn--icon m-btn--pill"">
			<i class="la la-plus"></i> Tambah Menu
			</a>
			<hr>
			<div class="row">
				<div class="col-md-12">
		         	<?php 
		         	$kolom = array(
		         				['name'=>'No.','width'=>'30px'],
		         				['name'=>'Group Menu','width'=>''],
		         				['name'=>'Nama Menu','width'=>''],
		         				['name'=>'Create','width'=>''],
		         				['name'=>'Update','width'=>''],
		         				['name'=>'Delete','width'=>''],
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

<?php 
$option_yes_no = json_decode(json_encode(array(["value"=>0, "text"=>"No"] , ["value"=>1, "text"=>"Yes"])));
?>


@if(ucc())
{{Html::bsFormModalOpen('form-tambah-rolemenu','Tambah',"backend/setting-role/menu/".$role->uuid."/insert")}}
	{{ Form::bsHidden('id_role') }}
	{{ Form::bsReadonly('nama_role','Role', $role->nama_role ) }}
	{{ Form::bsSelect('id_menu','Menu',$list_menu,true,'select2') }}
	{{ Form::bsRadionInline('a_create','Allow Create',$option_yes_no,true) }}
	{{ Form::bsRadionInline('a_update','Allow Update',$option_yes_no,true) }}
	{{ Form::bsRadionInline('a_delete','Allow Delete',$option_yes_no,true) }}
{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}
@endif

@if(ucu())
{{Html::bsFormModalOpen('form-edit-rolemenu','Edit',"backend/setting-role/menu/".$role->uuid."/update")}}
	{{ Form::bsHidden('uuid') }}
	{{ Form::bsReadonly('nama_role','Role', $role->nama_role ) }}
	{{ Form::bsSelect('id_menu','Menu', $list_menu, true, 'select2') }}
	{{ Form::bsRadionInline('a_create','Allow Create',$option_yes_no,true) }}
	{{ Form::bsRadionInline('a_update','Allow Update',$option_yes_no,true) }}
	{{ Form::bsRadionInline('a_delete','Allow Delete',$option_yes_no,true) }}
{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}
@endif

@if(ucd())
{{Html::bsFormModalOpen('form-hapus-rolemenu','Anda Yakin Ingin Menghapus Data Berikut?',"backend/setting-role/menu/".$role->uuid."/delete")}}
	{{ Form::bsHidden('uuid') }}
	{{ Form::bsReadonly('nama_menu','Nama Menu') }}
{{Html::bsFormModalClose('<i class="la la-trash"></i> Hapus','warning')}}
@endif


@endsection



@section("js")
<script type="text/javascript">
	$(function(){
		
		$validator_tambah = $("#form-tambah-rolemenu").validate();
		$validator_edit = $("#form-edit-rolemenu").validate();


		<?php 
		$field = array(
				['name'=>'','data'=>'DT_Row_Index','order'=>'false', 'search'=>'false','class'=>'text-center'],
				['name'=>'c.nama_menu','data'=>'group_menu','order'=>'true', 'search'=>'true','class'=>''],
				['name'=>'b.nama_menu','data'=>'nama_menu','order'=>'true', 'search'=>'true','class'=>''],
				['name'=>'','data'=>'a_create','order'=>'false', 'search'=>'false','class'=>'text-center'],
				['name'=>'','data'=>'a_update','order'=>'false', 'search'=>'false','class'=>'text-center'],
				['name'=>'','data'=>'a_delete','order'=>'false', 'search'=>'false','class'=>'text-center'],
				['name'=>'','data'=>'action','order'=>'false', 'search'=>'false','class'=>'text-center'],
			);
		?>
		{{Html::jsDatatable('tabel1',$field,url('backend/setting-role/menu/'.$role->uuid.'/dt'),25)}}

		{{Html::jsModalShow('modal-form-tambah-rolemenu')}}
			$validator_tambah.resetForm();
			$("#form-tambah-rolemenu").clearForm();
			{{Html::jsClearForm('form-tambah-rolemenu','select','id_menu')}}
			$data= {'id_role':"{{Crypt::encrypt($role->id_role)}}", 'nama_role':"{{$role->nama_role}}"}
			{{Html::jsValueForm('form-tambah-rolemenu','input','nama_role')}}
			{{Html::jsValueForm('form-tambah-rolemenu','hidden','id_role')}}
		{{Html::jsClose()}}


		
		{{Html::jsModalShow('modal-form-edit-rolemenu')}}
			$validator_edit.resetForm();
			$("#form-edit-rolemenu").clearForm();
			$uuid  = $(e.relatedTarget).data('uuid');
			$data= {'nama_role':"{{$role->nama_role}}"}
			{{Html::jsValueForm('form-edit-rolemenu','input','nama_role')}}

			$.get("{{url('backend/setting-role/menu/'.$role->uuid.'/get')}}/"+$uuid, function($data){
				{{Html::jsValueForm('form-edit-rolemenu','select','id_menu')}}
				{{Html::jsValueForm('form-edit-rolemenu','radio','a_create')}}
				{{Html::jsValueForm('form-edit-rolemenu','radio','a_update')}}
				{{Html::jsValueForm('form-edit-rolemenu','radio','a_delete')}}
				{{Html::jsValueForm('form-edit-rolemenu','input','uuid')}}
			});
		{{Html::jsClose()}}


		{{Html::jsModalShow('modal-form-hapus-rolemenu')}}
			$("#form-hapus-role").clearForm();
			$uuid  = $(e.relatedTarget).data('uuid');
			$.get("{{url('backend/setting-role/menu/'.$role->uuid.'/get')}}/"+$uuid, function($data){
				{{Html::jsValueForm('form-hapus-rolemenu','input','nama_menu')}}
				{{Html::jsValueForm('form-hapus-rolemenu','input','uuid')}}
			});
		{{Html::jsClose()}}

		
		var callback_submit_tambah = function(){$tabel1.ajax.reload(null, true);}
		{{Html::jsSubmitFormModal('form-tambah-rolemenu','callback_submit_tambah')}}

		var callback_submit_update = function(){$tabel1.ajax.reload(null, false);}
		{{Html::jsSubmitFormModal('form-edit-rolemenu','callback_submit_update')}}

		var callback_submit_delete = function(){$tabel1.ajax.reload(null, false);}
		{{Html::jsSubmitFormModal('form-hapus-rolemenu','callback_submit_delete')}}

		
	})
</script>
@endsection