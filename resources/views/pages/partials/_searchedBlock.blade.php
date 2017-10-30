@if(isset($searchedCartridges))
	<div class="autocomplite hidden-xs hidden-sm hide_window" style="top: 18% !important;">
		<button type="button">X</button>
		@if(count($searchedCartridges))
			@if(count($searchedCartridges->filterFix('price_sale', '=', 0)))
				<h2>Заправка</h2>
				<ul>
					@foreach($searchedCartridges->filterFix('price_sale', '=', 0)->take(4) as $searchedCartridge)
						<li>
							<a class="url" href="{{ route('cartridges.show', $searchedCartridge->slug) }}"></a>
							@TagBlock([$type = 'img', $var = $searchedCartridge, $src = "image", $size = "40_40"])
							<div class="title">
								<h3 class="{{ $searchedCartridge->colour }}"><a href="">{{ $searchedCartridge->title }}</a></h3>
							</div>
							<div class="price">
								<p>Цена <span>{{ $searchedCartridge->price }}</span></p>
							</div>
						</li>
					@endforeach
				</ul>
			@endif
			@if(count($searchedCartridges->filterFix('price_sale', '>', 0)))
				<h2>Продажа</h2>
				<ul>
					@foreach($searchedCartridges->filterFix('price_sale', '>', 0)->take(4) as $searchedCartridge)
						<li>
							<a class="url" href="{{ route('cartridges.show', $searchedCartridge->slug) }}"></a>
							@TagBlock([$type = 'img', $var = $searchedCartridge, $src = "image", $size = "40_40"])
							<div class="title">
								<h3 class="{{ $searchedCartridge->colour }}"><a href="">{{ $searchedCartridge->title }}</a></h3>
							</div>
							<div class="price">
								<p>Цена <span>{{ $searchedCartridge->price_sale }}</span></p>
							</div>
						</li>
					@endforeach
				</ul>
			@endif
		@else
			<p>Ничего не найдено!</p>
		@endif
	</div>
@endif