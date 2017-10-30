<?php isset($item) ? $profile = $item : false ?>

@TagBlock([$type = "img", $var = $profile, $src = "image", $b_size = '65_65'])
<a class="ajax_modal person-refactor" href="" data-action="update" data-type="profile" data-id="{{ $profile->id }}">Изменить</a>
<div class="lalafa">
	<ul class="person-title">
		<li>Имя:</li>
		<li>Телефон:</li>
		<li>Адрес:</li>
		<li>Код домофона:</li>
	</ul>
	<ul class="person-facts ">
		<li>{{ $profile->name ? $profile->name : 'Не указано' }}</li>
		<li>{{ $profile->phone ? $profile->phone : 'Не указано' }}</li>
		<li>{{ $profile->address ? $profile->address : 'Не указано' }}</li>
		<li>{{ $profile->intercom ? $profile->intercom : 'Не указано' }}</li>
	</ul>
</div>