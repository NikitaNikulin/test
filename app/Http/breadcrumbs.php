<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
	$breadcrumbs->push('На главную', route('home'));
});

// Pages
Breadcrumbs::register('pages.show', function ($breadcrumbs, $page) {
	$breadcrumbs->parent('home');
	$breadcrumbs->push(is_object($page) ? $page->title : $page,
		route('pages.show', [is_object($page) ? $page->view : '']));
});

//// Cartridges
//Breadcrumbs::register('cartridges.index', function ($breadcrumbs, $brand, $type) {
//	$breadcrumbs->parent('home');
//	$breadcrumbs->push("Заправка " . ($type === 'color' ? 'цветных' : 'чёрно-белых') . " картриджей {$brand->title}",
//		route('cartridges.index', [$brand->slug, $type]));
//});
//Breadcrumbs::register('cartridges.show', function ($breadcrumbs, $cartridge) {
//	$breadcrumbs->parent('cartridges.index', $cartridge->brand, $cartridge->color->title);
//	$breadcrumbs->push("{$cartridge->title}",
//		route('cartridges.show', [$cartridge->slug]));
//});