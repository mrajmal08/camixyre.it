<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Cookie;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        if(Cookie::get('guestUser')):
            $userCookie = Cookie::get('guestUser');
        else:
            $time = time() + (86400 * 30);
            $code = mt_rand(100000, 999999);
            Cookie::queue(Cookie::forget('name'));
            Cookie::queue('guestUser',$code, $time);
        endif;
    }
}
