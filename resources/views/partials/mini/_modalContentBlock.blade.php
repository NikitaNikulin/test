<div id="page-preloader"><span class="spinner"></span></div>
{{--<div id="page-preloader"><img src="{{ public_path('img/pre_loading.gif') }}" alt=""></div>--}}
<div class="modal-dialog" role="document">
	<div class="modal-content">

		@if($type == 'profile' && $action == 'update')
			<div class="mod_fix_log">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					{!! Form::open(['route' => ['profiles.update', $item->id], 'class' => 'ajax_form']) !!}
					@InputBlock([$type = "imageUpload", $item = 'image', $label = null, $var = $item])
					@InputBlock([$type = "input", $item = 'name', $label = null, $var = $item, $p = "placeholder=\"Имя\""])
					@InputBlock([$type = "input", $item = 'phone', $label = null, $var = $item, $p = "placeholder=\"Телефон\""])
					@InputBlock([$type = "input", $item = 'address', $label = null, $var = $item, $p = "placeholder=\"Адрес\""])
					@InputBlock([$type = "input", $item = 'intercom', $label = null, $var = $item, $p = "placeholder=\"Код домофона\""])
					<button type="submit" class="btn btn-default">Применить</button>
					{!! Form::close() !!}
				</div>
			</div>
		@endif

			@if($type == 'password' && $action == 'reset')
				<div class="mod_login">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<h2>Введите данные, чтобы изменить пароль</h2>
						<div class="clearfix"></div>
						<div class="from">
							{!! Form::open(['route' => ['password.reset'], 'class' => 'ajax_form']) !!}
								<input type="hidden" name="token" value="{{ $parameters }}">
								@InputBlock([$type = "input", $item = 'email', $label = null, $p = "placeholder=\"E-mail\""])
								@InputBlock([$type = "password", $item = 'password', $label = null, $p = "placeholder=\"Пароль\""])
								@InputBlock([$type = "password", $item = 'password_confirmation', $label = null, $p = "placeholder=\"Повторить пароль\""])
								<button type="submit" class="">ПОДТВЕРДИТЬ</button>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			@endif

			@if($type == 'password' && $action == 'forget_pass')
				<div class="mod_login">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<h2>Забыли пароль?</h2>
						<div class="clearfix"></div>
						<div class="no-login">
							<span>Если вы забыли пароль, введите E-mail. Ваши регистрационные данные будут высланы вам по E-mail</span>
						</div>
						<div class="from">
							{!! Form::open(['route' => ['password.postEmail'], 'class' => 'ajax_form']) !!}
								@InputBlock([$type = "input", $item = 'email', $label = null, $p = "placeholder=\"E-mail\""])
								<a class="pull-right forgot-password-btn ajax_modal" href="#" data-action="login" data-type="auth">Я вспомнил пароль!</a>
								<button type="submit" class="">ВЫСЛАТЬ</button>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			@endif

		@if($type == 'auth' && $action == 'login')
			<div class="mod_login">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					@TagBlock([$type = 'img', $src = "/img/png/fa.png", $size = "80_80"])
					<h4>Войти с помощью</h4>
					@include('auth.partials._social_auth_icons')
					{!! Form::open(['route' => ['auth.postLogin'], 'class' => 'ajax_form']) !!}
						@InputBlock([$type = "input", $item = 'email', $label = null, $p = "placeholder=\"E-mail\""])
						@InputBlock([$type = "password", $item = 'password', $label = null, $p = "placeholder=\"Пароль\""])
						@InputBlock([$type = "checkbox", $item = 'remember_me', $label = 'Запомнить меня', $dp = "class=\"form-group checkbox\""])
						<a class="restore-password" href="#">Восстановить пароль</a>
						<button type="submit" class="btn btn-default">Войти</button>
						<a class="registration_login ajax_modal"  href="" data-action="register" data-type="auth">регистрация</a>
					{!! Form::close() !!}
				</div>
			</div>
		@endif

		@if($type == 'auth' && $action == 'register')
			<div class="mod_login">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body modal-body_regist">
					@TagBlock([$type = 'img', $src = "/img/png/fa.png", $size = "80_80"])
					<h4>Регистрация</h4>
					{!! Form::open(['route' => ['auth.postRegister'], 'class' => 'ajax_form']) !!}
						@InputBlock([$type = "input", $item = 'name', $label = null, $p = "placeholder=\"Имя\""])
						@InputBlock([$type = "input", $item = 'email', $label = null, $p = "placeholder=\"E-mail\""])
						@InputBlock([$type = "password", $item = 'password', $label = null, $p = "placeholder=\"Пароль\""])
						@InputBlock([$type = "password", $item = 'password_confirmation', $label = null, $p = "placeholder=\"Повторить пароль\""])
						<button type="submit" class="btn btn-regist btn-default">Регистрация</button>
						<a class="ajax_modal restore-password" href="" data-action="login" data-type="auth">Войти под своим логином</a>
					{!! Form::close() !!}
					@include('auth.partials._social_auth_icons')
				</div>
			</div>
		@endif

		@if($action == 'delete')
			<?php
				$type == 'vacancy' ? $route = 'vacancie' : $route = $type;
				if($parameters == 'favourites')
					$text = [
						'resume' => 'запись о сохранённом резюме',
						'vacancy' => 'запись о сохранённой вакансии',
					];
				elseif($parameters == 'responses')
					$text = [
						'resume' => 'запись о предложении вакансии',
						'vacancy' => 'отклик на вакансию',
					];
				else
					$text = [
						'resume' => 'резюме',
						'vacancy' => 'вакансию',
					]
			?>

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Вы уверены, что хотите удалить {{ array_get($text, $type) }} безвозвратно?</h4>
			</div>
			@if($parameters == 'favourites')
				<div class="modal-footer">
					<a class="btn btn-primary send_response" href="{{ route($route . 's.toFavourites', [$item->id, 'action' => 'remove']) }}">Удалить</a>
				</div>
			@elseif($parameters == 'responses')
				{!! Form::open(['route' => [$route . 's.response.destroy', $type . '_id' => $item->id , $forType . '_id' => $forItem->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'response_form']) !!}
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary send_response">Удалить</button>
				</div>
				{!! Form::close() !!}
			@else
				{!! Form::open(['route' => [$route . 's.delete', $item->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'response_form']) !!}
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary send_response">Удалить</button>
				</div>
				{!! Form::close() !!}
			@endif
		@endif
	</div>
</div>