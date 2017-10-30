<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Page;
use App\Models\Profile;
use Illuminate\Http\Request;

class PagesController extends BaseController
{
    public function getHome(Request $request)
    {
        return view('home');
    }

	public function test(Request $request)
	{
		return redirect('admin_panel\projects');
	}

	public function showProfile(Request $request)
	{
		$page = 1;
		$ajax = $request->get('ajax');
		if($ajax)
			$page = $request->get('page');
		$profile = Profile::where('user_id', \Auth::id())->first();
//		$orders = Order::where('user_id', \Auth::id())->orderBy('created_at', 'desc')->paginate(env('CONFIG_PAGINATE', 1), ['*'], 'page', $page);

		if (!$ajax)
			return view('profiles.show', compact('profile', 'orders', 'page'));
		else
			return $this->getAjaxResponseView([
				'status' => [1, null],
				'views' => ['partials.mini._showMoreBlock', ['append' => 'orders.partials._historyBlock']],
//				'vars' => ['orders' => $orders, 'countItems' => $orders->total()]
			]);
	}

	public function updateProfile(Request $request, $id)
	{
		$this->validate($request, [
			'name' => 'required|max:255',
			'phone' => 'required|max:255',
			'address' => 'required|max:255',
			'intercom' => 'max:255',
		], [
			'name.required' => 'Укажите имя!',
			'phone.required' => 'Укажите телефон!',
			'address.required' => 'Укажите адрес!',
		]);

		$profile = Profile::where('id', $id)->first();
		$profile->update($request->all());

		return $this->getAjaxResponseView([
			'status' => [1, 'Информация успешно обновлена!'],
			'views' => ['profiles.partials._profileBlock', 'auth.partials._authBlock'],
			'vars' => ['item' => $profile]
		]);
	}

	public function showPage (Request $request, $view)
	{
		if($view === 'contacts')
			return view('pages.contacts');
		$page = Page::whereView($view)->first();

		return view('pages.show', compact('page'));
	}

	public function getSearched(Request $request)
	{
		$query = $request->get('query');
		$searchedCartridges = Cartridge::search($query)->activeOrder()->take(16)->get();

		return $this->getAjaxResponseView([
			'status' => [1, null],
			'views' => ['pages.partials._searchedBlock'],
			'vars' => ['searchedCartridges' => $searchedCartridges]
		]);
	}
}