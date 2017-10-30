<?php
namespace App\Models;

use App\Custom\CustomCollection;

/**
 * Node
 *
 * This abstract class implements Nested Set functionality. A Nested Set is a
 * smart way to implement an ordered tree with the added benefit that you can
 * select all of their descendants with a single query. Drawbacks are that
 * insertion or move operations need more complex sql queries.
 *
 * Nested sets are appropiate when you want either an ordered tree (menus,
 * commercial categories, etc.) or an efficient way of querying big trees.
 */
abstract class Node extends \Baum\Node
{
	/**
	 * Overload new Collection
	 *
	 * @param array $models
	 * @return \Baum\Extensions\Eloquent\Collection
	 */
	public function newCollection(array $models = array())
	{
		return new CustomCollection($models);
	}
}
