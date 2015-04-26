<?php namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\View;

abstract class AdminController extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    protected $_menus = array();

    public function __construct(){

        /*加载后台菜单*/
       $this->loadMenus();

    }


    /**
     * 加载后台菜单
     */
    public function loadMenus(){

        $this->_menus =Menu::getTree();
        View::share('_menus',$this->_menus);

    }


}
