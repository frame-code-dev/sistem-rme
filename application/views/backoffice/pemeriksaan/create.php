
<!DOCTYPE html>
<html lang="">
    <head>
		<?php $this->load->view("template/_partials/head") ?>
    </head>
    <body class=" text-gray-900">
		
		<?php $this->load->view("template/_partials/topbar") ?>
		<?php $this->load->view("template/_partials/sidebar") ?>

		<div class="p-4 sm:ml-64">
			<div class="p-4 mt-14">
				<section class="p-5 overflow-y-auto">
					<div class="head lg:flex grid grid-cols-1 justify-between w-full">
						<div class="heading flex-auto">
							<p class="text-blue-950 font-sm text-xs">
								Pemeriksaan
							</p>
							<h2 class="font-bold tracking-tighter text-2xl text-theme-text">
								<?=$title?>
							</h2>
						</div>
						<div class="layout lg:flex grid grid-cols-1 lg:mt-0 mt-5 justify-end gap-5">
							<nav class="flex" aria-label="Breadcrumb">
								<ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
								<li class="inline-flex items-center">
									<a href="<?=base_url('dashboard')?>" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
									<svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
										<path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
									</svg>
									Dashboard
									</a>
								</li>
								<li>
									<div class="flex items-center">
									<svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
										<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
									</svg>
										<a href="<?=base_url('rekam-medis')?>" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"><?=$current_page?></a>
									</div>
								</li>
								<li aria-current="page">
									<div class="flex items-center">
									<svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
										<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
									</svg>
									<span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400"><?=$title?></span>
									</div>
								</li>
								</ol>
							</nav>
						</div>
					</div>
					<div class="card bg-white p-5 mt-4 border rounded-md w-full relative">
                        <b class="my-4">Data Pasien</b>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
							<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
								<tr>
									<th scope="col" class="px-4 py-3">No. RM</th>
									<th scope="col" class="px-4 py-3">NIK</th>
									<th scope="col" class="px-4 py-3">No. JKN</th>
									<th scope="col" class="px-4 py-3">Nama</th>
									<th scope="col" class="px-4 py-3">Tanggal Lahir</th>
									<th scope="col" class="px-4 py-3">JK</th>
									<th scope="col" class="px-4 py-3">Alamat</th>
								</tr>
							</thead>
							<tbody>
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3"><?=ucwords($pasien->no_rm)?></td>
                                    <td class="px-4 py-3"><?=ucwords($pasien->nik)?></td>
                                    <td class="px-4 py-3"><?=$pasien->no_jkn != null ? $pasien->no_jkn : '-'?></td>
                                    <td class="px-4 py-3"><?=ucwords($pasien->name)?></td>
                                    <td class="px-4 py-3"><?=ucwords($pasien->tanggal_lahir)?></td>
                                    <td class="px-4 py-3">
                                        <?= $pasien->jenis_kelamin == 'l' ?
                                            'Laki-laki' : ($pasien->jenis_kelamin == 'p' ? 'Perempuan' : 'Tidak diketahui') ?>
                                    </td>
                                    <td class="px-4 py-3"><?=ucwords($pasien->alamat)?></td>
                                </tr>
							</tbody>
						</table>
						<form action="<?=base_url('pemeriksaan/store')?>" method="POST" class="w-full mx-auto mt-4 space-y-4" enctype="multipart/form-data">
                            <input type="hidden" name="pasien_id" value="<?=$pasien->id?>">
                            <input type="hidden" name="id" value="<?=$current_pemeriksaan->id?>">
                            <div class="mt-5">
                                <b>Assesmen Awal</b>
                            </div>
							<div class="grid grid-cols-2 gap-3">
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Keluhan Utama<span class="me-2 text-red-500">*</span></label>
									<input type="text" placeholder="Masukkan disini..." name="keluhan_utama" id="keluhan_utama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('keluhan_utama') ?>
									</div>
								</div>
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Riwayat Penyakit Sekarang<span class="me-2 text-red-500">*</span></label>
									<input type="text" placeholder="Masukkan disini..." name="riwayat_penyakit_sekarang" id="riwayat_penyakit_sekarang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('riwayat_penyakit_sekarang') ?>
									</div>
								</div>
                                <div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Riwayat Penyakit Dahulu<span class="me-2 text-red-500">*</span></label>
									<input type="text" placeholder="Masukkan disini..." name="riwayat_penyakit_dahulu" id="riwayat_penyakit_dahulu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('riwayat_penyakit_dahulu') ?>
									</div>
								</div>
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Riwayat Pengobatan<span class="me-2 text-red-500">*</span></label>
									<input type="text" placeholder="Masukkan disini..." name="riwayat_pengobatan" id="riwayat_pengobatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('riwayat_pengobatan') ?>
									</div>
								</div>
								<div>
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Riwayat Alergi <span class="me-2 text-red-500">*</span></label>
									<select id="riwayat_alergi" name="riwayat_alergi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
										<option value="0">Pilih Riwayat</option>
										<option value="tidak ada" >Tidak Ada</option>
										<option value="obat" >Obat</option>
										<option value="makanan" >Makanan</option>
										<option value="lain-lain" >Lain-Lain</option>
									</select>
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('riwayat_alergi') ?>
									</div>
								</div>
								<div>
									<div class="hidden" id="deskripsi_riwayat_alergi">
										<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Riwayat Alergi Deskripsi<span class="me-2 text-red-500">*</span></label>
										<textarea name="text_riwayat_alergi" id="text_riwayat_alergi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Deskripsi Riwayat Alergi"></textarea>
									</div>
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('text_riwayat_alergi') ?>
									</div>
								</div>
							</div>
                            <hr>
                            <div class="mt-5">
                                <b>Pemeriksaan Fisik</b>
                            </div>
							<div class="grid grid-cols-2 gap-3">
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Tekanan Darah<span class="me-2 text-red-500">*</span></label>
                                    <div class="flex">
                                        <input type="text" placeholder="Masukkan disini..." name="tekanan_darah" id="tekanan_darah" class="rounded-none bg-gray-50 block border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 border-e-0 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 rounded-r-md">
                                            mmhg
                                        </span>
                                    </div>
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('tekanan_darah') ?>
									</div>
								</div>
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nadi<span class="me-2 text-red-500">*</span></label>
                                    <div class="flex">
                                        <input type="text" placeholder="Masukkan disini..." name="nadi" id="nadi" class="rounded-none bg-gray-50 block border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 border-e-0 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 rounded-r-md">
                                            x/menit
                                        </span>
                                    </div>
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('nadi') ?>
									</div>
								</div>
                                <div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Suhu<span class="me-2 text-red-500">*</span></label>
                                    <div class="flex">
                                        <input type="text" placeholder="Masukkan disini..." name="suhu" id="suhu" class="rounded-none bg-gray-50 block border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 border-e-0 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 rounded-r-md">
                                            C
                                        </span>
                                    </div>
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('suhu') ?>
									</div>
								</div>
                                <div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">RR<span class="me-2 text-red-500">*</span></label>
                                    <div class="flex">
                                        <input type="text" placeholder="Masukkan disini..." name="rr" id="rr" class="rounded-none bg-gray-50 block border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 border-e-0 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 rounded-r-md">
                                            x/menit
                                        </span>
                                    </div>
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('rr') ?>
									</div>
								</div>
                                <div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Tinggi Badan<span class="me-2 text-red-500">*</span></label>
                                    <div class="flex">
                                        <input type="text" placeholder="Masukkan disini..." name="tinggi_badan" id="tinggi_badan" class="rounded-none bg-gray-50 block border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 border-e-0 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 rounded-r-md">
                                            cm
                                        </span>
                                    </div>
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('tinggi_badan') ?>
									</div>
								</div>
                                <div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Berat Badan<span class="me-2 text-red-500">*</span></label>
                                    <div class="flex">
                                        <input type="text" placeholder="Masukkan disini..." name="berat_badan" id="berat_badan" class="rounded-none bg-gray-50 block border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 border-e-0 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 rounded-r-md">
                                            kg
                                        </span>
                                    </div>
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('berat_badan') ?>
									</div>
								</div>
								<div>
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Status Psikologis <span class="me-2 text-red-500">*</span></label>
									<select id="status_psikologis" name="status_psikologis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
										<option value="0">Pilih Status</option>
										<option value="tidak ada" >Tidak Ada</option>
										<option value="cemas" >Cemas</option>
										<option value="takut" >Takut</option>
										<option value="marah" >Marah</option>
										<option value="sedih" >Sedih</option>
									</select>
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('status_psikologis') ?>
									</div>
								</div>
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Skala Nyeri<span class="me-2 text-red-500">*</span></label>
									<input type="number" min="0" max="10" placeholder="Masukkan disini..." name="skala_nyeri" id="skala_nyeri" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('skala_nyeri') ?>
									</div>
								</div>
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Tingkat Kesadaran<span class="me-2 text-red-500">*</span></label>
									<select id="tingkat_kesadaran" name="tingkat_kesadaran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
										<option value="0">Pilih Status</option>
										<option value="CM" >CM</option>
										<option value="Samnole" >Samnole</option>
										<option value="Stupor" >Stupor</option>
										<option value="Coma" >Coma</option>
									</select>
								</div>
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Kulit<span class="me-2 text-red-500">*</span></label>
									<input type="text" placeholder="Masukkan disini..." name="kulit" id="kulit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('kulit') ?>
									</div>
								</div>
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Kepala<span class="me-2 text-red-500">*</span></label>
									<input type="text" placeholder="Masukkan disini..." name="kepala" id="kepala" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('kepala') ?>
									</div>
								</div>
								
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Thorax <span class="me-2 text-red-500">*</span></label>
									<input type="text" placeholder="Masukkan disini..." name="thorax" id="thorax" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('thorax') ?>
									</div>
								</div>
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Abdomen <span class="me-2 text-red-500">*</span></label>
									<input type="text" placeholder="Masukkan disini..." name="abdomen" id="abdomen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('abdomen') ?>
									</div>
								</div>
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Genetalia <span class="me-2 text-red-500">*</span></label>
									<input type="text" placeholder="Masukkan disini..." name="genetalia" id="genetalia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('genetalia') ?>
									</div>
								</div>
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Ekstremitas Atas <span class="me-2 text-red-500">*</span></label>
									<input type="text" placeholder="Masukkan disini..." name="ekstremitas_atas" id="ekstremitas_atas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('ekstremitas_atas') ?>
									</div>
								</div>
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Ekstremitas Bawah <span class="me-2 text-red-500">*</span></label>
									<input type="text" placeholder="Masukkan disini..." name="ekstremitas_bawah" id="ekstremitas_bawah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('ekstremitas_bawah') ?>
									</div>
								</div>
								<div class="">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Spine<span class="me-2 text-red-500">*</span></label>
									<input type="text" placeholder="Masukkan disini..." name="spine" id="spine" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('spine') ?>
									</div>
								</div>

							</div>
							<div class="flex justify-end align-middle content-center bg-gray-100 p-3 rounded-md">
								<div>
									<button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Simpan</button>
								</div>
								<div>
									<button class="bg-white text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" type="reset">Batal</button>
								</div>

							</div>
						</form>
					</div>
				</section>
			</div>
		</div>
	</body>
	<?php $this->load->view("template/_partials/script") ?>
	<script>
		$(document).ready(function() {
			$('#riwayat_alergi').on('change', function() {
				let data = this.value;
				console.log(data);
				if (data == 'tidak ada' || data == '0') {
					$('#deskripsi_riwayat_alergi').addClass('hidden');
				} else {
					$('#deskripsi_riwayat_alergi').removeClass('hidden');
				}
			})
		});
	</script>

</html>
