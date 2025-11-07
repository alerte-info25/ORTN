<?php

namespace App\Http\Controllers\Front\User;

use App\Http\Controllers\Controller;
use App\Models\NewsLetterAbonne;
use Illuminate\Http\Request;

class UserAbonneController extends Controller
{
    public function index ()
    {
        $abonnesCount = NewsLetterAbonne::count();
        $abonnesAll = NewsLetterAbonne::latest()->paginate(10);
        
        return view ("back.newsletters.abonnes", compact(
            "abonnesCount",
            "abonnesAll"
        ));
    }
}
