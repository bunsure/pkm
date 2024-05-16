@extends("backend.layout")
@section("content")
<?php
loadHelper('akses');
?>
<div class="m-content">
	<!--begin::Portlet-->
	<div class="m-portlet">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<span class="m-portlet__head-icon m--hide">
					<i class="la la-gear"></i>
					</span>
					<h3 class="m-portlet__head-text">Kotak Pengaduan</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<div class="row">
				<div class="col-md-12">
		         	<?php 
		         	$kolom = array(
		         				['name'=>'Nomor','width'=>'5%'],
		         				['name'=>'Pengirim','width'=>'20%'],
		         				['name'=>'Email','width'=>'18%'],
		         				['name'=>'Subjek','width'=>'40%'],
		         				['name'=>'Dikirim','width'=>'17%'],
		         			);
		         	?>
	         		{{Html::bsDatatable('tabel1',$kolom)}}
		         </div>
			</div>
			 
		</div>
	</div>
	<!--end::Portlet-->
</div>
<style type="text/css">
	tr.unread{
		background:  #eac675 !important;
	}
</style>
@endsection

@section("modal")
	  

@endsection

@section("js")
<script type="text/javascript">
	$(function(){
		
		<?php 
		$field = array(
				['name'=>'a.nomor_pengaduan', 'data'=>'nomor_pengaduan','order'=>'false', 
				'search'=>'true','class'=>'text-center'],
				['name'=>'a.nama_lengkap','data'=>'nama_lengkap','order'=>'true', 'search'=>'true','class'=>''],
				['name'=>'a.email','data'=>'email','order'=>'false', 'search'=>'true','class'=>''],
				['name'=>'a.subjek','data'=>'subjek','order'=>'false', 'search'=>'true','class'=>''],
				['name'=>'a.created_at','data'=>'created_at','order'=>'true', 'search'=>'true','class'=>'text-center'],
			);
		?>
		{{Html::jsDatatable('tabel1',$field,url('backend/kotak-pengaduan/dt'),10,1,true)}}

	})

</script>
@endsection