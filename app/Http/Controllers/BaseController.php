<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Meta;
use App\Models\Vars;
use App\User;
use Illuminate\Http\Request;
use Image;
use ReflectionClass;
use Request as StaticRequest;
use Response;

class BaseController extends Controller
{
	public $b_counter;
	public $adminVars;

	public function __construct(Request $request)
	{
		$adminVars = Vars::getAdminVars();
//		$page = Meta::where('slug', $request->path())->first();

		$this->b_counter = 0;
		$this->adminVars = $adminVars;

		view()->share([
			'b_counter' => 0,
			'adminVars' => $adminVars,
//			'metatitle' => $page ? $page->metatitle : null,
//			'metadesc' => $page ? $page->metadesc : null,
//			'metakeyw' => $page ? $page->metakeyw : null,
		]);
	}

	public function fitImage(Request $request)
	{
		$keys = array_keys($request->all());
		$size = explode('_', array_get($keys, 0));
		$path = array_get($keys, 1);
		$fullPath = strpos($path, '/') === false ? config('admin.imagesUploadDirectory') . '/' . str_replace('_', '.', $path) : str_replace('_', '.', $path);
		$cachedImage = Image::cache(function($image) use($size, $fullPath) {
			$image->make($fullPath)->fit(array_get($size, 0), array_get($size, 1));
		}, 43200);

		return Response::make($cachedImage, 200, array('Content-Type' => 'image/jpeg'));
	}

	public function resizeImage(Request $request)
	{
		$keys = array_keys($request->all());
		$size = explode('_', array_get($keys, 0));
		$path = array_get($keys, 1);
		$fullPath = strpos($path, '/') === false ? config('admin.imagesUploadDirectory') . '/' . str_replace('_', '.', $path) : str_replace('_', '.', $path);
		$cachedImage = Image::cache(function($image) use($size, $fullPath) {
			$image->make($fullPath)->resize(array_get($size, 0), array_get($size, 1), function ($constraint) {
				$constraint->aspectRatio();
			});
		}, 43200);

		return Response::make($cachedImage, 200, array('Content-Type' => 'image/jpeg'));
	}

	public function getAjaxResponseView($data)
	{
		$status = array_get($data, 'status');
		$arr = [
			'status'  => $this->ajaxResponse(array_get($status, 0), array_get($status, 1), array_get($status, 2)),
			'views' => array_get($data, 'views'),
			'params' => array_get($data, 'params'),
		];
		if(count(array_get($data, 'vars')))
			foreach(array_get($data, 'vars') as $key => $var)
				$arr = array_add($arr, $key, $var);

		return view('partials.mini._getAjaxResponseBlock', $arr);
	}

	public function ajaxResponse($status, $msg, $params = [])
	{
		$arr = ['success' => $status, 'text' => $msg];
		if(count($params))
			foreach($params as $k => $v)
				$arr = array_add($arr, $k, $v);

		return $arr;
	}

	public function accessProtected($obj, $prop) {
		$reflection = new ReflectionClass($obj);
		$property = $reflection->getProperty($prop);
		$property->setAccessible(true);
		return $property->getValue($obj);
	}

	public function generateCode($length = 6)
	{
		$number = '';

		do {
			for ($i = $length; $i--; $i > 0) {
				$number = random_int(100000, 999999);
			}
		} while (!empty(User::where('personal_bill', $number)->first(['id'])));

		return $number;
	}

//--------------------------------------------------------------------------------------------------------------

}
