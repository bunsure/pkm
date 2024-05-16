<!--modal-->
<form  id="{{$id}}" method="post" enctype="multipart/form-data" action="{{url($action)}}" class="m-form m-form--label-align-right">
{{csrf_field()}}
<div class="modal fade" id="modal-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{!!$title!!}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="m-form__section m-form__section--first">
				  