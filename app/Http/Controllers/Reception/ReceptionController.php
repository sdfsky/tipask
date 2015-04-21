<?php namespace App\Http\Controllers\Reception;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class ReceptionController extends BaseController {

	use DispatchesCommands, ValidatesRequests;

}
