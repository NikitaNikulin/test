@if(Auth::check())
	<div class="dropdown gost">
		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			@TagBlock([$type = 'img', $var = Auth::user(), $src = "photo", $size = "30_30", $alt = Auth::user()->name])
			<span class="user-name">{{ Auth::user()->name }}</span>
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu user_drop" aria-labelledby="dropdownMenu1">
			<li><a class="gost-in" href="{{ route('profiles.show') }}">Личный кабинет</a></li>
			<li><a class="my_cart-in" href="">Моя корзина</a></li>
			<li role="separator" class="divider"></li>
			<li><a class="gost-out ajax_replace" href="{{ url('auth/logout') }}">Выйти</a></li>
		</ul>
	</div>
@else
	<a class="ajax_modal" href="" data-action="login" data-type="auth">Войти</a>
@endif


