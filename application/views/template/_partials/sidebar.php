<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-black-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
	<div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
		<div class="flex items-center mb-4">
			<div>
				<img src="<?=$current_user->avatar != null ? $current_user->avatar : "https://flowbite.com/docs/images/examples/image-1@2x.jpg"?>" class="w-20 h-20 rounded-full" alt="">
			</div>
			<div class="ms-4">
				<h4 class="font-bold text-lg"><?=$current_user->nama?></h4>
				<p class="text-xs"><?=$current_user->username?></p>
			</div>
		</div>
		<hr>
		<ul class="space-y-3 font-medium mt-5">
			<li>
				<a href="<?=base_url('dashboard')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
				<svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
					<path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
					<path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
				</svg>
				<span class="ms-3 text-sm">Dashboard</span>
				</a>
			</li>
			<hr>
			<!-- Hak akses petugas pendaftaran -->
			<!-- 1. Data master pasien
			2. Pendaftaran pasien
			3. laporan kunjungan

			Hak akses dokter
			1. Pemeriksaan
			2. Rekam medis
			3. laporan 10 besar penyakit

			Hak akses apoteker
			1. Apotek
			2. Data master obat
			3. Laporan obat

			Hak akses kepala puskesmas
			1. Laporan kunjungan
			2. Laporan 10 besar penyakit
			3. Laporan obat -->
			<?php
				if ($current_user->role != 'kepala') {?>
					<li>
						<button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-900 dark:hover:bg-gray-700" aria-controls="master-data" data-collapse-toggle="master-data">
							<svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
								<path fill-rule="evenodd" d="M6 5a2 2 0 0 1 2-2h4.157a2 2 0 0 1 1.656.879L15.249 6H19a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2v-5a3 3 0 0 0-3-3h-3.22l-1.14-1.682A3 3 0 0 0 9.157 6H6V5Z" clip-rule="evenodd"/>
								<path fill-rule="evenodd" d="M3 9a2 2 0 0 1 2-2h4.157a2 2 0 0 1 1.656.879L12.249 10H3V9Zm0 3v7a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-7H3Z" clip-rule="evenodd"/>
							</svg>
							  <span class="flex-1 text-sm ms-3 text-left rtl:text-right whitespace-nowrap">Master Data</span>
							  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
								 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
							  </svg>
						</button>
						<ul id="master-data" class=" py-2 space-y-2 bg-gray-100 rounded mt-3 hidden">
							<?php
								if ($current_user->role == 'admin') {?>
									<li class="">
										<a href="<?=base_url('user') ?>" class="text-sm flex items-center w-full p-2 text-gray-900 transition duration-75 pl-4 group hover:bg-gray-200 dark:text-gray-900 dark:hover:bg-gray-700">
											<svg class="w-4 h-4 text-gray-900 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
												<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
											</svg>
											Data User
										</a>
									</li>
							<?php } ?>
							<?php
								if ($current_user->role == 'rm' || $current_user->role == 'admin' || $current_user->role == 'dokter') {?>
								<li>
									<a href="<?=base_url('pasienlist')?>" class="text-sm flex items-center w-full p-2 text-gray-900 transition duration-75 pl-4 group hover:bg-gray-200 dark:text-gray-900 dark:hover:bg-gray-700">
									<svg class="w-4 h-4 text-gray-900 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
										<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
									</svg>
									Data Pasien
								</a>
								</li>
							<?php
							} ?>
							<?php
								if ($current_user->role == 'perawat' || $current_user->role == 'admin') {?>
								<li>
									<a href="<?=base_url('obat')?>" class="text-sm flex items-center w-full p-2 text-gray-900 transition duration-75 pl-4 group hover:bg-gray-200 dark:text-gray-900 dark:hover:bg-gray-700">
										<svg class="w-4 h-4 text-gray-900 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
											<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
										</svg>
										Data Obat
									</a>
								</li>
								
								<?php
							} ?>
						  
						</ul>
					</li>
					<hr>
			<?php } ?>
			<?php
				if ($current_user->role == 'rm' || $current_user->role == 'admin') {?>
				<li>
					<a href="<?=base_url('pasien')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
					<svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h4M9 3v4a1 1 0 0 1-1 1H4m11 6v4m-2-2h4m3 0a5 5 0 1 1-10 0 5 5 0 0 1 10 0Z"/>
					</svg>
					<span class="ms-3 text-sm">Pendaftaran</span>
					</a>
				</li>
				<hr>
			<?php } ?>	
			<?php
				if ($current_user->role == 'dokter' || $current_user->role == 'admin') {?>
					<li>
						<a href="<?=base_url('rekam-medis')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
						<svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a28.076 28.076 0 0 1-1.091 9M7.231 4.37a8.994 8.994 0 0 1 12.88 3.73M2.958 15S3 14.577 3 12a8.949 8.949 0 0 1 1.735-5.307m12.84 3.088A5.98 5.98 0 0 1 18 12a30 30 0 0 1-.464 6.232M6 12a6 6 0 0 1 9.352-4.974M4 21a5.964 5.964 0 0 1 1.01-3.328 5.15 5.15 0 0 0 .786-1.926m8.66 2.486a13.96 13.96 0 0 1-.962 2.683M7.5 19.336C9 17.092 9 14.845 9 12a3 3 0 1 1 6 0c0 .749 0 1.521-.031 2.311M12 12c0 3 0 6-2 9"/>
						</svg>
						<span class="ms-3 text-sm">Rekam Medis</span>
						</a>
					</li>
					<hr>
			
			<?php } ?>
			<?php
				if ($current_user->role == 'perawat' || $current_user->role == 'admin') {?>
					<li>
						<a href="<?=base_url('apotek')?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
						<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/>
						</svg>
						<span class="ms-3 text-sm">Apotek</span>
						</a>
					</li>
					<hr>
				<?php
			} ?>	
			<li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-900 dark:hover:bg-gray-700" aria-controls="laporan" data-collapse-toggle="laporan">
					<svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z"/>
					</svg>

                      <span class="flex-1 text-sm ms-3 text-left rtl:text-right whitespace-nowrap">Laporan</span>
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                      </svg>
                </button>
                <ul id="laporan" class=" py-2 space-y-2 bg-gray-100 rounded mt-3 hidden">
					<?php
						if ($current_user->role == 'rm' || $current_user->role == 'admin' || $current_user->role == 'kepala') {?>
							<li class="">
								<a href="<?=base_url('laporan/kunjungan')?>" class="text-sm flex items-center w-full p-2 text-gray-900 transition duration-75 pl-4 group hover:bg-gray-200 dark:text-gray-900 dark:hover:bg-gray-700">
									<svg class="w-4 h-4 text-gray-900 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
										<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
									</svg>
								Laporan Kunjungan
								</a>
							</li>
						<li>
							<a href="<?=base_url('laporan/kesakitan')?>" class="text-sm flex items-center w-full p-2 text-gray-900 transition duration-75 pl-4 group hover:bg-gray-200 dark:text-gray-900 dark:hover:bg-gray-700">
								<svg class="w-4 h-4 text-gray-900 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
								</svg>
								Laporan Kesakitan
							</a>
						</li>
					<?php
					} ?>
					<?php
						if ($current_user->role == 'dokter' || $current_user->role == 'admin' || $current_user->role == 'kepala') {?>
							<li>
								<a href="<?=base_url('laporan/penyakit')?>" class="text-sm flex items-center w-full p-2 text-gray-900 transition duration-75 pl-4 group hover:bg-gray-200 dark:text-gray-900 dark:hover:bg-gray-700">
									<svg class="w-4 h-4 text-gray-900 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
										<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
									</svg>
									Laporan 10 Besar Penyakit
								</a>
							</li>
						<?php
					} ?>
					<?php
						if ($current_user->role == 'perawat' || $current_user->role == 'admin' || $current_user->role == 'kepala') {?>
						<li>
							<a href="<?=base_url('laporan/obat')?>" class="text-sm flex items-center w-full p-2 text-gray-900 transition duration-75 pl-4 group hover:bg-gray-200 dark:text-gray-900 dark:hover:bg-gray-700">
							<svg class="w-4 h-4 text-gray-900 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
							</svg>
							Laporan Obat
						</a>
						</li>
						<li>
							<a href="<?=base_url('laporan/kesakitan')?>" class="text-sm flex items-center w-full p-2 text-gray-900 transition duration-75 pl-4 group hover:bg-gray-200 dark:text-gray-900 dark:hover:bg-gray-700">
								<svg class="w-4 h-4 text-gray-900 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
									<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
								</svg>
								Laporan Kesakitan
							</a>
						</li>
					<?php } ?>
						
                </ul>
            </li>
			
		</ul>
	</div>
</aside>
