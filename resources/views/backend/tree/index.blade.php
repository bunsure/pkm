@extends("backend.layout")
@section("sisip")
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
	 <script src="{{asset('vendor/jstree/jstree.min.js')}}"></script>
	 <style type="text/css">
	 	.action-trees{
	 		padding-left: 20px;
	 	}
	 </style>
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
					<h3 class="m-portlet__head-text">Halaman Menu</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<div class="row">
				<div class="col-md-12">
					<button class="btn btn-sm btn-default" id="tambah-direktori">
						<i class="fa fa-folder"></i> Tambah Direktori
					</button>
					<button class="btn btn-sm btn-default"  id="tambah-halaman">
						<i class="fa fa-file"></i> Tambah Halaman
					</button>
					<button class="btn btn-sm btn-default" id="tambah-tautan">
						<i class="fa fa-link"></i> Tambah Link/Tautan
					</button>
					<hr>
		         	 <div id="jstree"  style="margin-top: 15px;" class="proton-demo">
		         	 	  <ul>
						    <li id="root" data-tipe="direktori" data-jstree='{"icon":"fa fa-folder"}'>
						    	Root Menu
						    </li>
						  </ul>
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
	{{Html::bsFormModalOpen('form-tambah-direktori','Tambah','backend/halaman-menu/insert')}}
		{{ Form::bsText('judul','Nama Direktori','',true,'') }}
		{{ Form::bsHidden('tipe', 'direktori')}}
		{{ Form::bsHidden('id_induk', 'root')}}
	{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}

	<?php 
	$list_halaman = DB::table('halaman')->select( 'id_halaman as value', 'judul as text')
	                 ->orderby('created_at','desc')->get();
	?>
	{{Html::bsFormModalOpen('form-tambah-halaman','Tambah Menu Halaman','backend/halaman-menu/insert')}}
		{{ Form::bsText('judul','Nama Halaman','',true,'') }}
		{{ Form::bsSelect('id_halaman','Halaman',$list_halaman,true,'select2') }}
		{{ Form::bsHidden('tipe', 'page')}}
		{{ Form::bsHidden('id_induk', 'root')}}
	{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}


	{{Html::bsFormModalOpen('form-tambah-link','Tambah Menu Tautan','backend/halaman-menu/insert')}}
		{{ Form::bsText('judul','Nama Link/Menu','',true,'') }}
		{{ Form::bsText('url','Tautan','',true,'') }}
		{{ Form::bsHidden('tipe', 'url')}}
		{{ Form::bsHidden('id_induk', 'root')}}
	{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}



	{{Html::bsFormModalOpen('form-edit-node','Edit Node','backend/halaman-menu/update')}}
		<div id="panel-edit">
			
		</div>
	{{Html::bsFormModalClose('<i class="la la-save"></i> Simpan','success')}}

	{{Html::bsFormModalOpen('form-hapus-node','Hapus Node/Menu','backend/halaman-menu/delete')}}
		{{ Form::bsReadonly('judul','Nama/Judul','',true,'') }}
		{{ Form::bsHidden('id_node','')}}
	{{Html::bsFormModalClose('<i class="la la-trash"></i> Hapus','danger')}}


@endif
@endsection

