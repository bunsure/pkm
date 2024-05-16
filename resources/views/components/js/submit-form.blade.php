$('#{{$id}}').ajaxForm({
	beforeSubmit:function(){$("#{{$id}} button[type=submit]").button('loading');},
	success:function($respon){
		$("#{{$id}} button[type=submit]").button('reset');
		if ($respon.status==true){
			showNotify('Berhasil',$respon.message);
			@if($callback!='') {{$callback}}(); @endif
		}else{
			showAlert('Gagal',$respon.message);
		}

	},
	error:function(){
		showAlert('Gagal','Terjadi Kesalahan Sistem!');
	}
}); 