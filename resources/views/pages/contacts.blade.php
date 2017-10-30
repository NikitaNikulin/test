@extends('layouts.app')
@section('content')
	<?php $contacts = $adminVars->contacts ?>
    <section class="contacts">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
	                {!! Breadcrumbs::render('pages.show', 'Контакты') !!}
                    <div class="con_info">
                        <h4>Наши Контакты</h4>
                        <ul>
	                        @if($contacts->vk_url)
		                        <li><a href="{{ $contacts->vk_url }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
	                        @endif
	                        @if($contacts->facebook_url)
		                        <li><a href="{{ $contacts->facebook_url }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
	                        @endif
	                        @if($contacts->ok_url)
		                        <li><a href="{{ $contacts->ok_url }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
	                        @endif
	                        @if($contacts->skype)
		                        <li><a href="{{ $contacts->skype }}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
	                        @endif
                        </ul>
                    </div>
                </div>
	            @if(count($contacts->phone))
	                <div class="con_tel col-md-7 col-sm-8">
	                    <b>Телефон:</b>
		                @foreach($contacts->phone as $k => $phone)
		                    <a href="tel: {{ $phone }}">{{ $phone }}</a>
			                @if(count($contacts->phone) != $k + 1) , @endif
						@endforeach
	                </div>
	            @endif
	            @if($contacts->email)
	                <div class="con_mail col-md-5 col-sm-4">
	                    <b>E-Mail:</b> <a href="#">{{ $contacts->email }}</a>
	                </div>
	            @endif
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
    <section class="contact-map">
	    @include('admin.maps._googleMap', [$instance = $contacts, $type = 'static', $size = ['100%', '590px']])
    </section>
@endsection