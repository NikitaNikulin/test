@if(array_get($user, 'activated') == 1)
	Здравствуйте, {{ array_get($user, 'name') }}, сбросьте ваш пароль, перейдя по ссылке: <br>
	<h3><a href="{{ url('password/reset/'.$token) }}">{{ url('password/reset/'.$token) }}</a></h3>
@elseif(array_get($user, 'activated') == 0)
	<p>Здравствуйте,</p>
	<p style="margin-top: 40px">Мы рады сообщить Вам о создании Вашего аккаунта на сайте <a href="{{ route('home') }}">js.kg</a>!</p>
	<p style="margin-top: 40px">Для активации аккаунта перейдите по ссылке ниже.</p>
	<p style="margin-top: 40px"><a href="{{ route('password.reset', [$token, 'email' => array_get($user, 'email')]) }}" style="border:1px solid #5B9BD5;line-height: 35px;display: inline-block;padding: 0 50px;border-radius: 5px;color: #fff;background-color: #5B9BD5;
    text-decoration: none;">Активировать</a><p>
	<p style="margin-top: 40px">Если у вас возникли вопросы по регистрации, мы будем рады на них ответить.</p>
	<div style="margin-top: 40px">
		<p>С уважением,</p>
		<p>Команда <a href="{{ route('home') }}">js.kg</a></p>
	</div>
@endif