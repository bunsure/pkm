<!--modal-->
<form  id="{{$id}}" method="post" enctype="multipart/form-data" action="{{url($action)}}">
{{csrf_field()}}
<div id="modal-{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{!!$title!!}</h4>
      </div>
      <div class="modal-body">
      	 <div class="form-horizontal form-label-left">