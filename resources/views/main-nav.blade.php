<ul class="nav nav-pills" id="mainNav">
<?php 
$rootmenu = DB::select("SELECT a.*, b.uuid as uuid_halaman from  
	tree_menu as a left join halaman as b on a.id_halaman = b.id_halaman 
	where a.id_induk = 'root' order by a.id_node asc
	");
?>
	@foreach($rootmenu as $r)
		@if($r->tipe=='direktori')
			<li class="dropdown">
				<a class="dropdown-toggle" href="#">{{$r->judul}}</a>
				<?php 
					$has_child1 = DB::table('tree_menu')->where('id_induk', $r->id_node)->count() > 0;
					$id_node1 = $r->id_node;
					if($has_child1){
						$child1 = DB::select("SELECT a.*, b.uuid as uuid_halaman from  
									tree_menu as a left join halaman as b on a.id_halaman = b.id_halaman 
									where a.id_induk = '$id_node1' order by a.id_node asc
									");
					}
				?>
				@if($has_child1)
					<ul class="dropdown-menu">
						@foreach($child1 as $c1)
							@if($c1->tipe=='direktori')
							<li class="dropdown-submenu">
								<a class="dropdown-toggle" href="#">{{$c1->judul}}</a>
								<ul class="dropdown-menu">
									<?php 
										$has_child2 = DB::table('tree_menu')->where('id_induk', $c1->id_node)->count() > 0;
										$id_node2 = $c1->id_node;
										if($has_child2){
											$child2 = DB::select("SELECT a.*, b.uuid as uuid_halaman from  
														tree_menu as a left join halaman as b on a.id_halaman = b.id_halaman 
														where a.id_induk = '$id_node2' order by a.id_node asc
														");
										}
									?>
									@if($has_child2)
										@foreach($child2 as $c2)
											@if($c2->tipe=='page')
												<li><a href="{{url('baca-halaman/'.$c2->uuid_halaman)}}">{{$c2->judul}}</a></li>
											@endif
											@if($c2->tipe=='url')
												<li><a href="{{$c2->url}}">{{$c2->judul}}</a></li>
											@endif
										@endforeach
									@endif
								</ul>	
							</li>
							@endif

							@if($c1->tipe=='page')
								<li><a href="{{url('baca-halaman/'.$c1->uuid_halaman)}}">{{$c1->judul}}</a></li>
							@endif
							@if($c1->tipe=='url')
								<li><a href="{{$c1->url}}">{{$c1->judul}}</a></li>
							@endif
						@endforeach
					</ul>
				@endif
			</li>
		@endif
		@if($r->tipe=='page')
			<li>
				<a href="{{url('baca-halaman/'.$r->uuid_halaman)}}">{{$r->judul}}</a>
			</li>
		@endif
		@if($r->tipe=='url')
			<li><a href="{{$r->url}}">{{$r->judul}}</a></li>
		@endif
	@endforeach	
</ul>