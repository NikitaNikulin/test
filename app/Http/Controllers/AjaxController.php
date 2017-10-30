<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Club;
use App\Models\Trener;
use Illuminate\Http\Request;
use Input;
use Response;
use Validator;

class AjaxController extends BaseController
{
	public function uploadFile()
	{
		$validator = Validator::make(Input::all(), static::uploadFileValidationRules());
		if ($validator->fails())
		{
			return Response::make($validator->errors()->get('file'), 400);
		}
		$file = Input::file('file');
		$filename = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
		$path = config('admin.imagesUploadDirectory');
		$fullpath = public_path($path);
		$file->move($fullpath, $filename);
		$value = $filename;
		return [
			'url'   => asset(($path . '/' . $value)),
			'value' => $value,
		];
	}

	protected static function uploadFileValidationRules()
	{
		return [
			'file' => 'mimes:jpg,jpeg,png,doc,docx,xls,xlsx,pdf|max:2000',
		];
	}

	public function uploadImage()
	{
		$validator = Validator::make(Input::all(), static::uploadImageValidationRules());
		if ($validator->fails())
		{
			return Response::make($validator->errors()->get('file'), 400);
		}
		$file = Input::file('file');
		$filename = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
		$path = config('admin.imagesUploadDirectory');
		$fullpath = public_path($path);
		$file->move($fullpath, $filename);
		$value = $filename;
		return [
			'url'   => asset(($path . '/' . $value)),
			'value' => $value,
		];
	}

	protected static function uploadImageValidationRules()
	{
		return [
			'file' => 'mimes:jpg,jpeg,png,gif|max:2000',
		];
	}

	public function getModalContent(Request $request)
	{
		$action = $request->get('action');
		$type = $request->get('type');
		$item_id = $request->get('item_id');
		$forType = $request->get('forItem');
		$forItem_id = $request->get('forItem_id');
		$parameters = $request->get('parameters');
		$itemPath = 'App\Models\\';
		$forItemPath = 'App\Models\\';

		if($item_id)
			$item = \App::make($itemPath . ucwords($type))->findOrFail($item_id);
		if($forItem_id)
			$forItem = \App::make($forItemPath . ucwords($forType))->findOrFail($forItem_id);

		return view('partials.mini._modalContentBlock', compact('action', 'type', 'forType', 'item', 'forItem', 'parameters'));
	}

	public function getAjaxResponse(Request $request)
	{
		return view('partials.mini._authBlock');
	}

	public function showMore(Request $request)
	{
		$type = $request->get('type');
		$page = $request->get('page');
		$from = ($request->get('page') - 1) * env('CONFIG_PAGINATE', 1);
		$sort = $request->get('sort') ? $request->get('sort') : 'id';

		if ($type != 'clubs.reviews' && $type != 'treners.reviews') {
			list($items, $resultedFilteredArr) = $this->getFilteredItems($request, $type);
			$items = $items->slice($from, env('CONFIG_PAGINATE', 1));

			return view('partials.mini._unitsListFiltered', compact('items', 'type', 'page'));
		}
		elseif ($type == 'clubs.reviews')
			$reviews = Club::findOrFail($request->get('item_id'))->reviews()->with(['reviewable', 'user'])->moderated()->get()
				->toHierarchy()->sortByDesc($sort)->slice($from, env('CONFIG_PAGINATE', 1));
		elseif ($type == 'treners.reviews')
			$reviews = Trener::findOrFail($request->get('item_id'))->reviews()->with(['reviewable', 'user'])->moderated()->get()
				->toHierarchy()->sortByDesc($sort)->slice($from, env('CONFIG_PAGINATE', 1));

		return view('partials.mini._reviewsBlock', compact('reviews'));
	}
}
