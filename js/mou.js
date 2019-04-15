function SetInput(kode_area, 
	kode_perwakilan,
	kode_cv,
	kode_nasional,

	no_mou,
	tanggal,
	nama_area,
	alamat_perwakilan,
	nama_cv,
	rabat){
	document.getElementById("kode_area").value = kode_area;
	document.getElementById("kode_perwakilan").value = kode_perwakilan;
	document.getElementById("kode_cv").value = kode_cv;
	document.getElementById("no_mou").value = no_mou;
	document.getElementById("kode_nasional").value = kode_nasional;
	document.getElementById("nama_area").value = nama_area;
	document.getElementById("alamat_perwakilan").value = alamat_perwakilan;
	document.getElementById("nama_cv").value = nama_cv;
	document.getElementById("rabat").value = rabat;
	document.getElementById("no_mouhidden").value = no_mou;

	document.getElementById("no_mouold").value = no_mou;
	document.getElementById("kode_cvold").value = kode_cv;
	document.getElementById("alamat_perwakilanold").value = alamat_perwakilan;
	document.getElementById("nama_cvold").value = nama_cv;


	document.getElementById("rabatedit").value = rabat;
	document.getElementById("no_mouedit").value = no_mou;
	document.getElementById("tanggaledit").value = tanggal;
}