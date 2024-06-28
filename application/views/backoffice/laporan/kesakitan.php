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
				<section class="p-5 overflow-y-auto mt-5">
					<div class="head lg:flex grid grid-cols-1 justify-between w-full">
						<div class="heading flex-auto">
							<p class="text-blue-950 font-sm text-xs">
								Laporan
							</p>
							<h2 class="font-bold tracking-tighter text-2xl text-theme-text">
								<?=$title?>
							</h2>
						</div>
					</div>
					<div class="card bg-white p-5 mt-4 border rounded-md w-full relative overflow-x-auto">
                        <b>Filter</b>
                        <form action="" method="get" class="w-full mx-auto space-y-4" enctype="multipart/form-data">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Dari<span class="me-2 text-red-500">*</span></label>
                                    <input type="text" placeholder="d-m-Y" name="dari" id="dari" datepicker datepicker-format="dd-mm-yyyy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?=isset($_GET['dari']) ? $_GET['dari'] : ''?>" autocomplete="off">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?= form_error('dari') ?>
                                    </div>
                                </div>
                                <div class="">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Sampai<span class="me-2 text-red-500">*</span></label>
                                    <input type="text" placeholder="d-m-Y" name="sampai" id="sampai" datepicker datepicker-format="dd-mm-yyyy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?=isset($_GET['sampai']) ? $_GET['sampai'] : ''?>" autocomplete="off">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?= form_error('sampai') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end align-middle content-center bg-gray-100 p-3 rounded-md">
                                <?php if (count($data) > 0): ?>
                                    <div>
                                        <a href="<?=base_url('laporan/kesakitan/pdf?dari='.$_GET['dari'].'&sampai='.$_GET['sampai'])?>" class="bg-white text-yellow-400 hover:text-yellow-600 border border-yellow-400 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-yellow-500 dark:text-yellow-500 dark:hover:text-white dark:hover:bg-yellow-600 dark:focus:ring-yellow-900" target="_blank" type="button">Cetak PDF</a>
                                    </div>
									<div>
                                        <a download="" href="<?=base_url('laporan/kesakitan/excel?dari='.$_GET['dari'].'&sampai='.$_GET['sampai'])?>" class="bg-white text-green-400 hover:text-green-600 border border-green-400 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-900" target="_blank" type="button">Cetak Excel</a>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Tampilkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php if (count($data) > 0): ?>
                        <div class="card bg-white p-5 mt-5 border rounded-md w-full relative overflow-x-auto">
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
											<td class="border p-2 text-xs"><?=date('d-m-Y', strtotime($value->created_at))?></td>
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
                    <?php endif; ?>
				</section>
			</div>
		</div>
	</body>
	<?php $this->load->view("template/_partials/script") ?>

</html>