@section("js")
<script type="text/javascript">
	$(function(){
		
		 
		var $id_selected = null;
		var getSelected = function(){
			$selected = $('#jstree').jstree().get_selected();
			if($selected.length){
				return $selected[0];
			}else{
				return false
			}
		}

		$validator_tambah_direktori = $("#form-tambah-direktori").validate();

		{{Html::jsModalShow('modal-form-tambah-direktori')}}
			$validator_tambah_direktori.resetForm();
			$("#form-tambah-direktori").clearForm();
		{{Html::jsClose()}}


		{{Html::jsModalShow('modal-form-tambah-halaman')}}
			$validator_tambah_direktori.resetForm();
			$("#form-tambah-halaman").clearForm();
		{{Html::jsClose()}}

		{{Html::jsModalShow('modal-form-tambah-link')}}
			$validator_tambah_direktori.resetForm();
			$("#form-tambah-link").clearForm();
		{{Html::jsClose()}}

		$("#tambah-direktori").on("click", function(){
			if (getSelected()!=false){
				$id_selected = getSelected();
				$id_node_induk = $id_selected;
				$("#form-tambah-direktori input[name=id_induk]").val($id_selected);
				$("#modal-form-tambah-direktori").modal('show');
			}
		});

		$("#tambah-tautan").on("click", function(){
			if (getSelected()!=false){
				$id_selected = getSelected();
				$id_node_induk = $id_selected;
				$("#form-tambah-link input[name=id_induk]").val($id_selected);
				$("#modal-form-tambah-link").modal('show');
			}
		});

		$("#tambah-halaman").on("click", function(){
			if (getSelected()!=false){
				$id_selected = getSelected();
				$id_node_induk = $id_selected;
				{{Html::jsClearForm('form-tambah-halaman','select','id_halaman')}}
				$("#form-tambah-halaman input[name=id_induk]").val($id_selected);
				$("#modal-form-tambah-halaman").modal('show');
			}
		});

		{{Html::jsModalShow('modal-form-hapus-node')}}
			$("#form-hapus-node").clearForm();
			$id  = $(e.relatedTarget).data('id');
			$id_selected = getSelected();
			$.get("{{url('backend/halaman-menu/get')}}/"+$id, function($data){
				{{Html::jsValueForm('form-hapus-node','input','judul')}}
				{{Html::jsValueForm('form-hapus-node','input','id_node')}}
				$id_node_induk = get_parent_node($data.id_node);
			});
		{{Html::jsClose()}}


		{{Html::jsModalShow('modal-form-edit-node')}}
			$("#form-edit-node").clearForm();
			$id  = $(e.relatedTarget).data('id');
			$("#panel-edit").html('<center>Loading..</center>');
			$.get("{{url('backend/halaman-menu/form-edit')}}/"+$id, function($html){
				 $("#panel-edit").html($html);
				 $id_node_induk = get_parent_node($id);
			});
		{{Html::jsClose()}}

		var callback_submit_tambah_direktori = function(){
			current_open = ""
			reload_node($id_node_induk);
		}
		{{Html::jsSubmitFormModal('form-tambah-direktori','callback_submit_tambah_direktori')}}


		var callback_submit_tambah_halaman = function(){
			current_open = ""
			reload_node($id_node_induk);
		}
		{{Html::jsSubmitFormModal('form-tambah-halaman','callback_submit_tambah_halaman')}}



		var callback_submit_tambah_tautan = function(){
			current_open = ""
			reload_node($id_node_induk);
		}
		{{Html::jsSubmitFormModal('form-tambah-link','callback_submit_tambah_tautan')}}


		var callback_submit_edit_node = function(){
			current_open = ""
			reload_node($id_node_induk);
		}
		{{Html::jsSubmitFormModal('form-edit-node','callback_submit_edit_node')}}

		var callback_submit_hapus_node = function(){
			current_open = ""
			reload_node($id_node_induk);
		}
		{{Html::jsSubmitFormModal('form-hapus-node','callback_submit_hapus_node')}}

		var ajax_again="to-be-refreshed";
		var current_open = "";

		var reload_node = function (nodeID){
		    var children = $("#jstree").jstree(true).get_node(nodeID, true);
		    if (nodeID!=current_open){
		    	$("#jstree").jstree(true).refresh_node(children);
		    	current_open = nodeID;
		    }
		}

		var get_parent_node = function (nodeID){
			var node = $("#jstree").jstree(true).get_node(nodeID, true);
			var parent = $("#jstree").jstree(true).get_parent(node, true);
			return parent;
		}
		$("#jstree").jstree({
			  "core" : {
			    "animation" : 0,
			    "check_callback" : true,
			    "themes" : { "stripes" : true },
			    'data' : {
			      'url' : function (node) {
			        return '{{url("backend/halaman-menu/get-node")}}';
			      },
			      'data' : function (node) {
			        return { 'id' : node.id };
			      }
			    }
			  },
			  "plugins" : [
			    "state", "types"
			  ]
		}).on("before_open.jstree", function (e,data) {
		    reload_node(data.node.id)
		})
		.on("after_close.jstree", function (e,data) {
			current_open = ""
		})
	})
</script>
@endsection