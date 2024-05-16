
<div class="heading heading-primary heading-border heading-bottom-border" style="margin-bottom: 15px !important;"> 
    <h4 class=heading-default>
    	<a href="{{url('gallery')}}" data-plugin-tooltip="" type="link" data-toggle="tooltip" data-placement="right" title="Lihat lainnya" data-original-title="Lihat lainnya">Gallery <strong>Photo</strong>&nbsp;<i class="fa fa-caret-right"></i></a>
    </h4> 
</div> 
<?php 
$gallery = DB::table('gallery_photo')->orderby('id_gallery','desc')->limit(10)->get();
?>
<div class="owl-carousel owl-theme" data-plugin-options='{"items": 2, "autoplay": true, "dots": false,"margin": 10}'>
		@foreach($gallery as $g)
			<div>
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
<hr class=invisible> 

 