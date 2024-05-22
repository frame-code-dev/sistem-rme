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
                font-size: 13.5pt;
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
            <div class="col-md-8 mx-auto">
                <div class="content">
                    <h1 class="text-center p-0 m-0 fw-bold" style="font-size: 18px;">
                        <?=$title?> <br> POLI UMUM <br> TAHUN 2024
                    </h1>
					
                    <div class="mt-5">
                        <h4 class="fw-bold">Periode : <?=date('d M Y', strtotime($_GET['dari']))?> s/d <?=date('d M Y', strtotime($_GET['sampai']))?></h4>
                    </div>
                    <table id="customers">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Kunjungan</th>
                                <th>No.RM</th>
                                <th>Jenis Pasien</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data->list as $key => $item): ?>
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3"><?php echo $key + 1; ?></td>
                                    <td class="px-4 py-3"><?=date('d-m-Y', strtotime($item->created_at))?></td>
                                    <td class="px-4 py-3"><?=ucwords($item->no_rm)?></td>
                                    <td class="px-4 py-3"><?=ucwords($item->jenis_pasien)?></td>
                                    <td class="px-4 py-3"><?=ucwords($item->name)?></td>
                                    <td class="px-4 py-3"><?=ucwords($item->tanggal_lahir)?></td>
                                    <td class="px-4 py-3">
                                        <?= $item->jenis_kelamin == 'l' ?
                                            'Laki-laki' : ($item->jenis_kelamin == 'p' ? 'Perempuan' : 'Tidak diketahui') ?>
                                    </td>
                                    <td class="px-4 py-3"><?=ucwords($item->alamat)?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
					<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
						<tbody class="w-full">
							<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<td width="30%" class="p-2 fw-bold">Total Kunjungan</td>
								<td width="1%">:</td>
								<td class="font-bold"><?=$data->total_kunjungan?></td>
							</tr>
							<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<td width="30%" class="p-2 fw-bold">Jumlah Pasien Umum</td>
								<td width="1%">:</td>
								<td class="font-bold"><?=$data->total_umum_l + $data->total_umum_p?></td>
							</tr>
							<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<td width="30%" class="p-2">Laki-Laki</td>
								<td width="1%">:</td>
								<td class="font-bold"><?=$data->total_umum_l?></td>
                            </tr>
							<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<td width="30%" class="p-2">Perempuan</td>
								<td width="1%">:</td>
								<td class="font-bold"><?=$data->total_umum_p?></td>
							</tr>
							<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<td width="30%" class="p-2 fw-bold">Jumlah Pasien BPJS</td>
								<td width="1%">:</td>
								<td class="font-bold"><?=$data->total_bpjs_l + $data->total_bpjs_p?></td>
							</tr>
							<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<td width="30%" class="p-2">Laki-Laki</td>
								<td width="1%">:</td>
								<td class="font-bold"><?=$data->total_bpjs_l?></td>
							</tr>
							<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<td width="30%" class="p-2">Perempuan</td>
								<td width="1%">:</td>
								<td class="font-bold"><?=$data->total_bpjs_p?></td>
							</tr>
							<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<td width="30%" class="p-2 fw-bold">Jumlah Pasien Baru</td>
								<td width="1%">:</td>
								<td class="font-bold"><?=$data->total_pasien_baru_l + $data->total_pasien_baru_p?></td>
							</tr>
							<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<td width="30%" class="p-2">Laki-Laki</td>
								<td width="1%">:</td>
								<td class="font-bold"><?=$data->total_pasien_baru_l?></td>
							</tr>
							<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<td width="30%" class="p-2">Perempuan</td>
								<td width="1%">:</td>
								<td class="font-bold"><?=$data->total_pasien_baru_p?></td>
							</tr>
							<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<td width="30%" class="p-2 fw-bold">Jumlah Pasien Lama</td>
								<td width="1%">:</td>
								<td class="font-bold"><?=$data->total_pasien_lama_l + $data->total_pasien_lama_p?></td>
							</tr>
							<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<td width="30%" class="p-2">Laki-Laki</td>
								<td width="1%">:</td>
								<td class="font-bold"><?=$data->total_pasien_lama_l?></td>
							</tr>
							<tr class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<td width="30%" class="p-2">Perempuan</td>
								<td width="1%">:</td>
								<td class="font-bold"><?=$data->total_pasien_lama_p?></td>
							</tr>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </body>
    <?php
		$name = $title. '.xls';
		header("Content-Type: application/xls");
		header("Content-Disposition: attachment; filename=$name");
	?>
</html>
