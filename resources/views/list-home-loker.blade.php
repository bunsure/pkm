<?php 
$loker_terakhir = DB::table('loker')->orderby('created_at','desc')->first();
?>
@if($loker_terakhir)
<?php 
$gambar =DB::table('gambar_loker as a')
		->select('b.*')
		->join('gambar as b','b.id_gambar', '=','a.id_gambar')
		->where('id_loker', $loker_terakhir->id_loker)
		->orderby('id_gambar_loker','asc')
		->first();
if($gambar){
	$img = url($gambar->thumbs);
}else{
	$img = url("upload/gambar/default-thumbs.png");
}
?>
<div class="col-md-6">
	<img class="img-thumbnail" src="{!! $img !!}" style="width: 100% !important;">
	<hr class="invisible short">
</div>
<div class="col-md-6">
	<div class="recent-posts">
		<article class="post"><!--<div class=date><span class=day></span><span class=month></span></div>-->
			<h4>
				<a href="{{url('baca-loker/'.$loker_terakhir->uuid)}}">
					{{$loker_terakhir->judul}}
				</a>
			</h4>
			<p style="text-align:justify">
				<?php 
				$deskripsi = substr($loker_terakhir->isi, 0, 200);
				$deskripsi = strip_tags($deskripsi);
				?>
				{!! $deskripsi !!}
				<a href="{{url('baca-loker/'.$loker_terakhir->uuid)}}" class="read-more"> 
					Selengkapnya <i class="fa fa-angle-right"></i></a>
			</p>
			<?php
				$other_loker = DB::table('loker')
						->select('judul','uuid')
						->where('uuid','!=', $loker_terakhir->uuid)
						->orderby('created_at','desc')->limit(6)->get();
			?>
			<ul class="list list-icons list-icons-sm">
				@foreach($other_loker as $ol)
				<li>
					<i class="fa fa-caret-right"></i>
					<a href="{{url('baca-loker/'.$ol->uuid)}}">
						{!! $ol->judul !!}
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
		<center>Belum Ada Lowongan</center>
	</div>
</div>
@endif