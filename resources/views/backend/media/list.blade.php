@foreach($media as $g)
	<div class="col-md-3">
		<center>
			<small>
				<a href="#"  data-toggle="modal" data-target="#modal-form-hapus-media" data-id="{{$g->id_media}}">
				<i class="la la-trash"></i> Hapus</a></small>
		</center>
		<img src="{{url($g->thumbs)}}"  class="img img-thumbnail" width="100%">
		<small>
			<input type="readonly" name="" value="{{url($g->filename)}}" style="width: 100%;" class="form-control">
		</small>
	</div>
@endforeach	

@if(count($media)==0)
<div class="col-md-12">
<center>Belum Ada Photo/Gambar!</center>
</div>
@endif

<div class="col-md-12">
<hr>
{{$media->links()}}
</div>