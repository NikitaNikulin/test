<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Widget extends BaseModel
{

    protected $fillable = ['name', 'key', 'value'];

}
