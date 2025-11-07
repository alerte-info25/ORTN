<?php

namespace App\Http\Controllers\Front\User;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function render ()
    {
        $clients = Client::with(["user"])->paginate(10);
        $clientCount = Client::count();
        
        return view ("back.newsletters.inscrits", compact(
            'clients', 'clientCount'
        )); 
    }
}
