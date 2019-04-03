<?php

namespace App\Http\Controllers\Frontend\User;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\LaravelViewRequest;
use Illuminate\Http\Request;

/** 
 * Class DashboardController.
 */
class LaravelController extends Controller 
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(LaravelViewRequest $request)
    {
        $id = $request->id;
        $projects = DB::table('projects')->select('id','technology_id','project_name','project_details','file')->where('technology_id','=' ,$id)->get();
        return view('frontend.user.Technology_Specific.Laravel')->with('projects',$projects);
    }
    public function show(LaravelViewRequest $request)
    {
        $url = $request->file;
        $url = Storage::disk('public')->url("ch1.pdf");
        return response()->download(storage_path('app/public/ch1.pdf'));
    }
}
