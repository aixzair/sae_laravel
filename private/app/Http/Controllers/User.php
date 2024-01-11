<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class User extends BaseController {

    public function toHome() {
        if (session()->has('role')) {
            switch (session('role')) {
                case 1:
                    return redirect()->route('secretary.home');
                case 2:
                case 3:
                case 4:
                    return redirect()->route('member.home');
                case 5:
                    return redirect()->route('director.home');
                case 6:
                    return redirect()->route('responsable.home');
            }
        }

        return redirect()->route('index');
    }

}