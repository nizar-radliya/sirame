<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title_pdf;?></title>
	<style>
		#table {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		#table td, #table th {
			border: none;
			padding: 8px;
		}

		#table tr:nth-child(even){background-color: #f2f2f2;}

		#table tr:hover {background-color: #ddd;}

		#table th {
			padding-top: 10px;
			padding-bottom: 10px;
			text-align: left;
			text-align: center;
		}

		#tablekkpr {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		#tablekkpr td, #tablekkpr th {
			border: 1px solid;
			padding: 8px;
			font-size: 10px;
		}

		#tablekkpr tr:nth-child(even){background-color: #f2f2f2;}

		#tablekkpr tr:hover {background-color: #ddd;}

		#tablekkpr th {
			padding-top: 10px;
			padding-bottom: 10px;
			text-align: left;
		}
	</style>
</head>
<body>
<table id="table">
			<tr style="width: 100%">
				<td><img src="<?php echo base_url(); ?>assets/lte/img/icon.png" width="100"></td>
				<td style="text-align: center">
					<span style="font-weight: bold; font-size: 20px;">
						PEMERINTAH DAERAH KABUPATEN BEKASI<br>
						Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu<br>
					</span>
					<span style="font-size: 12px">
						Komplek Perkantoran PemKab Bekasi Gedung B1 Jln. Deltamas Boulevard Sukamahi - Cikarang Pusat - Kabupaten Bekasi - Jawa Barat 17530<br>
						Website : dpmptsp.bekasikab.go.id e-mail : dpmptsp@bekasikab.go.id<br>
					</span>
				</td>
			</tr>
		</table>
		<hr style="margin-top:0; height: 1px; background-color: #0c0c0c">

<table id="table">
	<tr style="width: 100%">
		<td style="text-align: center">
		<span style="font-weight: bold; font-size: 16px;">
		BUKTI VERIFIKASI SIRAME PKKPR
		</span>
		</td>
	</tr>
