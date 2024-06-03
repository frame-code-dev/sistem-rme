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
                font-size: 7pt;
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
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            /* background-color: #424745; */
            }
            @page {
				size: landscape;
            }
            @media print {
                * {
                    -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
                    color-adjust: exact !important;                 /*Firefox*/     /*Firefox*/
                }
                html, body {
					margin: 0;
					padding: 0;
					-webkit-print-color-adjust: exact;
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
            <div class="col-md-8 mx-auto mt-5">
                <div class="content">
                    <div class="d-flex justify-content-end">
                        <a href="<?=base_url('laporan/obat')?>" class="btn btn-primary no-print"></i> Kembali</a>
                    </div>
					<div class="mt-5">
						<h4 class="fw-bold">Periode : : <?=date('d M Y', strtotime($_GET['dari']))?> s/d <?=date('d M Y', strtotime($_GET['sampai']))?></h4>
					</div>
                    <div class="mt-5">
						<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
							<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
								<tr>
									<th class="px-4 py-3 border" rowspan="2">No</th>
									<th scope="col" class="p-2 text-xs border" rowspan="2">Tanggal</th>
									<th scope="col" class="p-2 text-xs border" colspan="2">Jumlah Kunjungan Baru</th>
									<th scope="col" class="p-2 text-xs border" colspan="2">Jumlah Kunjungan Lama</th>
									<th scope="col" class="p-2 text-xs border" colspan="2">Jumlah Rawat Jalan Baru ≥ 60 Tahun</th>
									<th scope="col" class="p-2 text-xs border" colspan="2">Jumlah Rawat Jalan Lama ≥ 60 Tahun</th>
									<th scope="col" class="p-2 text-xs border" colspan="2">Jumlah Pasien Umum</th>
									<th scope="col" class="p-2 text-xs border" colspan="2">Jumlah Pasien BPJS</th>
									<th scope="col" class="p-2 text-xs border" colspan="2">Jumlah Kasus Baru</th>
									<th scope="col" class="p-2 text-xs border" colspan="2">Jumlah Kasus Lama</th>
									<th scope="col" class="p-2 text-xs border" colspan="2">Jumlah Kunjungan Kasus Lama</th>
									<th scope="col" class="p-2 text-xs border" colspan="2">Jumlah Kunjungan Kasus Baru</th>
									<th scope="col" class="p-2 text-xs border" colspan="2">Jumlah Kunjungan Kasus</th>
								</tr>
								<tr>
									<th class="border p-2">L</th>
									<th class="border p-2">P</th>
									<th class="border p-2">L</th>
									<th class="border p-2">P</th>
									<th class="border p-2">L</th>
									<th class="border p-2">P</th>
									<th class="border p-2">L</th>
									<th class="border p-2">P</th>
									<th class="border p-2">L</th>
									<th class="border p-2">P</th>
									<th class="border p-2">L</th>
									<th class="border p-2">P</th>
									<th class="border p-2">L</th>
									<th class="border p-2">P</th>
									<th class="border p-2">L</th>
									<th class="border p-2">P</th>
									<th class="border p-2">L</th>
									<th class="border p-2">P</th>
									<th class="border p-2">L</th>
									<th class="border p-2">P</th>
									<th class="border p-2">L</th>
									<th class="border p-2">P</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $key => $value): ?>
									<tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
										<td class="border p-2 text-xs"><?=$key+1?></td>
										<td class="border p-2 text-xs"><?=date('d-m-Y', strtotime($value->tgl_daftar))?></td>
										<?php
											$dari = $this->input->get('dari');
											$sampai = $this->input->get('sampai');
											$jenis_kelamin = $this->input->get('jenis_kelamin');
											$jenis_pasien = $this->input->get('jenis_pasien');
								
											// create obj for filter
											$filter = new stdClass;
											if ($dari && $sampai) {
												$filter->dari = $dari;
												$filter->sampai = $sampai;
											}
										?>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKunjunganBaruL($filter,null,'L',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKunjunganBaruP($filter,null,'P',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKunjunganLamaL($filter,null,'L',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKunjunganLamaP($filter,null,'P',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKunjunganBaruUsiaL($filter,null,'L',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKunjunganBaruUsiaP($filter,null,'P',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKunjunganLamaUsiaL($filter,null,'L',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKunjunganLamaUsiaP($filter,null,'P',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienUmumL($filter,null,'l',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienUmumP($filter,null,'p',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienBpjsL($filter,null,'l',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienBpjsP($filter,null,'p',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKasusBaruL($filter,null,'l',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKasusBaruP($filter,null,'p',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKasusLamaL($filter,null,'l',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKasusLamaP($filter,null,'p',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKasusLamaL($filter,null,'l',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKasusLamaP($filter,null,'p',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKasusBaruL($filter,null,'l',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKasusBaruP($filter,null,'p',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKunjunganKasusL($filter,null,'l',$value->tgl_daftar)?></td>
										<td class="border p-2 text-xs"><?=$this->Laporan_model->pasienKunjunganKasusP($filter,null,'p',$value->tgl_daftar)?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
         print();
    </script>
</html>
