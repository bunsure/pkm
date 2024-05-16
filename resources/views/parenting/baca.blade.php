@extends('layout-page')

<?php
loadHelper('format');
$gambar =DB::table('gambar_parenting as a')
		->select('b.*')
		->join('gambar as b','b.id_gambar', '=','a.id_gambar')
		->where('id_parenting', $parenting->id_parenting)
		->orderby('id_gambar_parenting','asc')
		->first();
$id_gambar_utama = "";
if($gambar){
	$img = url($gambar->filename);
	$id_gambar_utama = $gambar->id_gambar;
}else{
	$img = "";
}
?>

@section('meta-share')
<meta name="msapplication-TileImage" content="url_image">
<meta property="og:site_name" content="PDK Batang Hari">
<meta property="og:title" content="{{$parenting->judul}}">
<meta property="og:description" content="{{$parenting->judul}}">
<meta property="og:image" itemprop="image" content="{{$img}}">
<link itemprop="thumbnailUrl" href="{{url('baca-parenting/'.$parenting->uuid)}}">
<meta property="og:type" content="website" />
<meta property="og:image:type" content="{{$img}}">
<meta property="og:image:width" content="240">
<meta property="og:image:height" content="240">
<meta property="og:url" content="{{url('baca-parenting/'.$parenting->uuid)}}">
@endsection

@section("content")


<div class="row">
	<div class="col-md-9">
		<div class="blog-posts">
			<article class="post">
				<div class="post-content">
					<h2><a href="{{url('baca-parenting/'.$parenting->uuid)}}">
						{{$parenting->judul}}
					</a></h2>
					<div class="post-meta">
						<span><i class="fa fa-calendar"></i>
							{!! tgl_indo_singkat($parenting->tgl_posting) !!}
						</span>
						<span><i class="fa fa-user"></i> Dipublikasikan oleh {!! $parenting->create_by !!} </span>
						<span><i class="fa fa-tag"></i><a href="{{url('list-parenting')}}">Parenting</a></span>
					</div>
					<hr class="invisible short">
					@if($img!="")
					<div class="img-rounded">
						<img width="100%" src="{{$img}}" alt="{{$gambar->caption}}">
						<small>{{$gambar->caption}}</small>
					</div>
					<hr class="invisible short">
					@endif
					<div>
					 {!! $parenting->isi !!}
					</div>
					<hr class="invisible short">
					<?php
					$gambar_parenting =  DB::table('gambar_parenting as a')
									->select('b.*')
									->join('gambar as b','b.id_gambar', '=','a.id_gambar')
									->where('id_parenting', $parenting->id_parenting)
									->orderby('id_gambar_parenting','asc')
									->get();
					?>
					@if(count($gambar_parenting)>1)
					<div class="row">
			    		@foreach($gambar_parenting as $g)
							<div class="col-md-4">
								<a href="{{url($g->filename)}}" class="image-popup" title="{{$g->caption}}" >
									<span class="thumb-info thumb-info-lighten thumb-info-centered-info thumb-info-no-zoom mt-lg">
										<span class='thumb-info-wrapper'>
											<img src="{{url($g->thumbs)}}" class='img-responsive'>
											<span class='thumb-info-title'>
												<span class='thumb-info-type'>
													{{$g->caption}}
												</span>
											</span>
										</span>
									</span>
								</a>
							</div>
						@endforeach
					</div>
					@endif
				</div>
			</article>
		</div>
	</div>
	<div class="col-md-3">
		<aside class="sidebar">
		<div class="tabs mb-xlg">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#recentPosts" data-toggle="tab">Parenting Lainnya</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="recentPosts">
					<ul class="simple-post-list">
						<?php 
						$recentPosts = DB::table('parenting')
							->select('uuid','judul','tgl_posting')
							->where('uuid','<>', $parenting->uuid)
							->orderby('tgl_posting','desc')->orderby('created_at','desc')->limit(6)->get();
						?>
						@foreach($recentPosts as $r)
						<li>
							<div class="post-info">
								<a href="{{url('baca-parenting/'.$r->uuid)}}">{{$r->judul}}</a>
								<div class="post-meta">
									{!! tgl_indo_singkat($r->tgl_posting) !!}
								</div>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		</aside>
	</div>
</div>
@endsection