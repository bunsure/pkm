@extends('layout-page')
@section("content")
<?php
loadHelper('format');
?>
<div class="row">
	<div class="col-md-9">
		<div class="heading heading-primary heading-border heading-bottom-border"> 
	        <h4 class=heading-default>
	        	<a href="{{url('list-parenting')}}" data-plugin-tooltip="" type="link" data-toggle="tooltip" data-placement="right" title="Lihat lainnya" data-original-title="Lihat lainnya">Parenting&nbsp;<i class="fa fa-caret-right"></i></a>
	        </h4> 
	    </div> 
		<div class="blog-posts">
			@foreach($parenting as $b)
				<?php
				$gambar =DB::table('gambar_parenting as a')
						->select('b.*')
						->join('gambar as b','b.id_gambar', '=','a.id_gambar')
						->where('id_parenting', $b->id_parenting)
						->orderby('id_gambar_parenting','asc')
						->first();
				$id_gambar_utama = "";
				if($gambar){
					$img = url($gambar->filename);
					$id_gambar_utama = $gambar->id_gambar;
				}else{
					$img = url("upload/gambar/default-thumbs.png");
				}
				?>
				<article class="post post-medium">
					<div class="row">
						<div class="col-md-5">
							<div class="post-image">
								<div class="img-thumbnail">
									<img class="img-responsive" src="{{$img}}" alt="">
								</div>
							</div>
						</div>
						<div class="col-md-7">
							<div class="post-content">
								<h4>
									<a href="{{url('baca-parenting/'.$b->uuid)}}">
										{!! $b->judul !!}
									</a>
								</h4>
								<?php 
								$deskripsi = substr($b->isi, 0, 200);
								$deskripsi = strip_tags($deskripsi);
								?>
								<p style="text-align:justify">
									{!! $deskripsi !!}
								</p>
								<div class="row">
									<div class="col-md-12">
										<div class="post-meta">
											<span><i class="fa fa-calendar"></i> {!! tgl_indo_singkat($b->tgl_posting) !!} </span>
											<span><i class="fa fa-user"></i> Dipublikasikan oleh {{$b->create_by}} </span>
											<span><i class="fa fa-tag"></i><a href="{{url('list-parenting')}}">Parenting</a></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</article>
				<hr class="invisible short">
			@endforeach
			{!! $parenting->links() !!}
		</div>
	</div>
	<div class="col-md-3">
		<aside class="sidebar">
		 @include("sidewidget")
		</aside>
	</div>
</div>
@endsection