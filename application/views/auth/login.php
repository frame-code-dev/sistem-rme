<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
        <!-- css -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
		<!-- Scripts -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    </head>
    <body class="text-gray-900 antialiased">
		<section class="bg-gray-100 dark:bg-gray-900 h-screen">
			<div class="grid grid-cols-1 lg:grid-cols-2">
				<div class="relative flex flex-col justify-start overflow-hidden p-4 bg-white dark:bg-gray-800 sm:p-6 lg:p-8 h-screen space-y-4">
					<div class="flex justify-center content-start self-start mt-10">
						<div>
							<img src="<?=base_url('public/assets/logo-1.png')?>" class="mx-auto align-" alt="">
						</div>
					
					</div>
					<div class="text-center">
						<h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Selamat datang</h1>
						<h5 class="mb-8 text-lg font-medium text-gray-500 md:text-5xl lg:text-6xl dark:text-gray-400">Puskesmas Kalisat Jember</h5>
					</div>
					<img src="<?=base_url('public/assets/bag.jpg')?>" class="w-fit h-fit rounded border border-2 border-gray-300 mx-auto align-" alt="">
				</div>
				<div class="relative flex flex-col justify-center overflow-hidden p-4 bg-blue-100 dark:bg-gray-800 sm:p-6 lg:p-8 h-screen space-y-4">
						<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
							<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
								Silahkan masuk ke akun anda
							</h1>
							<form class="space-y-4 md:space-y-6" action="#" method="POST">
								<?php if($this->session->flashdata('message_login_error')): ?>
									<div class="text-red-500 text-sm">
											<?= $this->session->flashdata('message_login_error') ?>
									</div>
								<?php endif ?>
								<div>
									<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
									<input type="text" id="username" name="username" value="<?= set_value('username') ?>" class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Username" required="">
									<div class="text-red-500 text-sm">
										<?= form_error('username') ?>
									</div>
								</div>
								<div>
									<label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
									<input type="password" id="password" value="<?= set_value('password') ?>" name="password" placeholder="Masukkan Password" class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 focus:bg-white block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
									<div class="text-red-500 text-sm">
										<?= form_error('password') ?>
									</div>
								</div>
								<div class="flex items-center justify-between">
									<div class="flex items-start">
										<div class="flex items-center h-5">
											<input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 focus:bg-white dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required="">
										</div>
										<div class="ml-3 text-sm">
											<label for="remember" class="text-gray-500 dark:text-gray-300">Ingat saya</label>
										</div>
									</div>
								</div>
								<button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-4 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign in</button>
							</form>
						</div>
				</div>
			</div>
			<!-- <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
				<a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
					<img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
					Flowbite    
				</a>
				<div class="w-1/2 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
					<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
						<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
							Sign in to your account
						</h1>
						<form class="space-y-4 md:space-y-6" action="#">
							<div>
								<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
								<input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
							</div>
							<div>
								<label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
								<input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
							</div>
							<div class="flex items-center justify-between">
								<div class="flex items-start">
									<div class="flex items-center h-5">
										<input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required="">
									</div>
									<div class="ml-3 text-sm">
										<label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
									</div>
								</div>
								<a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Forgot password?</a>
							</div>
							<button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign in</button>
							<p class="text-sm font-light text-gray-500 dark:text-gray-400">
								Don’t have an account yet? <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Sign up</a>
							</p>
						</form>
					</div>
				</div>
			</div> -->
		</section>
    </body>
</html>
