<div class="row" style="padding:30px !important;">
<div class="center">
	<h3>Website Resmi <strong> Puskesmas Pasar Muara Tembesi </strong> Kabupaten Batang Hari<br></h3>
</div>
<hr>
	<div class="col-md-4">
		<h4 class="mt-sm" style="line-height:1.2em !important;"> Puskesmas Pasar Muara Tembesi </h4>
		<h4 class="mt-sm" style="font-size:1.8em;">Kabupaten Batang Hari</h4>
		<i class="fa fa-map-marker"></i>&nbsp;&nbsp;{!! config('instansi.alamat')!!}								
		<br><i class="fa fa-phone"></i>&nbsp;&nbsp;{!! config('instansi.telepon')!!}								
		<br><i class="fa fa-fax"></i>&nbsp;&nbsp;{!! config('instansi.fax')!!}								
		<br><i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:{!! config('instansi.email')!!}">{!! config('instansi.email')!!}</a><br>
		<hr>
	</div>
	<div class="col-md-8">
		<div id="petakontak" class="google-map small mt-none mb-none"></div>
		<hr class="invisible short" />
	</div>
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3sZDKFRZf47zKvJyk_4sLvdUFVhGleJA&callback=initMap"></script>
<script>
  function initMap() {
    var originalMapCenter = new google.maps.LatLng(-1.7132967, 103.2627910);
	var map = new google.maps.Map(document.getElementById('petakontak'), {
  	  zoom: 15,
  	  center: originalMapCenter,
  	  zoomControl: true,
  	  mapTypeControl: true,
  	  scaleControl: false,
  	  streetViewControl: false,
  	  rotateControl: false,
  	  fullscreenControl: true
	});
	var infowindow = new google.maps.InfoWindow({
	  content:"<center><strong>Puskesmas Pasar Muara Tembesi Kabupaten Batang Hari</strong><br/>{!! config('instansi.alamat') !!} <br/><a href='https://www.google.com/maps/search/?api=1&query=-1.6000227,103.3792110' target='_blank'><i class='fa fa-location-arrow'></i> Lihat Petunjuk</a></center>"
	});
	infowindow.setPosition(originalMapCenter);
	infowindow.open(map);
	
  }
</script>

<!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/5c74cf903341d22d9ce61a8d/default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
</script> -->
<!--End of Tawk.to Script-->