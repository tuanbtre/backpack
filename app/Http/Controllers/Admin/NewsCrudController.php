<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NewsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NewsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\News::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/news');
        CRUD::setEntityNameStrings('news', 'news');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns
        CRUD::addColumn(['name'=>'title', 'type'=>'text', 'label'=>'Tiêu đề']);
        CRUD::addColumn(['name'=>'re_name', 'type'=>'text', 'label'=>'Rewrite url']);
        CRUD::addColumn(['name'=>'cat_id', 'type'=>'select', 'entity' => 'catnews', 'label'=>'Loại tin', 'model'=>"App\Models\Newscat"]);
        CRUD::addColumn(['name'=>'isactive', 'type'=>'checkbox', 'label'=>'Hoạt động']);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(NewsRequest::class);
        CRUD::addField(['name'=>'title', 'type'=>'text', 'label'=>'Tiêu đề', 'tab'=> 'Tab1']);
        CRUD::addField(['name'=>'re_name', 'type'=>'text', 'label'=>'Rewrite url', 'tab'=> 'Tab1']);
        CRUD::addField(['name'=>'content', 'type'=>'ckeditor', 'label'=>'Nội dung', 'tab'=> 'Tab1']);
        CRUD::addField(['name'=>'cat_id', 'type'=>'select', 'entity' => 'catnews', 'label'=>'Loại tin', 'model'=>"App\Models\Newscat", 'tab'=> 'Tab1']);
        CRUD::addField(['name' => 'isactive', 'type' => 'checkbox', 'label'=>'Hoạt động', 'tab'=> 'Tab1']);
        CRUD::addField(['name' => 'priority', 'type' => 'number', 'label'=>'Thứ tự', 'tab'=> 'Tab1']);
        CRUD::addField(['label'=>"Hình ảnh", 'name'=>"image",'type'=>'upload','upload'=> true, 'disk'=>'public', 'tab'=> 'Tab2']);
        //CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
