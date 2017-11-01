<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Role;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;
use SleepingOwl\Admin\Contracts\Initializable;

/**
 * Class Administrators
 *
 * @property \App\Models\Administrator $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Administrators extends Section  /*implements Initializable*/
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Administrators';

//    /**
//     * Initialize class.
//     */
//    public function initialize()
//    {
//        $this->addToNavigation()->setIcon('fa fa-bank')->setPriority(0);
//    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()->with('roles')->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
	            AdminColumn::text('id')->setLabel('ID')->setWidth('40px'),
	            AdminColumn::link('username')->setLabel('Username'),
	            AdminColumn::text('name')->setLabel('Name'),
                AdminColumn::lists('roles.label', 'Roles')->setWidth('200px'),
            ])->paginate(10);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Username')->required(),
            AdminFormElement::password('password', 'Password')->required()->addValidationRule('min:6'),
            AdminFormElement::text('email', 'E-mail')->required()->addValidationRule('email'),
            AdminFormElement::multiselect('roles', 'Roles', Role::class)->setDisplay('name'),
            AdminFormElement::upload('avatar', 'Avatar')->addValidationRule('image'),
            AdminColumn::image('avatar')->setWidth('150px'),
        ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // todo: remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // todo: remove if unused
    }
}
