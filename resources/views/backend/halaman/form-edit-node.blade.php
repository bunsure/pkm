{{ Form::bsHidden('id_node',$record->id_node) }}
{{ Form::bsText('judul','Judul',$record->judul,true,'') }}
{{ Form::bsReadonly('tipe','Tipe',$record->tipe,true,'') }}
@if($record->tipe=='page')
<?php 
$list_halaman = DB::table('halaman')->select( 'id_halaman as value', 'judul as text')->orderby('created_at','desc')->get();
?>
{{ Form::bsSelect('id_halaman','Halaman',$list_halaman,true,'select2') }}
<script type="text/javascript">
	$(function(){
		$("#form-edit-node select[name=id_halaman]").select2();
		$("#form-edit-node select[name=id_halaman]").val('{{$record->id_halaman}}');
		$("#form-edit-node select[name=id_halaman]").trigger('change');
	})
</script>
@endif
@if($record->tipe=='url')
{{ Form::bsText('url','Tautan/Link',$record->url,true,'') }}
@endif