function SetInput(kode_area, 
	kode_perwakilan,
	kode_customer,
	kode_nasional,

	no_pengajuan,
	nama_area,
	alamat_perwakilan,
	nama_customer,
	rabat){
	document.getElementById("kode_area").value = kode_area;
	document.getElementById("kode_perwakilan").value = kode_perwakilan;
	document.getElementById("kode_customer").value = kode_customer;
	document.getElementById("no_pengajuan").value = no_pengajuan;
	document.getElementById("kode_nasional").value = kode_nasional;
	document.getElementById("nama_area").value = nama_area;
	document.getElementById("alamat_perwakilan").value = alamat_perwakilan;
	document.getElementById("nama_customer").value = nama_customer;
	document.getElementById("rabat").value = rabat;
	document.getElementById("no_pengajuanhidden").value = no_pengajuan;

	document.getElementById("no_pengajuanold").value = no_pengajuan;
	document.getElementById("kode_customerold").value = kode_customer;
	document.getElementById("alamat_perwakilanold").value = alamat_perwakilan;
	document.getElementById("nama_customerold").value = nama_customer;


	document.getElementById("rabatedit").value = rabat;
	document.getElementById("no_pengajuanedit").value = no_pengajuan;
}