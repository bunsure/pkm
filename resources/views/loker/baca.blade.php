@extends('layout-page')
@section("content")
<?php
loadHelper('format');
$gambar =DB::table('gambar_loker as a')
		->select('b.*')
		->join('gambar as b','b.id_gambar', '=','a.id_gambar')
		->where('id_loker', $loker->id_loker)
		->orderby('id_gambar_loker','asc')
		->first();
$id_gambar_utama = "";
if($gambar){
	$img = url($gambar->filename);
	$id_gambar_utama = $gambar->id_gambar;
}else{
	$img = "";
}
?>
<div class="row">
	<div class="col-md-9">
		<div class="blog-posts">
			<article class="post">
				<div class="post-content">
					<h2><a href="#">
						{{$loker->judul}}
					</a></h2>
					<div class="post-meta">
						<span><i class="fa fa-calendar"></i>
							{!! tgl_indo_singkat($loker->tgl_posting) !!}
						</span>
						<span><i class="fa fa-user"></i> Dipublikasikan oleh {!! $loker->create_by !!} </span>
						<span><i class="fa fa-tag"></i><a href="{{url('list-loker')}}">Lowongan</a></span>
					</div>
					<hr class="invisible short">
					@if($img!="")
					<div class="img-thumbnail">
						<img width="100%" src="{{$img}}" alt="{{$gambar->caption}}">
						<small>{{$gambar->caption}}</small>
					</div>
					<hr class="invisible short">
					@endif
					<div>
					 {!! $loker->isi !!}
					</div>
					<hr class="invisible short">
					<?php
					$gambar_loker =  DB::table('gambar_loker as a')
									->select('b.*')
									->join('gambar as b','b.id_gambar', '=','a.id_gambar')
									->where('id_loker', $loker->id_loker)
									->orderby('id_gambar_loker','asc')
									->get();
					?>
					@if(count($gambar_loker)>1)
					<div class="row">
			    		@foreach($gambar_loker as $g)
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
					<a href="#recentPosts" data-toggle="tab">Lowongan Lainnya</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="recentPosts">
					<ul class="simple-post-list">
						<?php 
						$recentPosts = DB::table('loker')
							->select('uuid','judul','tgl_posting')
							->where('uuid','<>', $loker->uuid)
							->orderby('tgl_posting','desc')->orderby('created_at','desc')->limit(6)->get();
						?>
						@foreach($recentPosts as $r)
						<li>
							<div class="post-info">
								<a href="{{url('baca-loker/'.$r->uuid)}}">{{$r->judul}}</a>
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