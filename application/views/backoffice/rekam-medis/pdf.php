<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Cetak PDF</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrap css-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- fontawesome  -->
        <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <title>Document</title>
        <style>
            body {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                background-color: #FAFAFA;
                font-family: 'Tinos', serif;
                font: 12pt;
            }
            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }
            p, table, ol{
                font-size: 12px;
            }
            #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            #customers td, #customers th {
            border: 1px solid #424745;
            padding: 8px;
            }

            /* #customers tr:nth-child(even){background-color: #424745;} */

            #customers tr:hover {background-color: #ddd;}

            #customers th {
            padding-top: 5px;
            padding-bottom: 5px;
            text-align: left;
            /* background-color: #424745; */
            }
            @page {
                size: A4;
                margin-top: 0;
                margin-left: 75px;
                margin-bottom: 0;
                margin-right: 75px;
            }
            @media print {
                * {
                    -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
                    color-adjust: exact !important;                 /*Firefox*/     /*Firefox*/
                }
                html, body {
                    width: 210mm;
                    height: 297mm;
                }
                .no-print, .no-print *
                {
                    display: none !important;
                }
            /* ... the rest of the rules ... */
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="d-flex justify-content-between mt-4">
                    <div class="align-items-end p-0">
                        <img src="<?=base_url('public/assets/logo-2.png')?>" class="img-fluid me-auto" width="120" alt="">
                    </div>
                    <div class="align-self-center p-0 ">
                        <div class="row">
                            <div class="col-md-12 me-auto ">
                                <h1 class="text-center p-0 m-0 mt-2" style="font-size: 18px; letter-spacing: 0.4ch">DINAS KESEHATAN<br>
                                </h1>
                                
                                <h1 class="text-center p-0 m-0 fw-bold mt-2" style="font-size: 18px;">
									UPTD PUSKESMAS KALISAT
                                </h1>
                                <h5 class="text-center p-0 m-0 mt-2" style="font-size: 16px">Alamat Jl. M. Arifin No. 3 Kalisat Telp. (0331) 593096
								 <br> Kode Pos 68193</h5>
								<h1 class="text-center p-0 m-0 fw-bold mt-2" style="font-size: 18px;">
                                    JEMBER
                                </h1>

                            </div>
                        </div>
                    </div>
					<div class="align-items-end p-0">
						<img src="<?=base_url('public/assets/logo-1.png')?>" class="img-fluid me-auto" width="120" alt="">
					</div>
                </div>
            </div>
        </div>
        <hr color="black">
		<div class="d-flex justify-content-center">
			<a href="<?=base_url('rekam-medis')?>" class="btn btn-primary no-print"></i> Kembali</a>
		</div>
        <div class="row">
			<div class="mt-4">
				<div class="w-full bg-gray-100 rounded-md">
				<div class="relative overflow-x-auto">
							<table class="w-100 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
								<tbody class="border p-4 w-full">
									<tr>
									<td colspan="5"><h4 class="fw-bold text-sm text-center mt-2" style="font-size: 18px;"><?=$title?></h4></td>
									</tr>
									<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
										<td width="30%" class="border px-3">Tanggal Pemeriksaan</td>
										<td class="font-bold px-3"><?=$data->created_at?></td>
									</tr>
									<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
										<td width="30%" class="border px-3">No. RM</td>
										<td class="font-bold px-3"><?=$data->no_rm?> </td>
									</tr>
									<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
										<td width="30%" class="border px-3">Nama Pasien</td>
										<td class="font-bold px-3"><?=$data->name?> </td>
									</tr>
									<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
										<td width="30%" class="border px-3">NIK</td>
										<td class="font-bold px-3"><?=$data->nik?></td>
									</tr>
									<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
										<td width="30%" class="border px-3">Tanggal Lahir</td>
										<td class="font-bold px-3 "><?=$data->tanggal_lahir?> </td>
									</tr>
									<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
										<td width="30%" class="border px-3">Jenis Kelamin</td>
										<td class="font-bold px-3 "><?=$data->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan'?></td>
									</tr>
									<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
										<td width="30%" class="border px-3">Alamat</td>
										<td class="font-bold px-3 "><?=$data->alamat?></td>
									</tr>
									<tr>
										<td colspan="5"><h4 class="fw-bold text-sm text-center mt-2" style="font-size: 18px;">Pemeriksaan Fisik</h4></td>
									</tr>
									<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
										<td width="30%" class="border px-3">Keluhan Utama</td>
										<td class="font-bold px-3"><?=$data->keluhan_utama?> </td>
									</tr>
									<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
										<td width="30%" class="border px-3">Riwayat Penyakit Dahulu</td>
										<td class="font-bold px-3"><?=$data->riwayat_penyakit_dahulu?> </td>
									</tr>
									<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
										<td width="30%" class="border px-3">Riwayat Penyakit Sekarang</td>
										<td class="font-bold px-3"><?=$data->riwayat_penyakit_sekarang?>  </td>
									</tr>
									<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
										<td width="30%" class="border px-3">Riwayat Pengobatan</td>
										<td class="font-bold px-3"><?=$data->riwayat_pengobatan?></td>
									</tr>
									<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
										<td width="30%" class="border px-3">Riwayat Alergi</td>
										<td class="font-bold px-3 "><?=$data->text_riwayat_alergi != null ? $data->text_riwayat_alergi : '-'?></td>
									</tr>
									<tr>
										<td width="30%" class="border px-3">TB</td>
										<td class="font-bold px-3"><?=$data->berat_badan?> kg</td>
										<td width="30%" class="border px-3">TD</td>
										<td class="font-bold px-3 border"><?=$data->tekanan_darah?> mmhg</td>
										<td class="font-bold px-3">NADI</td>
										<td class="font-bold px-3 border"><?=$data->nadi?> x/menit</td>
									</tr>
									<tr>
										<td width="10%" class="border px-3">BB</td>
										<td class="font-bold px-3 border"><?=$data->berat_badan?> kg</td>
										<td width="10%" class="border px-3">SUHU</td>
										<td class="font-bold px-3 border"><?=$data->suhu?>  C</td>
										<td class="font-bold px-3 border">RR</td>
										<td class="font-bold px-3 border"><?=$data->rr?> x/menit</td>
									</tr>
									<?php 
										$diagnosa = $this->Apotek_model->historyRekamMedis($data->id);
										$diagnosa_sekunder = null;
										$obat = null;
									?>
									<?php if ($diagnosa != null) { ?>
										<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
											<td width="10%" class="border px-3">Diagnosa Utama</td>
											<td class="font-bold px-3 "><?=$diagnosa->diganosa_utama_name?></td>
										</tr>
										<?php
										
											$diagnosa_sekunder = $this->Apotek_model->getRekamDiagnosaByRekamId($diagnosa->id);
											$obat = $this->Apotek_model->getRekamObatByRekamId($diagnosa->id);
										?>
									<?php } ?> 
									<?php if ($diagnosa_sekunder != null || $obat != null) {?>
										<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
											<td width="10%" class="border px-3">Diagnosa Sekunder</td>
											<td class="font-bold px-3 " colspan="5"><?php foreach ($diagnosa_sekunder as $key => $value) { echo $value->name.'-'.$value->code.',';}?></td>
										</tr>
										<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white border">
											<td width="10%" class="border px-3">Obat yang diberikan </td>
											<td class="font-bold px-3 " colspan="5"><?php foreach ($obat as $key => $value) { echo 'Obat: '.$value->name.' - Qty : '.$value->qty.',';}?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							
						</div>
				</div>
			</div>
			
        </div>
		<div class="d-flex justify-content-end mt-3">
			<table>
				<tr>
					<td>Jember, <?=date('d m Y')?></td>
				</tr>
				<tr>
					<td class="text-center">Nama dan Tanda Tangan DPJP</td>
				</tr>
				<tr>
					<td class="p-5"></td>
				</tr>
				<tr>
					<td class=" text-center">……………………………….</td>
				</tr>
			</table>

		</div>
    </body>
    <script>
        print();
    </script>
</html>
