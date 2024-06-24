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
								Rekam Medis
							</p>
							<h2 class="font-bold tracking-tighter text-2xl text-theme-text">
								<?=$title?>
							</h2>
						</div>
					</div>
					<div class="card bg-white p-5 mt-4 border rounded-md w-full relative">
						<div class="w-full bg-gray-100 p-3 rounded-md mb-5">
							<h4 class="font-bold text-sm">Riwayat Data Pasien</h4>
							<hr>
						</div>
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
					</div>
					<div class="card bg-white p-5 mt-4 border rounded-md w-full relative">
						<div class="w-full bg-gray-100 p-3 rounded-md mb-5 flex justify-between">
							<div>
								<h4 class="font-bold text-sm">Riwayat Pemeriksaan</h4>
							</div>
							
						</div>
						<?php foreach ($history_pemeriksaan as $key => $item): ?>
							<div class="mt-4">
								<div class="bg-blue-100 p-2">
									<div class="flex justify-between content-center">
										<div class="align-middle">
											<b class="text-xs">Tanggal : <?=$item->created_at?> </b>
										</div>
										<div>
											<a href="<?=base_url('rekam-medis/cetak-pemeriksaan/'.$item->id)?>" class="text-white bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 me-2">
												<svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
													<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/>
												</svg>
												Cetak Rekam Medis
											</a>
										</div>
									</div>
									<div class="grid grid-cols-1 gap-2">
										<div class="grid grid-cols-2 gap-4">
											<div class="card bg-white p-5 mt-4 border rounded-md w-full relative">
												<div class="w-full bg-gray-100 p-3 rounded-md mb-5">
													<h4 class="font-bold text-sm">Assesmen Awal</h4>
													<hr>
												</div>
												<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
													<tbody class="border p-4 w-full">
														<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
															<td width="20%" class="p-4">Keluhan Utama</td>
															<td width="1%">:</td>
															<td class="font-bold"><?=$item->keluhan_utama?></td>
														</tr>
													</tbody>
													<tbody class="border p-4 w-full">
														<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
															<td width="20%" class="p-4">Riwayat Penyakit Sekarang</td>
															<td width="1%">:</td>
															<td class="font-bold"><?=$item->riwayat_penyakit_sekarang?></td>
														</tr>
													</tbody>
													<tbody class="border p-4 w-full">
														<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
															<td width="20%" class="p-4">Riwayat Penyakit Dahulu</td>
															<td width="1%">:</td>
															<td class="font-bold"><?=$item->riwayat_penyakit_dahulu?></td>
														</tr>
													</tbody>
													<tbody class="border p-4 w-full">
														<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
															<td width="20%" class="p-4">Riwayat Pengobatan</td>
															<td width="1%">:</td>
															<td class="font-bold"><?=$item->riwayat_pengobatan?></td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="card bg-white p-5 mt-4 border rounded-md w-full relative">
												<div class="w-full bg-gray-100 p-3 rounded-md mb-5">
													<h4 class="font-bold text-sm">Pemeriksaan Fisik</h4>
													<hr>
												</div>
												<div class="col-span-1 w-full">
													<div class="grid grid-cols-2 gap-2">
														<div class="relative overflow-x-auto">
															<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
																<tbody class="border p-4 w-full">
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Tekanan Darah</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->tekanan_darah?> mmhg</td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Nadi</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->nadi?> x/menit</td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Suhu</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->suhu?>  C</td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">RR</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->rr?> x/menit</td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Tinggi Badan</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->tinggi_badan?> cm</td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Berat Badan</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->berat_badan?> kg</td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Status Psikologis</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->status_psikologis?></td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Skala Nyeri</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->skala_nyeri?></td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Tingkat Kesadaran</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->tingkat_kesadaran?></td>
																	</tr>
																</tbody>
															</table>
														</div>
														<div class="relative overflow-x-auto">
															<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
																<tbody class="border p-4 w-full">
																	
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Kulit</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->kulit?></td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Kepala</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->kepala?></td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Thorax</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->thorax?></td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Abdomen</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->abdomen?></td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Genetalia</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->genetalia?></td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Ekstremitas Atas</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->ekstremitas_atas?></td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Ekstremitas Bawah</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->ekstremitas_bawah?></td>
																	</tr>
																	<tr class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white border">
																		<td width="20%" class="p-4">Spine</td>
																		<td width="1%">:</td>
																		<td class="font-bold"><?=$item->spine?></td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php 
											$diagnosa = $this->Apotek_model->historyRekamMedis($item->id);
										?>
										<div class="card bg-white p-5 mt-4 border rounded-md w-full relative">
											<div class="grid grid-cols-2 gap-3">
												<div class="flex">
													<label for="" class="block mb-2 w-1/2 text-sm font-semibold text-gray-900">Diagnosa Code</label>
													<input type="text" readonly value="<?=$diagnosa->diganosa_utama_code?>" placeholder="Masukkan No. Rekam Medis" name="no_rm" id="no_rm" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
												</div>
												<div class="flex">
													<label for="" class="block mb-2 w-1/2 text-sm font-semibold text-gray-900">Diagnosa Utama</label>
													<input type="text" readonly value="<?=$diagnosa->diganosa_utama_name?>" placeholder="Masukkan No. Rekam Medis" name="no_rm" id="no_rm" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
												</div>
												<div class="flex">
													<label for="" class="block w-1/2 mb-2 text-sm font-semibold text-gray-900">Kondisi Pulang</label>
													<div class="w-full">
														<select id="kasus" disabled name="kasus" class="bg-gray-100 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
															<option value="Kasus Lama" <?=$diagnosa->kondisi_pulang == 'rawat jalan' ? "selected" : ""?>>Rawat Jalan</option>
															<option value="Kasus Baru" <?=$diagnosa->kondisi_pulang == 'dirujuk' ? "selected" : ""?>>Dirujuk</option>
															
														</select>
													</div>
												</div>
												<div class="flex">
													<label for="" class="block w-1/2 mb-2 text-sm font-semibold text-gray-900">Kasus</label>
													<div class="w-full">
														<select id="kasus" disabled name="kasus" class="bg-gray-100 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
															<option value="Kasus Lama" <?=$diagnosa->kasus == 'Kasus Lama' ? "selected" : ""?>>Kasus Lama</option>
															<option value="Kasus Baru" <?=$diagnosa->kasus == 'Kasus Baru' ? "selected" : ""?>>Kasus Baru</option>
															
														</select>
													</div>
												</div>
												<div class="flex">
													<label for="" class="block mb-2 w-1/2 text-sm font-semibold text-gray-900">Catatan Lain</label>
													<textarea id="message" readonly rows="4" name="catatan" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tidak ada catatan..."><?=$diagnosa->catatan?></textarea>
												</div>
												
												
												<?php
													$diagnosa_sekunder = $this->Apotek_model->getRekamDiagnosaByRekamId($diagnosa->id);
													$obat = $this->Apotek_model->getRekamObatByRekamId($diagnosa->id);
												?>
												<div class="flex">
													<label for="" class="block mb-2 w-1/2 text-sm font-semibold text-gray-900">Diagnosa Sekunder</label>
													<textarea id="message" readonly rows="4" name="catatan" class="block p-2.5 
														w-full text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 
														focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
														dark:text-white dark:focus:ring-blue-500 
														dark:focus:border-blue-500" placeholder="Tidak ada diagnosa lain"><?php foreach ($diagnosa_sekunder as $key => $value) { echo $value->name.'-'.$value->code.',';}?></textarea>
												</div>
												<div class="flex">
													<label for="" class="block mb-2 w-1/2 text-sm font-semibold text-gray-900">Obat</label>
													<textarea id="message" readonly rows="4" name="catatan" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-100 
														rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
														dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."><?php foreach ($obat as $key => $value) { echo 'Obat: '.$value->name.' - Qty : '.$value->qty.',';}?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
						
					</div>
				</section>
			</div>
		</div>
	</body>
	<?php $this->load->view("template/_partials/script") ?>
	
</html>
