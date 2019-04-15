function SetInput(kode_buku,kode_penerbit,jenjang,kelas,tipe,kurikulum,judul,edisi,){
	document.getElementById("kode_bukuhidden").value = kode_buku;
	document.getElementById("kode_penerbit").value = kode_penerbit;
	document.getElementById("kode_buku").value = kode_buku;
	document.getElementById("jenjang").value = jenjang;
	document.getElementById("kelas").value = kelas;
	document.getElementById("tipe").value = tipe;
	document.getElementById("kurikulum").value = kurikulum;
	document.getElementById("judul").value = judul;
	document.getElementById("edisi").value = edisi;

	document.getElementById("kode_bukunew").value = kode_buku;
	document.getElementById("kode_penerbitnew").value = kode_penerbit;
	document.getElementById("jenjangnew").value = jenjang;
	document.getElementById("kelasnew").value = kelas;
	document.getElementById("tipenew").value = tipe;
	document.getElementById("kurikulumnew").value = kurikulum;
	document.getElementById("judulnew").value = judul;
	document.getElementById("edisinew").value = edisi;
}