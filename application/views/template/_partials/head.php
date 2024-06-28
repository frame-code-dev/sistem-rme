<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?=SITE_NAME?></title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
<!-- css -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.tailwindcss.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
	.select2-container--default .select2-selection--single {
		border-radius: 0.35rem !important;
		border: 1px solid #d1d3e2;
		height: calc(1.95rem + 10px);
		background: #fff;
	}
	.select2-container {
		min-width: 100% !important;
	}

	.select2-container--default .select2-selection--single:hover,
	.select2-container--default .select2-selection--single:focus,
	.select2-container--default .select2-selection--single.active {
		box-shadow: none;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
		line-height: 40px;

	}

	.select2-container--default .select2-selection--multiple {
		border-color: #eaeaea;
		border-radius: 0;
	}

	.select2-dropdown {
		border-radius: 0;
	}

	.select2-container--default .select2-results__option--highlighted[aria-selected] {
		background-color: #3838eb;
	}

	.select2-container--default.select2-container--focus .select2-selection--multiple {
		border-color: #eaeaea;
		background: #fff;

	}
	.select2-container--default .select2-selection--single .select2-selection__arrow{
		top: 5px;
	}
</style>
<style>
	.justify-self-end  {
		display: flex;
		justify-content: end !important
	}
</style>
