<?php

namespace App\Http\Controllers\Dashboard\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Websites\WhyUs\WhyUsRequest;
use Illuminate\Contracts\View\View;

class WhyUsController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-websites'), 403);

        $breadcrumb = [['trans' => 'admin.websites.why_us']];

        return view('dashboard.admin.websites.why-us', compact('breadcrumb'));
    }

    public function store(WhyUsRequest $request)
    {
        setting('why_us')->save($request->validated());

        session()->flash('success', __('admin.messages.updated_successfully'));
        return redirect()->back();
    }
}
