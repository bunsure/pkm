@extends("backend.layout")
@section("sisip")
<link rel="stylesheet" href="{{asset('vendor/codemirror/lib/codemirror.css')}}">
<script src="{{asset('vendor/codemirror/lib/codemirror.js')}}"></script>
<script src="{{asset('vendor/codemirror/addon/mode/multiplex.js')}}"></script>
<script src="{{asset('vendor/codemirror/mode/xml/xml.js')}}"></script>
<style>
  .CodeMirror {border: 1px solid black;}
  .cm-delimit {color: #fa4;}
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
					<h3 class="m-portlet__head-text">Edit Widget</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<div class="row">
				<div class="col-md-12">
{{Html::bsForm('form-halaman','backend/widget/update')}}
<a href="{{url('backend/widget')}}" class="btn btn-sm btn-default">Kembali</a>
<hr>
{{ Form::bsHidden('id_widget', $widget->id_widget)}}
<div class="form-group m-form__group row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	  <input class="form-control col-md-12 col-xs-12" readonly="readonly" 
	  type="text" value="{{$widget->nama_widget}}">
	</div>
</div>					
<hr>
<textarea id="code" name="code">
{!! $widget->code !!}
</textarea>
<hr>
<div class="form-group m-form__group row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	  <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Sedang Proses" class="btn btn-primary btn-sm"><i class="la la-save"></i> Simpan</button>
	</div>
</div>
{{Html::bsFormClose()}}
		         </div>
			</div>
		</div>
	</div>
	<!--end::Portlet-->
</div>
@endsection

@section("modal")
	
@endsection

@section("js")
<script type="text/javascript">
	CodeMirror.defineMode("demo", function(config) {
	  return CodeMirror.multiplexingMode(
	    CodeMirror.getMode(config, "text/html"),
	    {open: "<<", close: ">>",
	     mode: CodeMirror.getMode(config, "text/plain"),
	     delimStyle: "delimit"}
	    // .. more multiplexed styles can follow here
	  );
	});
	var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
	  mode: "demo",
	  lineNumbers: true,
	  lineWrapping: true
	});

	$(function(){
		@if(Session::has('success'))
			showNotify('Berhasil',"{!! Session::get('success') !!}}");
		@endif
	})
</script>
@endsection