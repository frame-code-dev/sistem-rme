
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
							<h2 class="font-bold tracking-tighter text-2xl text-theme-text">
								<?=$title?>
							</h2>
						</div>
					</div>
					<div class="card bg-white p-5 mt-4 border rounded-md w-full relative">
						<form action="<?=base_url('profile/update/'.$user->id)?>" method="POST" class="w-full mx-auto space-y-4" enctype="multipart/form-data">
							<div class="grid grid-cols-4 gap-3">
								<div class="col-span-2">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nama<span class="me-2 text-red-500">*</span></label>
									<input type="text" value="<?=$user->nama?>" placeholder="Masukkan Nama" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('nama') ?>
									</div>
								</div>
								<div class="col-span-2">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Username<span class="me-2 text-red-500">*</span></label>
									<input type="text" value="<?=$user->username?>" placeholder="Masukkan Username" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('username') ?>
									</div>
								</div>
								<div class="col-span-2">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Password<span class="me-2 text-red-500">*</span></label>
									<input type="text" placeholder="Masukkan Password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
									<span class="text-red-500 text-xs italic font-semibold">Kosongin jika tidak mengganti password</span>
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('password') ?>
									</div>
								</div>
								<div class="col-span-2">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Role<span class="me-2 text-red-500">*</span></label>
									<select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
										<option value="">Pilih Jenis Role</option>
										<option value="rm" <?=$user->role == "rm" ? "selected" : "" ?>>Rekam Medis</option>
										<option value="dokter" <?=$user->role == "dokter" ? "selected" : "" ?>>Dokter</option>
										<option value="admin" <?=$user->role == "admin" ? "selected" : "" ?>>Admin</option>
										<option value="perawat" <?=$user->role == "perawat" ? "selected" : "" ?>>Perawat</option>
										<option value="kepala" <?=$user->role == "kepala" ? "selected" : "" ?> >Kepala Puskesmas</option>

									</select>
									<div class="text-red-500 text-xs italic font-semibold">
										<?= form_error('role') ?>
									</div>
								</div>
								<div class="col-span-2">
									<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Avatar</label>
									<div>
										<figure class="max-w-lg">
											<img src="<?= $user->avatar != null ? $user->avatar : "https://flowbite.com/docs/images/examples/image-1@2x.jpg"?>" class="h-96 max-w-full rounded-lg photosPreview">
											<figcaption class="mt-2 text-sm text-start text-gray-500 dark:text-gray-400">Image Preview</figcaption>
										</figure>
									</div>
									<input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file_input" aria-describedby="file_input_help"
											id="file_input"
											type="file"
											name="file_input">
									<p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
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

</html>
