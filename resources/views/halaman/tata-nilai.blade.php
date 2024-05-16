@extends('layout-page')
@section("content")
<?php
loadHelper('format');
?>
<link href="{{asset('css/font/font.css')}}">
<style>
</style>
<div class="row">
  <div class="col-md-9">
    <div class="heading heading-primary heading-border heading-bottom-border"> 
          <h4 class=heading-default>
            <a href="{{url('visi')}}" data-plugin-tooltip="" type="link" data-toggle="tooltip" data-placement="right" title="Lihat lainnya" data-original-title="Lihat lainnya">Tata Nilai <strong>Puskesmas Muara Bulian</strong>&nbsp;<i class="fa fa-caret-right"></i></a>
          </h4> 
      </div> 
      <div>
<!-- <div class="watermarked">
  <img src="{{asset('img/web/tata-nilai.png')}}" alt="Photo"> -->
      <b>Dinas Kesehatan Kabupaten Batanghari <strong>UPTD Puskesmas Muara Bulian
<br></strong></b>
<br>
        <div class="row">
            <div class="col-xl-4">
            <a href="{{asset('img/web/tata-n.jpg')}}" class="image-popup" title="Tata Nilai Puskesmas Muara Bulian">
              <span class="thumb-info thumb-info-lighten thumb-info-centered-info thumb-info-no-zoom mt-lg">
                <span class='thumb-info-wrapper'>
                  <img src="{{asset('img/web/tata-n.jpg')}}" class='img-responsive'>
                  <span class='thumb-info-title'>
                    <span class='thumb-info-type'>
                    </span>
                  </span>
                </span>
              </span>
            </a>
          </div>
                <!-- <div class="media">
                      <a href="javascript:;" class="pull-left">
                        <img width="100%" height="100%" src="{{asset('img/web/tata-n.jpg')}}" alt="Logo Website" class="media-object">
                      </a> -->
<!--   <div class="panel panel-default">
        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="cursor: pointer;color:#000000;background-color: #ffffff;"align="justify">
          <h4 class="panel-title">
            <span class="glyphicon glyphicon-plus-sign"></span>
             : Tata Nilai Puskesmas Muara Bulian
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in">
          <div class="panel-body"align="justify">
          <span class="glyphicon glyphicon-ok-sign"></span> <b> :</b> <img src="{{asset('img/web/tata-nilai.png')}}">PERUBAHAN MENUJU ARAH BARU BATANG HARI TANGGUH <br>
        (Terdepan, Agamis, Nyaman, Gotong Royong, Bermutu Dan Harmonis)</div>
        </div>
      </div>
      <br> -->
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