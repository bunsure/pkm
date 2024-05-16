$('#{{$id}}').ajaxForm({
	beforeSubmit:function(){
		mApp.block("#modal-{{$id}} .modal-content", {
                overlayColor: "#000000",
                type: "loader",
                state: "primary",
                message: "Processing..."
            }), setTimeout(function() {
            }, 2e3)
	},
	success:function($respon){
		$("#{{$id}} button[type=submit]").button('reset');
		$("#modal-{{$id}}").modal('hide');
		mApp.unblock("#modal-{{$id}} .modal-content") 
		if ($respon.status==true){
			showNotify('Berhasil',$respon.message);
			@if($callback!='') {{$callback}}(); @endif
		}else{
			showAlert('Gagal',$respon.message);
		}

	},
	error:function(){
		showAlert('Gagal','Terjadi Kesalahan, Periksa Data Inputan!');
	}
}); 