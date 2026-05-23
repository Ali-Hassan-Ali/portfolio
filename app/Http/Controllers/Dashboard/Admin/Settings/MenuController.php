<?php

namespace App\Http\Controllers\Dashboard\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Settings\Menu\MenuRequest;
use App\Http\Requests\Dashboard\Admin\Settings\Menu\DeleteRequest;
use App\Http\Requests\Dashboard\Admin\Settings\Menu\StatusRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Models\Menu;
use App\Enums\Admin\PageTypeEnum;

class MenuController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-menus'), 403);

        $datatables = datatableServices()
                        ->header([
                            'admin.global.name',
                            'admin.global.link',
                            'admin.global.status'
                        ])
                        ->checkbox(['status' => 'dashboard.admin.settings.menus.status'])
                        ->route('dashboard.admin.settings.menus.data')
                        ->columns(['name', 'link', 'status'])
                        ->sortable('dashboard.admin.settings.menus.sortable.store')
                        ->run();

        $breadcrumb = [
            ['trans' => 'admin.models.settings'],
            ['trans' => 'admin.settings.menus'],
            ['trans' => 'admin.global.sortable', 'route' => 'dashboard.admin.settings.menus.sortable.index']
        ];

        return view('dashboard.admin.settings.menus.index', compact('breadcrumb', 'datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => permissionAdmin('status-menus'),
            'update' => permissionAdmin('update-menus'),
            'delete' => permissionAdmin('delete-menus'),
        ];

        $menu = Menu::query();

        return dataTables()->of($menu)
                ->addColumn('record_select', 'dashboard.admin.dataTables.record_select')
                ->editColumn('name', fn (Menu $menu) => $menu?->name)
                ->addColumn('actions', fn(Menu $menu) => datatableAction($menu, $permissions)->buttons()->build())
                ->addColumn('status', fn (Menu $menu) => view('dashboard.admin.dataTables.checkbox', ['models' => $menu, 'permissions' => $permissions, 'type' => 'status']))
                ->rawColumns(['record_select', 'actions', 'status', 'image'])
                ->addIndexColumn()
                ->toJson();

    }//end of data

    public function create(): View
    {
        abort_if(!permissionAdmin('create-menus'), 403);

        $breadcrumb = [
            [
                'route' => 'dashboard.admin.settings.menus.index',
                'trans' => 'admin.settings.menus',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.create',
            ]
        ];

        $types   = PageTypeEnum::options();
        $parents = Menu::whereNull('parent_id')->orderBy('index')->get();

        return view('dashboard.admin.settings.menus.create', compact('breadcrumb', 'types', 'parents'));

    }//end of create

    public function store(MenuRequest $request): RedirectResponse
    {
        Menu::create(array_merge($request->validated(), ['admin_id' => auth('admin')->id()]));

        session()->flash('success', __('admin.messages.added_successfully'));
        return to_route('dashboard.admin.settings.menus.index');

    }//end of store

    public function edit(Menu $menu): View
    {
        abort_if(!permissionAdmin('update-menus'), 403);

        $breadcrumb = [
            [
                'route' => 'dashboard.admin.settings.menus.index',
                'trans' => 'admin.settings.menus',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.edit',
            ]
        ];

        $types   = PageTypeEnum::options();
        $parents = Menu::whereNull('parent_id')->where('id', '!=', $menu->id)->orderBy('index')->get();

        return view('dashboard.admin.settings.menus.edit', compact('menu', 'breadcrumb', 'types', 'parents'));

    }//end of edit

    public function update(MenuRequest $request, Menu $menu): RedirectResponse
    {
        $menu->update($request->validated());

        session()->flash('success', __('admin.messages.updated_successfully'));
        return to_route('dashboard.admin.settings.menus.index');
        
    }//end of update

    public function destroy(Menu $menu): Application | Response | ResponseFactory
    {
        $menu->id < 7 ? '' : $menu->delete();

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Application | Response | ResponseFactory
    {
        Menu::whereIn('id', request()->ids ?? [])->where('id', '>', 7)->delete();

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $menu = Menu::find($request->id);
        $menu?->update(['status' => !$menu->status]);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return response(__('admin.messages.updated_successfully'));
        
    }//end of status

    public function sortablePage(): View
    {
        $breadcrumb = [
            ['trans' => 'admin.models.settings'],
            ['trans' => 'admin.settings.menus', 'route' => 'dashboard.admin.settings.menus.index'],
            ['trans' => 'admin.global.sortable'],
        ];

        $headerMenus = Menu::where('type', PageTypeEnum::HEADER)
                           ->whereNull('parent_id')
                           ->orderBy('index')
                           ->get();

        $footerGroups = Menu::where('type', PageTypeEnum::FOOTER)
                            ->whereNull('parent_id')
                            ->orderBy('index')
                            ->with(['children' => fn($q) => $q->orderBy('index')])
                            ->get();

        return view('dashboard.admin.settings.menus.sortable', compact('breadcrumb', 'headerMenus', 'footerGroups'));

    }//end of sortablePage

    public function storeSortable(): bool
    {
        $type = request('type', 'header');

        if ($type === 'footer') {
            foreach (request('groups', []) as $groupIndex => $group) {
                Menu::where('id', $group['id'])->update(['index' => $groupIndex]);
                foreach ($group['children'] ?? [] as $childIndex => $childId) {
                    Menu::where('id', $childId)->update(['index' => $childIndex, 'parent_id' => $group['id']]);
                }
            }
        } else {
            foreach (request('items', []) as $index => $id) {
                Menu::where('id', $id)->update(['index' => $index]);
            }
        }

        return true;

    }//end of storeSortable

}//end of controller