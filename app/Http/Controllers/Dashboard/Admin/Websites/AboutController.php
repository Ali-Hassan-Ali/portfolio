<?php

namespace App\Http\Controllers\Dashboard\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Websites\About\AboutRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-websites'), 403);

        $breadcrumb = [['trans' => 'admin.websites.about']];

        return view('dashboard.admin.websites.about', compact('breadcrumb'));
    }

    public function store(AboutRequest $request)
    {
        $data = $request->validated();

        if(request()->file('image')) {

            if(!empty(setting('about')->image_path)) {

                Storage::disk('public')->delete(setting('about')->image_path);
            }

            $data['image_path'] = request()->file('image')->store('about', 'public');

        } else {

			$data['image_path'] = setting('meta')->image_path;
		}

        setting('about')->save($data);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return redirect()->back();
    }
}
