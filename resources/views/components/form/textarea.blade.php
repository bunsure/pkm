<div class="form-group m-form__group row">
<label class="control-label col-md-3 col-sm-3 col-xs-12 col-form-label">{{$label}} @if($required==true)<span class="required">*</span>@endif
</label>
<div class="col-md-8 col-sm-8 col-xs-12">
  <textarea class="form-control {{$class}}" id="{{$fieldname}}" name="{{$fieldname}}" 
	  @if($required==true) required="required" @endif  rows="3">{{$value}}</textarea>
</div>
</div>