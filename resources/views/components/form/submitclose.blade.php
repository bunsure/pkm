<div class="form-group m-form__group row">
	<hr>
	<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
	<div class="col-md-6 col-sm-6 col-xs-12">
	  @if($submit_title!='')
      	<button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Sedang Proses" class="btn @if($submit_class=='') btn-success @else btn-{{$submit_class}} @endif btn-sm">{!!$submit_title!!}</button>
      @endif
	</div>
</div>
</form>