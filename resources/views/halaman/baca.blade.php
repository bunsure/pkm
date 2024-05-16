@extends('layout-page')
@section("content")
<?php
loadHelper('format');
?>
<div class="row">
	<div class="col-md-9">
		<div class="blog-posts">
			<article class="post">
				<div class="post-content">
					<div class="heading heading-primary heading-border heading-bottom-border" style="margin-bottom: 15px !important;"> 
					    <h4 class=heading-default>
					    	<a href="#" type="link" style="color: #16a085 !important;">{{$halaman->judul}}</a>
					    </h4> 
					</div> 
					<div>
					 {!! $halaman->isi !!}
					</div>
					
					<?php
					$gambar_halaman  =  DB::table('gambar_halaman  as a')
									->select('b.*')
									->join('gambar as b','b.id_gambar', '=','a.id_gambar')
									->where('id_halaman', $halaman->id_halaman)
									->orderby('id_gambar_halaman','asc')
									->get();
					?>
					@if(count($gambar_halaman))
					<div class="row">
			    		@foreach($gambar_halaman  as $g)
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
				<hr class="invisible short">
			</article>
		</div>
	</div>
	<div class="col-md-3">
		<aside class="sidebar">
			@include("sidewidget")
		</aside>
	</div>
</div>
@endsection