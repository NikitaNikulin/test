<style>
	body {font-family: DejaVu Sans;}
</style>

<?php $obj = isset($notification['obj']) ? $notification['obj'] : null ?>
<?php $data = $notification['data'] ?>

@if($notification['type'] == 'newTrener')
	<h3>Здравствуйте, был добавлен новый специалист '{{ $data->FullName }}'!</h3>
	<p>Дата создания: {{ $data->created_at }}</p>
	<p>Телефон: {{ $data->phone }}</p>
	<p>Email: {{ $data->email }}</p>
{{--	<p>Пожалуйста, пройдите по <a href="{{ url(Admin::model(\App\Models\Trener::class)->editUrl($data->id)) }}">ссылке</a>, чтобы начать активацию</p>--}}
@elseif($notification['type'] == 'newClub')
	<h3>Здравствуйте, было добавлено новое заведение '{{ $data->title }}'!</h3>
	<p>Дата создания: {{ $data->created_at }}</p>
	<p>Телефон: {{ $data->phone }}</p>
	<p>Email: {{ $data->email }}</p>
{{--	<p>Пожалуйста, пройдите по <a href="{{ url(Admin::model(\App\Models\Club::class)->editUrl($data->id)) }}">ссылке</a>, чтобы начать активацию</p>--}}
@elseif($notification['type'] == 'clubForModeration')
	<h3>Здравствуйте, новое заведение '{{ $data->title }}' было отправлено на модерацию!</h3>
	<p>Имя владельца: {{ $data->user->name }}</p>
	<p>Дата создания: {{ $data->created_at }}</p>
	<p>Телефон: {{ $data->phone }}</p>
	<p>Email: {{ $data->email }}</p>
	<p>Пожалуйста, пройдите по <a href="{{ url(Admin::model(\App\Models\Club::class)->editUrl($data->id)) }}">ссылке</a>, чтобы начать модерацию</p>
@elseif($notification['type'] == 'trenerForModeration')
	<h3>Здравствуйте, информация о новом специалисте '{{ $data->FullName }}' была отправлена на модерацию!</h3>
	<p>Дата создания: {{ $data->created_at }}</p>
	<p>Телефон: {{ $data->phone }}</p>
	<p>Email: {{ $data->email }}</p>
	<p>Пожалуйста, пройдите по <a href="{{ url(Admin::model(\App\Models\Trener::class)->editUrl($data->id)) }}">ссылке</a>, чтобы начать модерацию</p>
@elseif($notification['type'] == 'moderatedClub')
	<h3>Здравствуйте, Ваше заведение '{{ $data->title }}' прошло модерацию!</h3>
@elseif($notification['type'] == 'moderatedTrener')
	<h3>Здравствуйте, информация о специалисте '{{ $data->FullName }}' прошла модерацию!</h3>
@elseif($notification['type'] == 'callback')
	<h3>Здравствуйте, заказан обратный звонок для {{ $obj instanceof \App\Models\Club ? 'заведения' : 'категории' }} '{{ $obj->title }}':</h3>
	<p>Имя: {{ $data->name }}</p>
	<p>Телефон: {{ $data->phone }}</p>
@endif
