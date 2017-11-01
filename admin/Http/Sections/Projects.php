<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Section;

class Projects extends Section
{
    protected $checkAccess = false;
    protected $title = 'Projects';

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setColumns([
            AdminColumn::text('id')->setLabel('ID')->setWidth('40px'),
            AdminColumn::link('title')->setLabel('Title')->setWidth('400px'),
            AdminColumn::text('description')->setLabel('Description')->setHtmlAttribute('class', 'text-muted'),
            AdminColumn::text('info')->setLabel('Information'),
        ])->paginate(10);

        return $display;
    }

    public function onEdit($id)
    {
	    $columns = AdminForm::panel()->addBody(
		    AdminFormElement::columns([
			    [
		            AdminFormElement::text('title', 'Title')->required()->unique(),
		            AdminFormElement::text('slug', 'Slug'),
	                AdminFormElement::textarea('description', 'Description')->setRows(5),
			    ],
		        [
			        AdminFormElement::ckeditor('info', 'Information')
		        ]
			])
	    );

	    return $columns;
    }

    public function onCreate()
    {
        return $this->onEdit(null);
    }
}