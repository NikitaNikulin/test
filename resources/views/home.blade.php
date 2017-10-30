@extends('layouts.app')
{{--@section('assets-css')--}}
{{--<link rel="stylesheet" href="{{ asset('libs/bootstrap-multiselect/css/bootstrap-multiselect.css') }}">--}}
{{--@endsection--}}
{{--@section('assets-js')--}}
{{--<script src="{{ asset('libs/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>--}}
{{--@endsection--}}

@section('content')
	<section class="stashin">
		<div class="container">
			<div class="row">
				@TagBlock([$type = 'img', $var = $adminVars, $src = "adminEmail", $size = "230_230", $alt = $b_counter,
					$dp = "class=\"img-wrapper bugag1\" data-src=1231 data-responsive=4534"])
				@TagBlock([$type = "img", $var = $adminVars, $src = "path"])
				@TagBlock([$type = "img", $src = "/imf", $size = "130_130"])
				@TagBlock([$type = "img", $src = "/libs/bootstrap-datetimepicker/img/glyphicons-halflings.png", $size = "350_null", $mod = 'resize'])
			</div>
		</div>
	</section>
@endsection