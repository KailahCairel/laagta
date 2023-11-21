<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;

class PageController extends Controller
{

    public function index(Request $request) {
        
        $categories = $request->query('category'); 

        switch ($categories) {
            case 'hotels':

                // Filter establishments where the 'categories' column contains 'hotel'
                $establishments = Establishment::whereJsonContains('categories', 'hotel')->get();                
                return view('users.pages.hotels', compact('establishments'));
                break;
 
            case 'activities':
                $establishments = Establishment::whereJsonContains('categories', 'activity')->get();
                return view('users.pages.activities', compact('establishments'));

                break;
            case 'landmarks':
                # code...
                $establishments = Establishment::whereJsonContains('categories', 'landmark')->get();
                return view('users.pages.landmarks', compact('establishments'));
                break;
            case 'events':
                $establishments = Establishment::whereJsonContains('categories', 'event')->get();
                return view('users.pages.events', compact('establishments'));
                break;
            case 'attractions':
                # code...
                $establishments = Establishment::whereJsonContains('categories', 'attraction')->get();
                return view('users.pages.attractions', compact('establishments'));
                break;
            
            default:
                # code...

                return redirect('/');
                break;
        }

    } 
}
