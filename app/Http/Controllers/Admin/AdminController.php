<?php namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

abstract class AdminController extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    protected $_menus = array();


    public function __construct(){

        /*加载后台菜单*/
        $this->loadMenus();

        //设置当前url地址
        View::share('current_menu_url',strtolower('/admin/'.str_replace('Controller','',app_var('CONTROLLER_NAME')).'/'.str_replace(array('get','post'),'',app_var('ACTION_NAME'))));

        //当前是否开启小菜单
        View::share('sidebar_collapse',Cookie::get('sidebar_collapse'));

    }


    /**
     * 加载后台菜单
     */
    public function loadMenus(){
        $this->_menus =Menu::getTree();
        View::share('_menus',$this->_menus);
    }


}
