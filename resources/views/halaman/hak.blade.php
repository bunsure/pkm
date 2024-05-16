@extends('layout-page')
@section("content")
<?php
loadHelper('format');
?>
<div class="row">
  <div class="col-md-9">
    <div class="heading heading-primary heading-border heading-bottom-border"> 
          <h4 class=heading-default>
            <a href="{{url('visi')}}" data-plugin-tooltip="" type="link" data-toggle="tooltip" data-placement="right" title="Lihat lainnya" data-original-title="Lihat lainnya">Hak dan Kewajiban Pasien <strong>Puskesmas Muara Bulian</strong>&nbsp;<i class="fa fa-caret-right"></i></a>
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
             : Hak Pasien di UPTD Puskesmas Muara Bulian 
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
          <div class="panel-body"align="justify">
          <span class="glyphicon glyphicon-ok-sign"></span> <b> :</b>
          <ol type="1">
            <li>
              Memperoleh pelayanan yang manusiawi, adil, jujur dan tanpa diskriminasi;
            </li>
            <li>
              Memperoleh layanan kesehatan yang bermutu sesuai dengan standar profesi dan standar operasional prosedur;
            </li>
            <li>
              Memperoleh pelayanan yang efektif dan efisien seehingga pasien terhindar dari kerugian fisik dan materi;
            </li>
            <li>
              Memilih dokter dan dokter gigi yang sesuai dengan keinginannya dan peraturan rumahsakit/puskesmas, bila memungkinkan;
            </li>
            <li>
              Meminta konsultasi tentang penyakit yang dideritanya kepada dokter atau dokter gigi lain yang mempunyai SIP baik di dalam maupun diluar rumah sakit/puskesmas;
            </li>
            <li>
              Mendapatkan privasi dan kerahasiaan penyakit yang diderita termasuk data-data medisnya;
            </li>
            <li>
              Mendapatkan informasi yang meliputi diagnosa dan tata cara tindakan medis, tujuan tindakan medis, alternative tindakan, resiko dan komplikasi yang mungkin terjadi dan progosis terhadap tindakan yng dilakukan serta perkiraan biaya pengobatan;
            </li>
            <li>
              Memberikan persetujuan atau menolak atas tindakan yang akan dilakukan oleh tenaga kesehatan atas penyakit yang dideritanya;
            </li>
            <li>
              Didampingi keluarganya pada saat kritis;
            </li>
              <ol>
                <li>
                  Menjalankan ibadah sesuai dengan agama selama hal tersebut tidak mengganggu pasien lain;
                </li>
                <li>
                  Memperoleh keamanan dan keselamatan dirinya selama menjalani perawatan di rumah sakit/puskesmas;
                </li>
                <li>
                  Mengajukan usul, saran atau perbaikan atas perlakuan rumah sakit/puskesmas terhadap dirinya;
                </li>
                <li>
                  Menolak pelayanan bimbingan rohani yang tidak sesuai dengan agama atau kepercayaannya;
                </li>
                <li>
                  Mendapatkan perlindungan atas rahasia kedokteran termasuk kerahasiaan rekam medis;
                </li>
                <li>
                  Mendapatkan akses terhadap isi rekam medis;
                </li>
                <li>
                  Memberikan persetujuan atau menolak untuk menjadi bagian dalam suatu penelitian;menyampaikan pengaduan atau keluhan atas pelayanan yang diterima.
                </li>
              </ol>
          </ol>
        </div>
        </div>
      </div>
      <br>

      <div class="panel panel-default">
        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="cursor: pointer;color:#000000;background-color: #ffffff;"align="justify">
          <h4 class="panel-title">
            <span class="glyphicon glyphicon-plus-sign"></span>
             : Kewajiban Pasien di UPTD Puskesmas Muara Bulian
          </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse collapse">
          <div class="panel-body"align="justify"> <span class="glyphicon glyphicon-ok-sign"></span> <b> :</b>
            <ol type="1">
            <li>
              Mematuhi peraturan yang berlaku;
            </li>
            <li>
              Menggunakan fasilitas rumahsakit/puskesmas secara bertanggung jawab;
            </li>
            <li>
              Menghormati hak-hak pasien lain, pengunjung dan hak tenaga kesehatan serta petugas lain;
            </li>
            <li>
              Memberikan informasi yang jujur,lengkap dan akurat sesuai dengan kemampuan dan pengetahuannya tentang masalah kesehatannya;
            </li>
            <li>
              Memberikan informasi mengenai kemampuan finansial dan jaminan kesehatan yang dimilikinya;
            </li>
            <li>
              Mematuhi rencana terapi yang direkomendasikanoleh tenaga kesehatan dan disetujui oleh pasien yang bersangkutansetelah mendapatkan penjelasan sesuai peraturan perundang-undangan;
            </li>
            <li>
              Menerima segala konsekuensi atas keputusan pribadinya untuk menolak rencana terapi yang direkomendasikan oleh tenaga kesehatan dan atau tidak mematuhi petunjuk yang diberikan oleh tenaga kesehatan dalam rangka penyembuhan penyakit atau masalah kesehatannya; dan
            </li>
            <li>
              Memberikan imbalan jasa atas pelayanan yang diterima.
            </li>
          </ol>
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