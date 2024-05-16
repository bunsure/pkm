<div class="form-group m-form__group row">
	<label class="control-label col-md-3 col-sm-3 col-xs-12 col-form-label">{{$label}} @if($required==true)<span class="required">*</span>@endif
	</label>
	<div class="col-md-8 col-sm-8 col-xs-12">
	  <select class="form-control m-select2  col-md-12 col-xs-12 {{$class}}" name="{{$fieldname}}" id="{{$fieldname}}" @if($required==true) required="required" @endif>
	  		<option value="">[Pilihan]</option>
	  	@if($data)
	  	@foreach($data as $d)
	  		<option value="{{Crypt::encrypt($d->value)}}" @if($value==$d->value) selected="selected" @endif>{{$d->text}}</option>
	  	@endforeach
	  	@endif
	  </select>
	</div>
</div>