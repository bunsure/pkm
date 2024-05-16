<?php
function toDateSystem($date){
	$date = explode("/", $date);
	return $date[2]."-".$date[1]."-".$date[0];
}

function toDateDisplay($date){
	$date = explode("-", $date);
	return $date[2]."-".$date[1]."-".$date[0];
}

function toDecimal($rupiah){
	$rupiah = str_replace("Rp", "", $rupiah);
	$rupiah = trim($rupiah);
	$rupiah = str_replace(",", "", $rupiah);
	if((int)$rupiah==0){
		return '0.00';
	}
	return $rupiah;
}

function toMoney($data){
	return  number_format($data,0,",",".");
}

function toMoneyInput($data){
	return  number_format($data,2,".",",");
}

function toRupiah2($data){
	return  number_format($data,2,",",".");
}

function selisih_hari($tgl_awal, $tgl_akhir){
	$tanggal1 = new DateTime($tgl_awal);
	$tanggal2 = new DateTime($tgl_akhir);
	 
	$selisih = $tanggal2->diff($tanggal1)->format("%a");
	return $selisih;
}

function tgl_indo($data){
	$tgl = explode("-",$data);
	$bulan = array("0"=>"","1"=>'Januari', "2"=>'Februari', "3"=>'Maret', "4"=>"April", "5"=>'Mei', "6"=>'Juni', "7"=>'Juli', "8"=>
		'Agustus', "9"=>'September', "10"=>'Oktober', "11"=>'November',"12"=>'Desember');
	if(count($tgl)==3){
		return $tgl[2]." ".$bulan[(int)$tgl[1]]." ".$tgl[0];
	}else{
		return "";
	}
}

function tgl_indo_singkat($data){
	$tgl = explode("-",$data);
	$bulan = array("0"=>"","1"=>'Jan', "2"=>'Feb', "3"=>'Mar', "4"=>"Apr", "5"=>'Mei', "6"=>'Jun', "7"=>'Jul', "8"=>
		'Ags', "9"=>'Sep', "10"=>'Okt', "11"=>'Nov',"12"=>'Des');
	if(count($tgl)==3){
		return $tgl[2]." ".$bulan[(int)$tgl[1]]." ".$tgl[0];
	}else{
		return "";
	}
}

function rentang_tanggal($tanggal_awal, $tanggal_akhir){
	$bulan = array("0"=>"","1"=>'Januari', "2"=>'Februari', "3"=>'Maret', 
		"4"=>"April", "5"=>'Mei', "6"=>'Juni', "7"=>'Juli', "8"=>
		'Agustus', "9"=>'September', "10"=>'Oktober', "11"=>'November',"12"=>'Desember');
	$tanggal = "";
	$tgl1 = explode("-",$tanggal_awal);
	$tgl2 = explode("-",$tanggal_akhir);
    if(count($tgl1)==3){
    	$tanggal = (int)$tgl1[2]." ".$bulan[(int)$tgl1[1]] ;
    	if($tgl1[0]!=$tgl2[0]){
    		$tanggal .= " ". $tgl1[0];
    	}
    	$tanggal .= " - ";
    }

    if(count($tgl2)==3){
    	$tanggal .= (int)$tgl2[2]." ".$bulan[(int)$tgl2[1]] ." ". $tgl2[0]; 	
    }

    return $tanggal;
}


