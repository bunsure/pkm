@extends('layout-page')
@section("content")
<?php
loadHelper('format');
?>
<div class="row">
	<div class="col-md-9">
		<div class="heading heading-primary heading-border heading-bottom-border"> 
	        <h4 class=heading-default>
	        	<a href="{{url('list-literasi')}}" data-plugin-tooltip="" type="link" data-toggle="tooltip" data-placement="right" title="Lihat lainnya" data-original-title="Lihat lainnya">Literasi&nbsp;<i class="fa fa-caret-right"></i></a>
	        </h4> 
	    </div> 
		<div class="blog-posts">
			@foreach($literasi as $b)
				<?php
				$gambar =DB::table('gambar_literasi as a')
						->select('b.*')
						->join('gambar as b','b.id_gambar', '=','a.id_gambar')
						->where('id_literasi', $b->id_literasi)
						->orderby('id_gambar_literasi','asc')
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
									<a href="{{url('baca-literasi/'.$b->uuid)}}">
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
											<span><i class="fa fa-tag"></i><a href="{{url('list-literasi')}}">Literasi</a></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</article>
				<hr class="invisible short">
			@endforeach
			{!! $literasi->links() !!}
		</div>
	</div>
	<div class="col-md-3">
		<aside class="sidebar">
		 @include("sidewidget")
		</aside>
	</div>
</div>
@endsection