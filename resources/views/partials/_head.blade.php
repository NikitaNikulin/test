<head>
	<link rel="icon" href="/favicon.ico">
	<title>{{ isset($metatitle) && $metatitle ? $metatitle : config('sleeping_owl.title') }}</title>
    <meta name="description" content="{{ isset($metadesc) ? $metadesc : null }}">
    <meta name="keywords" content="{{ isset($metakeyw) ? $metakeyw : null }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">

    <link rel="stylesheet" href="{{ asset('libs/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('libs/alertifyjs/css/alertify.min.css') }}">
	<link rel="stylesheet" href="{{ asset('libs/alertifyjs/css/themes/bootstrap.min.css') }}">
	@yield('assets-css')
	<link rel="stylesheet" href="{{ asset('libs/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

    <!--[if IE 9]>
        <script>
            window.location = "packages/oldbrowser/index.html";
        </script>

        <script src="libs/oldbrowser/html5shiv/es5-shim.min.js"></script>
        <script src="libs/oldbrowser/html5shiv/html5shiv.min.js"></script>
        <script src="libs/oldbrowser/html5shiv/html5shiv-printshiv.min.js"></script>
        <script src="libs/oldbrowser/respond/respond.min.js"></script>
    <![endif]-->
</head>