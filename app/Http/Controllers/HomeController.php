<?php

  

namespace App\Http\Controllers;

 

use Illuminate\Http\Request;

use Illuminate\View\View;
use App\Models\Rujukan;


  

class HomeController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('auth');

    }

  

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function index(): View

    {
        $userId = auth()->id(); // Get the logged-in user's ID
    
        // Filter rujukan where the logged-in user is in the visible_to column
        $rujukan = Rujukan::whereRaw("FIND_IN_SET(?, rujuk_pasien)", [$userId])
            ->whereDate('created_at', now()->toDateString())
            ->latest()
            ->get();
    
        return view('home', compact('rujukan', 'userId'));

    } 

  

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function adminHome(): View

    {

        $rujukan = Rujukan::latest()->limit(5)->get();
        return view('adminHome', compact('rujukan'));

    }

  

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function managerHome(): View

    {

        return view('managerHome');

    }

}