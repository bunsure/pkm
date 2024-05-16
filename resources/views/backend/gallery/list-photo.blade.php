@foreach($photo as $g)
	<div class="col-md-3">
		<center>
			<small>
				<a href="#" data-toggle="modal" data-image="{{url($g->filename)}}" data-toggle="modal" data-target="#modal-view-image" data-target="#modal-form-edit-caption"><i class="la la-eye"></i> Preview</a>  | 
				<a href="#" data-toggle="modal" data-target="#modal-form-edit-caption" data-id="{{$g->id_gallery}}"><i class="la la-edit"></i> Edit</a>   |  <a href="#"  data-toggle="modal" data-target="#modal-form-hapus-photo" data-id="{{$g->id_gallery}}">
			<i class="la la-trash"></i> Hapus</a></small>
		</center>
		<img src="{{url($g->thumbs)}}"  class="img img-thumbnail" width="100%">
		<small>
			<center>{{$g->caption}}</center><br>
		</small>
	</div>
@endforeach	

@if(count($photo)==0)
<center>Belum Ada Photo!</center>
@endif

<div class="col-md-12">
<hr>
{{$photo->links()}}
</div>