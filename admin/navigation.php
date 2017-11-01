<?php

/**
 * @var \SleepingOwl\Admin\Contracts\Navigation\NavigationInterface $navigation
 * @see http://sleepingowladmin.ru/docs/menu_configuration
 */

use SleepingOwl\Admin\Navigation\Page;

//$navigation = app('sleeping_owl.navigation');
//
//$navigation->addPage('')->setTitle('Dashboard')->setIcon('fa fa-dashboard')->setUrl(route('admin.dashboard'))->setPriority(-100);
////$navigation->addPage(\App\Models\Project::class)->setTitle('Projects')->setIcon('fa fa-bank')->setUrl('/projects');
//AdminNavigation::addPage('1')->setTitle('Projects')->setIcon('fa fa-newspaper-o')->setUrl('/projects');

return [
	(new Page())->setTitle('Dashboard')->setIcon('fa fa-dashboard')->setUrl(route('admin.dashboard'))->setPriority(-100),
	(new Page(\App\Models\Project::class))->setTitle('Projects')->setIcon('fa fa-bank'),
	[
		'title' => 'Permissions', 'icon' => 'fa fa-group', 'priority' =>'100', 'pages' => [
			(new Page(\App\Models\Administrator::class))->setIcon('fa fa-user')->setPriority(0),
			(new Page(\App\User::class))->setIcon('fa fa-user')->setPriority(0),
			(new Page(\App\Role::class))->setIcon('fa fa-group')->setPriority(100)
		]
	],

	//	(new Page(\App\User::class))->setTitle('Information')->setIcon('fa fa-exclamation-circle')->setUrl(route('admin.information'))->setPriority(-1)
//		->setAccessLogic(function (Page $page) {
//			return true;
//		}),
];