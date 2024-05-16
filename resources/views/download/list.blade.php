@extends('layout-page')
@section("content")
<?php
loadHelper('format');

?>
<div class="row">
	<div class="col-md-9">
		<div class="heading heading-primary heading-border heading-bottom-border" style="margin-bottom: 15px !important;"> 
		    <h4 class=heading-default>
		    	<a href="{{url('download')}}">Download <strong>Dokumen</strong>&nbsp;<i class="fa fa-caret-right"></i></a>
		    </h4> 
		</div> 
		<div class="blog-posts">
			<?php 
			 $current = $download->currentPage();
			 $perpage = $download->perPage();
			?>
			 <div class="col-,md-12">
			 	<table class="table table-condensed table-hover table-striped">
			 		<thead>
			 			<tr>
			 				<th width="5%">No.</th>
			 				<th width="85%">Nama Dokumen</th>
			 				<th width="10%">Download</th>
			 			</tr>
			 		</thead>
			 		<tbody>
			 			<?php
			 				$no = 1 + ($current - 1) * $perpage;
			 			?>
			 			@foreach($download as $d)
				 			<?php
				 			$tautan = "";
				            $link = url($d->filename);
				            if($d->tipe=='file'){
				                $tautan = '<a href="https://docs.google.com/viewer?url='.$link.'" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>';
				            }else{
				                $tautan = '<a href="'.$link.'" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download</a>';
				            }
				 			?>
				 			<tr>
				 				<td>
				 					{!!$no++!!}
				 				</td>
				 				<td>
				 					{!! $d->nama !!}
				 				</td>
				 				<td align="center">
				 					{!! $tautan !!}
				 				</td>
				 			</tr>
			 			@endforeach
			 		</tbody>
			 	</table>
			 </div>
		</div>
		<hr class="invisible short">
		{!! $download->links() !!}
	</div>
	<div class="col-md-3">
		<aside class="sidebar">
		 @include("sidewidget")
		</aside>
	</div>
</div>
@endsection