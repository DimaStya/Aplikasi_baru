function SetInput(kode_area, kode_perwakilan,kode_kerjasama,kode_nasional,no_pengajuan,tanggal,
	nama_area,alamat_perwakilan,nama_kerjasama,rabat){
	document.getElementById("kode_area").value = kode_area;
	document.getElementById("kode_perwakilan").value = kode_perwakilan;
	document.getElementById("kode_kerjasama").value = kode_kerjasama;
	document.getElementById("no_pengajuan").value = no_pengajuan;
	document.getElementById("kode_nasional").value = kode_nasional;
	document.getElementById("nama_area").value = nama_area;
	document.getElementById("alamat_perwakilan").value = alamat_perwakilan;
	document.getElementById("nama_kerjasama").value = nama_kerjasama;
	document.getElementById("rabat").value = rabat;
	document.getElementById("no_pengajuanhidden").value = no_pengajuan;

	document.getElementById("no_pengajuanold").value = no_pengajuan;
	document.getElementById("kode_kerjasamaold").value = kode_kerjasama;
	document.getElementById("alamat_perwakilanold").value = alamat_perwakilan;
	document.getElementById("nama_kerjasamaold").value = nama_kerjasama;


	document.getElementById("rabatedit").value = rabat;
	document.getElementById("no_pengajuanedit").value = no_pengajuan;
	document.getElementById("tanggaledit").value = tanggal;
}