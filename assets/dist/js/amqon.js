//modal hapus
  function active(kode,url)
	{
    swal({
		title: "Are you sure?",
		text: "You want to activate <b>"+kode+"</b> !",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#02b563',
		confirmButtonText: 'Yes',
		cancelButtonText: "No",
    html: true,
		closeOnConfirm: false
  	},
  	function(){
      location.href=url;
  	});
	}

  function deactive(kode,url)
	{
    swal({
		title: "Are you sure?",
		text: "You want to deactivate <b>"+kode+"</b> !",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#02b563',
		confirmButtonText: 'Yes',
		cancelButtonText: "No",
    html: true,
		closeOnConfirm: false
  	},
  	function(){
      location.href=url;
  	});
	}

  function hapus(kode,url)
	{
    swal({
		title: "Are you sure?",
		text: "You want to delete data <b>"+kode+"</b> ?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#02b563',
		confirmButtonText: 'Yes',
		cancelButtonText: "No",
    html: true,
		closeOnConfirm: false
  	},
  	function(){
      location.href=url;
  	});
	}

  //wow js
  new WOW().init();
