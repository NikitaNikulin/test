<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
	<label for="{{ $name }}">{{ $label }}</label>

	<div>
		<select @if($multiSelect) multiple="multiple" name="{{ $name }}[]" @else name="{{ $name }}" @endif
		        class="form-control multiselect-remote-{{ $name }}" size="2" data-select-type="single" {!! ($nullable) ? 'data-nullable="true"' : '' !!}>
			@if ($nullable)
				<option value=""></option>
			@endif
			@foreach ($options as $optionValue => $optionLabel)
				@if($multiSelect)
					<option value="{{ $optionValue }}" {!! isset($value) && in_array($optionValue, $value) ? 'selected="selected"' : '' !!}>{{ $optionLabel }}</option>
				@else
					<option value="{{ $optionValue }}" {!! ($value == $optionValue) ? 'selected="selected"' : '' !!}>{{ $optionLabel }}</option>
				@endif
			@endforeach
		</select>
	</div>
	@include(AdminTemplate::view('formitem.errors'))
</div>
<script>
	$('.multiselect-remote-{{ $name }}').select2({
		ajax: {
			url: '/admin_panel/formItems/remoteSelect/{{ str_replace('\\', '_', $model) }}/{{ $display }}',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					@if(count($filter))
						<?php $i = 0 ?>
						filters: '<?= count($filter) ?>',
						@foreach($filter as $fil)
							<?php $i++ ?>
							@if(count($fil) && count($fil) == 2)
								column{{ $i }}: '<?= $fil[0] ?>',
								searched{{ $i }}: '<?= $fil[1] ?>',
							@elseif(count($fil) && count($fil) == 3)
								column{{ $i }}: '<?= $fil[0] ?>',
								sign{{ $i }}: '<?= $fil[1] ?>',
								searched{{ $i }}: '<?= $fil[2] ?>',
							@endif
						@endforeach
					@endif
					q: params.term, // search term
					page: params.page
				};
			},
			processResults: function (data, params) {
				params.page = params.page || 1;

				return {
					results: data.items,
					pagination: {
						more: (params.page * 30) < data.total_count
					}
				};
			},
			cache: true
		},
		escapeMarkup: function (markup) {
			return markup;
		},
		minimumInputLength: 2,
		templateResult: formatRepo,
		templateSelection: formatRepoSelection
	});

	<?php $delimiter = $addDisplay && is_array($addDisplay) && count($addDisplay) > 1 ? array_get($addDisplay, 1) : ' ' ?>
	<?php $addDisplay = $addDisplay && is_array($addDisplay) ? array_get($addDisplay, 0) : $addDisplay ?>
	function formatRepo(repo) {
		var itemText = repo.{{ $display }};
		@if($addDisplay)
			if(repo.{{ $addDisplay }})
				itemText = repo.{{ $display }} + '<?= $delimiter ?>' + repo.{{ $addDisplay }};
		@endif
		return itemText;
	}

	function formatRepoSelection(repo) {
		var selectedItemText = repo.text;
		if(repo.{{ $display }}) {
			selectedItemText = repo.{{ $display }};
			@if($addDisplay)
				if(repo.{{ $addDisplay }})
					selectedItemText = repo.{{ $display }} + '<?= $delimiter ?>' + repo.{{ $addDisplay }};
			@endif
		}
		return selectedItemText;
	}
</script>