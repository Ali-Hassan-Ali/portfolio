<?php

namespace App\Http\Controllers\Dashboard\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Websites\HeroRequest;
use Illuminate\Contracts\View\View;

class HeroController extends Controller
{
    public function index(): View
    {
        //dd(setting('hero')->status);
        abort_if(!permissionAdmin('read-websites'), 403);

        $breadcrumb = [
			[
                'route' => '#',
                'trans' => 'admin.models.websites',
            ], 
			['trans' => 'admin.websites.hero']];

    	return view('dashboard.admin.websites.hero', compact('breadcrumb'));

    }//end of index

    public function store(HeroRequest $request)
    {   
        setting('hero')->save($request->validated());

        session()->flash('success', __('admin.messages.updated_successfully'));
        return redirect()->back();

    }//end of index

}//end of controller