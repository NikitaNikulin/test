<?php

namespace App\Models;

use App\Custom\CustomCollection;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use LocalizedCarbon;

class BaseModel extends Model
{
	public static function makeModel($model, $path = 'App\Models\\', $withRelations = false) {
		if(!is_string($path)) {
			$withRelations = $path;
			$path = 'App\Models\\';
		}
		if($cutModel = stristr($model, 's.', true))
			$model = $cutModel;
		$resultedModel = \App::make($path . str_replace(' ', '', ucwords(str_replace('_', ' ', $model))));
		if(!$withRelations)
			$resultedModel = $resultedModel->setEagerLoads([]);

		return $resultedModel;
	}

	/**
	 * Create a new Eloquent Collection instance.
	 *
	 * @param  array  $models
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function newCollection(array $models = [])
	{
		return new CustomCollection($models);
	}

	/**
	 * @param $query
	 */
	public function scopeForAuthUser($query)
	{
		$query->where('user_id', Auth::id());
	}

	public function scopeNotActive($query)
	{
		$query->where('active', false)->orderBy('created_at', 'desc');
	}
	public function scopeActive($query)
	{
		return $query->where('active', true)->orderBy('created_at', 'desc');
	}
	public function scopeActiveOnly($query)
	{
		return $query->where('active', true);
	}
	public function scopeOrder($query)
	{
		return $query->orderBy('order');
	}
	public function scopeActiveOrder($query)
	{
		return $query->activeOnly()->orderBy('order');
	}
	public function scopeActiveOrderDesc($query)
	{
		return $query->activeOnly()->orderBy('order', 'desc');
	}
	public function scopeModerated($query)
	{
		$query->where('moderated', true);
	}
	public function scopeActiveModerated($query)
	{
		$query->active()->where('moderated', true);
	}
	public function scopeActiveOnlyModerated($query)
	{
		$query->activeOnly()->where('moderated', true);
	}

	public function setAdminImageAttribute($value)
	{
		return $this->attributes['image'] = str_replace(config('admin.imagesUploadDirectory') . '/', '', $value);
	}

	public function getAdminImageAttribute()
	{
		if ($this->exists && $this->attributes['image'])
			return config('admin.imagesUploadDirectory') . '/' . $this->attributes['image'];
		return null;
	}

	public function setAdminFileAttribute($value)
	{
		return $this->attributes['file'] = str_replace(config('admin.imagesUploadDirectory') . '/', '', $value);
	}

	public function getAdminFileAttribute()
	{
		if ($this->exists && $this->attributes['file'])
			return config('admin.imagesUploadDirectory') . '/' . $this->attributes['file'];
		return null;
	}


	public function setAdminImagesAttribute($images)
	{
		self::saved(function($node) use($images) {
			$node->photos()->delete();
			$imgs = [];
			foreach ($images as $img) {
				$img = str_replace(config('admin.imagesUploadDirectory') . '/', '', $img);
				$imgs[] = Photo::create(['imageable_id' => $node->id, 'path' => $img]);
			}
			$node->photos()->saveMany($imgs);
		});
	}

	public function getAdminImagesAttribute()
	{
		$imgs = [];
		if($this->photos->count() > 0)
			foreach ($this->photos as $img) {
				$imgs[] = config('admin.imagesUploadDirectory') . '/' . $img->path;
			}
		return $imgs;
	}

	public function setImage($size, $filename, $type = 'fit')
	{
		$path = strpos($filename, '.') ? $filename : $this->{$filename};
		if($path == '')
			$path = '/img/jpg/nophoto.jpg';
		elseif(strpos($path, 'https://') !== false)
			return $path;
		$fullPath = strpos($path, '/') === false ? config('admin.imagesUploadDirectory') . '/' . $path : public_path($path);
		$file_exists = file_exists($fullPath);

		if ($file_exists && $path) {
			if(strpos($path, '/') === 0)
				$path = substr($path, 1);
			return route($type. 'Image', [$size, $path]);
		}

		$size = explode('_', $size);
		$w_size = array_get($size, 0);
		$h_size = array_get($size, 1) !== 'null' ? array_get($size, 1) : 0;
		return "http://placehold.it/{$w_size}x{$h_size}";
	}

//--------------------------------------------------------------------------------------------------------------

	public function getRussianMonth($dateString, $delimiter = ' ')
	{
		$months = [
			'Jan' => 'января',
			'Feb' => 'февраля',
			'Mar' => 'марта',
			'Apr' => 'апреля',
			'May' => 'мая',
			'Jun' => 'июня',
			'Jul' => 'июля',
			'Aug' => 'августа',
			'Sep' => 'сентября',
			'Oct' => 'октября',
			'Nov' => 'ноября',
			'Dec' => 'декабря'
		];

		$splitMonth = explode($delimiter, $dateString)[1];
		return str_replace($splitMonth, array_get($months, $splitMonth), $dateString);
	}
}