</table>
	<table id = 'tablekkpr'>
		<tr>
			<th colspan="4">I. Data PKKPR</th>
		</tr>
		<tr>
			<td style="width: 25%"><label>Nomor PKKPR</label></td>
			<td class="text-bold" style="width: 25%"><?= $kkpr[0]->nomor ?></td>
			<td style="width: 25%"><label>Tanggal Terbit</label></td>
			<td style="width: 25%"><?= onlydate($kkpr[0]->tglterbit) ?></td>
		</tr>
		<tr>
			<td><label>Nama Pelaku Usaha</label></td>
			<td><?= $kkpr[0]->namapelaku ?></td>
			<td><label>NPWP</label></td>
			<td><?= $kkpr[0]->npwp ?></td>
		</tr>
		<tr>
			<td><label>Telepon Kantor</label></td>
			<td><?= $kkpr[0]->tlppelaku ?></td>
			<td><label>Email Kantor</label></td>
			<td><?= $kkpr[0]->emailpelaku ?></td>
		</tr>
		<tr>
			<td><label>Alamat Kantor</label></td>
			<td><?= $kkpr[0]->alamatpelaku ?></td>
			<td><label>Skala Usaha</label></td>
			<td><?= $kkpr[0]->skalausaha ?></td>
		</tr>
		<tr>
			<td><label>Luas Tanah yang Dimohon</label></td>
			<td><?= number_format($kkpr[0]->luasdimohon, 2, '.', ',') ?></td>
			<td><label>Status Penanaman Modal</label></td>
			<td><?= $kkpr[0]->spm ?></td>
		</tr>
		<tr>
			<td><label>Kecamatan Lokasi</label></td>
			<td><?= read($kkpr[0]->id_kec,'kecamatan','id_kec')[0]->nama_kec; ?></td>
			<td><label>Kelurahan Lokasi</label></td>
			<td><?= read($kkpr[0]->id_kel,'kelurahan','id_kel')[0]->nama; ?></td>
		</tr>
		<tr>
			<td><label>Luas Tanah yang disetujui</label></td>
			<td><?= number_format($kkpr[0]->luasdisetujui, 2, '.', ',') ?></td>
			<td><label>Peruntukan Pemanfaatan Ruang</label></td>
			<td><?= $kkpr[0]->pr ?></td>
		</tr>
		<tr>
			<td><label>Kode KBLI</label></td>
			<td><?= $kkpr[0]->kodekbli ?></td>
			<td><label>Judul KBLI</label></td>
			<td><?= $kkpr[0]->judulkbli ?></td>
		</tr>
		<tr>
			<td><label>Koefisien Dasar Bangunan maksimum</label></td>
			<td><?= $kkpr[0]->kdbmak ?></td>
			<td><label>Koefisien Lantai Bangunan maksimum</label></td>
			<td><?= $kkpr[0]->klbmak ?></td>
		</tr>
		<tr>
			<td><label>Indikasi Program Pemanfaatan Ruang</label></td>
			<td><?= $kkpr[0]->ippr ?></td>
			<td><label>Persyaratan Pelaksanaan Kegiatan Pemanfaatan Ruang</label></td>
			<td><?= $kkpr[0]->ppkpr ?></td>
		</tr>
		<tr>
			<td><label>Garis Sempadan Bangunan minimum</label></td>
			<td><?= $kkpr[0]->gsbmin ?></td>
			<td><label>Jarak Bebas Bangunan minimum</label></td>
			<td><?= $kkpr[0]->jbbmin ?></td>
		</tr>
		<tr>
			<td><label>Koefisien Dasar Hijau minimum</label></td>
			<td><?= $kkpr[0]->kdhmin ?></td>
			<td><label>Koefisien Tapak Basement minimum</label></td>
			<td><?= $kkpr[0]->ktbmin ?></td>
		</tr>
		<tr>
			<td><label>Jaringan Utilitas Kota</label></td>
			<td><?= $kkpr[0]->juk ?></td>
			<td><label>Status Input Data</label></td>
			<td class="text-bold"><?= $kkpr[0]->statuskkpr ?></td>
		</tr>
		<tr>
			<th colspan="4">II. Data Pengguna Sirame PKKPR</th>
		</tr>
		<tr>
			<td><label>Nomor KTP</label></td>
			<td><?= $kkpr[0]->noktp ?></td>
			<td><label>Nama Lengkap</label></td>
			<td><?= $kkpr[0]->namapemohon ?></td>
		</tr>
		<tr>
			<td><label>Email</label></td>
			<td><?= $kkpr[0]->email ?></td>
			<td><label>Nomor Handphone</label></td>
			<td><?= $kkpr[0]->hp ?></td>
		</tr>
		<tr>
			<td><label>Pekerjaan</label></td>
			<td><?= $kkpr[0]->pekerjaan ?></td>
			<td><label>Kewarganegaraan</label></td>
			<td><?= $kkpr[0]->wn ?></td>
		</tr>
		<tr>
			<td><label>Provinsi</label></td>
			<td><?= read($kkpr[0]->id_prov,'provinsi','id_prov')[0]->nama_prov; ?></td>
			<td><label>Kabupaten/Kota</label></td>
			<td><?= read($kkpr[0]->kotapemohon,'kota','id_kota')[0]->nama_kota; ?></td>
		</tr>
		<tr>
			<td><label>Kecamatan</label></td>
			<td><?= read($kkpr[0]->kecpemohon,'kecamatan','id_kec')[0]->nama_kec; ?></td>
			<td><label>Kode Pos</label></td>
			<td><?= $kkpr[0]->kodepos ?></td>
		</tr>
		<tr>
			<td><label>Alamat</label></td>
			<td colspan="3"><?= $kkpr[0]->alamat ?></td>
		</tr>
	</table>


<table id = 'table' width="auto">
	<tr>
		<td>
			<p style="text-align: right; font-size: 12px">
				Kabupaten Bekasi, <?= onlydate($kkpr[0]->tglterbit) ?><br><br>
				KEPALA DINAS DPMPTSP<br>
				KABUPATEN BEKASI<br><br><br><br><br><br>
				[Nama Lengkap]<br>
				NIP.
			</p>
		</td>
	</tr>
</table>
</body>
</html>
