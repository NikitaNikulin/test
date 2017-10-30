<?php

namespace App\Models;

class Vars extends BaseModel
{
	public static function getFilteredVars($initialVars, $allowed) {
		$filteredArr = array_filter(
			$initialVars,
			function ($key) use ($allowed) {
				if(strpos($key, $allowed) !== false) return $key;
			},
			ARRAY_FILTER_USE_KEY
		);
		array_pull($filteredArr, 'b_counter'); array_pull($filteredArr, 'b_item');

		return $filteredArr;
	}

	public static function getAdminVars() {
		$allVars = Widget::all()->keyBy('key');
		$col = \App::make(self::class);

		foreach ($allVars as $key => $var)
			$col->{camel_case($key)} = $var->value;
		$col->contacts = Contact::first();

		return $col;
	}
}
