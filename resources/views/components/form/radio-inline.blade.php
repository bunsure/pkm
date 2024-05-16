<div class="form-group  m-form__group row">
	<label class="control-label col-md-3 col-sm-3 col-xs-12 col-form-label">{{$label}} @if($required==true)<span class="required">*</span>@endif
	</label>
	<div class="col-md-8 col-sm-8 col-xs-12">
	    <div class="m-radio-inline">
	    	@foreach($data as $d)
			  	<label class="m-radio"><input type="radio" value="{{$d->value}}" name="{{$fieldname}}" @if($required==true) required="required" @endif>{{$d->text}} <span></span></label>
			  @endforeach
	    </div>
	</div>
</div>