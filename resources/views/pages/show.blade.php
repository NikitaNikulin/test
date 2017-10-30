@extends('layouts.app')
@section('content')

    <section class="">
	    <div class="container">
		    {!! Breadcrumbs::render('pages.show', $page) !!}
		    <div class="row">
	            <h1>{{ $page->title }}</h1>
                <div class="col-md-9">
	                {!! $page->text !!}
                </div>
            </div>
        </div>
    </section>


@endsection