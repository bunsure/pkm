<?php 
$berita_terakhir = DB::table('berita')->orderby('created_at','desc')->first();
?>
@if($berita_terakhir)
<?php 
$gambar =DB::table('gambar_berita as a')
		->select('b.*')
		->join('gambar as b','b.id_gambar', '=','a.id_gambar')
		->where('id_berita', $berita_terakhir->id_berita)
		->orderby('id_gambar_berita','asc')
		->first();
if($gambar){
	$img = url($gambar->thumbs);
}else{
	$img = url("upload/gambar/default-thumbs.png");
}
?>
<div class="col-md-6">
<a href="{{url('baca-berita/'.$berita_terakhir->uuid)}}">
	<img class="img-thumbnail" src="{!! $img !!}" style="width: 100% !important;">
	<hr class="invisible short">
</a>
</div>
<div class="col-md-6">
	<div class="recent-posts">
		<article class="post"><!--<div class=date><span class=day></span><span class=month></span></div>-->
			<h4>
				<a href="{{url('baca-berita/'.$berita_terakhir->uuid)}}">
					{{$berita_terakhir->judul}}
				</a>
			</h4>
			<p style="text-align:justify">
				<?php 
				$deskripsi = substr($berita_terakhir->isi, 0, 200);
				$deskripsi = strip_tags($deskripsi);
				?>
				{!! $deskripsi !!}
				<a href="{{url('baca-berita/'.$berita_terakhir->uuid)}}" class="read-more"> 
					Selengkapnya <i class="fa fa-angle-right"></i></a>
			</p>
			<?php
				$other_berita = DB::table('berita')
						->select('judul','uuid')
						->where('uuid','!=', $berita_terakhir->uuid)
						->orderby('created_at','desc')->limit(6)->get();
			?>
			<ul class="list list-icons list-icons-sm">
				@foreach($other_berita as $ob)
				<li>
					<i class="fa fa-caret-right"></i>
					<a href="{{url('baca-berita/'.$ob->uuid)}}">
						{!! $ob->judul !!}
					</a>
				</li>
				@endforeach
				<p></p>
			</ul>
		</article>
	</div>
</div>
@else
<div class="col-md-12">
	<div class="alert alert-info">
		<center>Belum Ada Berita</center>
	</div>
</div>
@endif