<?php
	isset($b_env) ?: $b_env = env('CONFIG_PAGINATE', 1);
	$page = isset($page) && $page ? $page : (Request::get('page') ? Request::get('page') : 1);
	$countItems = $type === 'clubs.reviews' || $type === 'treners.reviews' ? $amountOfReviews : ($items ? $items->total() : 0);
	$sort = $type === 'clubs.reviews' || $type === 'treners.reviews' ? 'created_at' : 'id';
?>

<div class="clearfix"></div>
<div class="seemore b-show_more" data-type="{{ $type }}" data-sort="{{ $sort }}" style="@if($countItems <= $b_env * $page) display: none; @endif">
	<a rel="nofollow" href="{{ route('ajax.showMore', ['page' => $page + 1, 'type' => $type]) }}" class="ajax_showMore">
		Показать еще
		<span class="b-show_more-lasts">{{ $countItems ? $countItems - $b_env * $page : null }}</span>
		из
		<span class="b-show_more-total">{{ $countItems ? $countItems : null }}</span>
	</a>
</div>