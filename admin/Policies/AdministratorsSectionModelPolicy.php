<?php

namespace Admin\Policies;

use Admin\Http\Sections\Administrators;
use App\Models\Administrator;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdministratorsSectionModelPolicy
{

	use HandlesAuthorization;

	/**
	 * @param Administrator $administrator
	 * @param string $ability
	 * @param Administrators $section
	 * @param Administrator $item
	 *
	 * @return bool
	 */
	public function before(Administrator $administrator, $ability, Administrators $section, Administrator $item = null)
	{
		dd(44);
//		if ($administrator->isSuperAdmin()) {
//			if ($ability != 'display' && $ability != 'create' && !is_null($item) && $item->id <= 2) {
//				return false;
//			}

			return true;
//		}
	}

	/**
	 * @param Administrator $administrator
	 * @param Administrators $section
	 * @param Administrator $item
	 *
	 * @return bool
	 */
	public function display(Administrator $administrator, Administrators $section, Administrator $item)
	{
		return true;
	}

	/**
	 * @param Administrator $administrator
	 * @param Administrators $section
	 * @param Administrator $item
	 *
	 * @return bool
	 */
	public function edit(Administrator $administrator, Administrators $section, Administrator $item)
	{
		return $item->id > 1;
	}

	/**
	 * @param Administrator $administrator
	 * @param Administrators $section
	 * @param Administrator $item
	 *
	 * @return bool
	 */
	public function delete(Administrator $administrator, Administrators $section, Administrator $item)
	{
		return $item->id > 1;
	}
}
