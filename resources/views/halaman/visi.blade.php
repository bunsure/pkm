@extends('layout-page')
@section("content")
<?php
loadHelper('format');
?>
<div class="row">
  <div class="col-md-9">
    <div class="heading heading-primary heading-border heading-bottom-border"> 
          <h4 class=heading-default>
            <a href="{{url('visi')}}" data-plugin-tooltip="" type="link" data-toggle="tooltip" data-placement="right" title="Lihat lainnya" data-original-title="Lihat lainnya">Visi dan Misi <strong>Puskesmas Muara Bulian</strong>&nbsp;<i class="fa fa-caret-right"></i></a>
          </h4> 
      </div> 
      <div>

<div class="row text-center" id="accordion">
      <b>Dinas Kesehatan Kabupaten Batanghari <strong>UPTD Puskesmas Muara Bulian
<br></strong></b>
<br>

      <div class="panel panel-default">
        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="cursor: pointer;color:#000000;background-color: #ffffff;"align="justify">
          <h4 class="panel-title">
            <span class="glyphicon glyphicon-plus-sign"></span>
             : Visi UPTD Puskesmas Muara Bulian
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in">
          <div class="panel-body"align="justify">
          <span class="glyphicon glyphicon-ok-sign"></span> <b> :</b> PERUBAHAN MENUJU ARAH BARU BATANG HARI TANGGUH <br>
        (Terdepan, Agamis, Nyaman, Gotong Royong, Bermutu Dan Harmonis)</div>
        </div>
      </div>
      <br>

      <div class="panel panel-default">
        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer;color:#000000;background-color: #ffffff;"align="justify">
          <h4 class="panel-title">
            <span class="glyphicon glyphicon-plus-sign"></span>
             : Misi UPTD Puskesmas Muara Bulian?
          </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse collapse">
          <div class="panel-body"align="justify"> <span class="glyphicon glyphicon-ok-sign"></span> <b> :</b>
            <ol type="1">
            <li>
              Terdepan Dalam Penguatan Ketahanan Ekonomi Berbasis Daya Saing Pertanian Dan Agrowisata Untuk Peningkatan Kesejahteraan Masyarkat Berkelanjutan.
            </li>
            <li>
              Memperkuat Akhlaqul Karimah, Sinergitas Umarah dan Ulaman, Semangat Gotong Royong Dan Kemandirian Masyarakat Sebagai Agen Perubahan Dalam Mempercepat Pembangunan
              Dan Tatanan Kehidupan Masyarakat Yang Agamis.
            </li>
            <li>
              Menciptakan Ruang Kota Yang Nyaman Dan Aman, Serta Menjamin Tumbuhnya Ruang Berusaha Dan Iklim Investasi Yang Sehat.
            </li>
            <li>
              Mewujudkan Peningkatan Sumber Daya Manusia Yang Bermutu Dan Kompetitif.
            </li>
            <li>
              Mengembangkan Budaya Birokrasi Yang Harmonis Serta Sinergitas Pembangunan Daerah Dan Desa.
            </li>
          </ol>
          </div>
        </div>
      </div>
      <br>
            <div class="panel panel-default">
        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="cursor: pointer;color:#000000;background-color: #ffffff;"align="justify">
          <h4 class="panel-title">
            <span class="glyphicon glyphicon-plus-sign"></span>
             : Tujuan UPTD Puskesmas Muara Bulian?
          </h4>
        </div>
        <div id="collapse3" class="panel-collapse collapse collapse">
          <div class="panel-body"align="justify"> <span class="glyphicon glyphicon-ok-sign"></span> <b> :</b>
          Meningkatkan Upaya Kesehatan Masyarakat Dan Kesehatan Perseorangan Tingkat Pertama Dengan Lebih Mengutamakan Preventif Dan Promotive
          Di Wilayah Kerja UPTD Puskesmas Muara Bulian.
          </div>
        </div>
      </div>
      <br>
</div>
</div>
</div>
  <div class="col-md-3">
    <aside class="sidebar">
     @include("sidewidget")
    </aside>
  </div>
</div>
@endsection