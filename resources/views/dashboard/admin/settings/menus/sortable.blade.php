<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.settings') . ' - ' . trans('admin.settings.menus') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.settings.menus') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    @php $storeUrl = route('dashboard.admin.settings.menus.sortable.store'); @endphp

    <div class="grid gap-5 lg:gap-7.5">

        {{-- Tabs --}}
        <div class="kt-tabs kt-tabs-line" data-kt-tabs="true">
            <button type="button" class="kt-tab-toggle py-3 flex items-center gap-2 active" data-kt-tab-toggle="#tab-header">
                <i class="ki-filled ki-menu text-base"></i>
                {{ trans('admin.global.header') ?? 'Header' }}
            </button>
            <button type="button" class="kt-tab-toggle py-3 flex items-center gap-2" data-kt-tab-toggle="#tab-footer">
                <i class="ki-filled ki-element-7 text-base"></i>
                {{ trans('admin.global.footer') ?? 'Footer' }}
            </button>
        </div>

        {{-- ===== HEADER TAB ===== --}}
        <div id="tab-header">

            <div class="kt-card">
            
				<div class="kt-card-header">
                    <h3 class="kt-card-title">{{ trans('admin.global.header') ?? 'Header Navigation' }}</h3>
                    <p class="text-sm text-gray-400">{{ __('اسحب لإعادة الترتيب') }}</p>
                </div>
            
				<div class="kt-card-body p-6">
            
					<ul id="header-sortable" class="flex flex-col gap-2">
            
						@foreach ($headerMenus as $menu)

                            <li class="flex items-center gap-3 p-3 rounded-xl border border-border bg-surface-container-lowest cursor-grab hover:border-primary transition-colors" data-id="{{ $menu->id }}">
                                
								<span class="text-gray-400 shrink-0">
                                    <i class="ki-filled ki-dots-square-vertical text-xl"></i>
                                </span>
                                
								<span class="flex-1 font-medium text-sm">{{ $menu->name }}</span>
                                
								<a href="{{ route('dashboard.admin.settings.menus.edit', $menu->id) }}"
                                   class="kt-btn kt-btn-xs kt-btn-outline">
                                    <i class="ki-filled ki-pencil text-xs"></i>
                                </a>
								
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

        {{-- ===== FOOTER TAB ===== --}}
        <div id="tab-footer" class="hidden">

            <div class="kt-card">
            
				<div class="kt-card-header">
                    <h3 class="kt-card-title">{{ trans('admin.global.footer') ?? 'Footer Navigation' }}</h3>
                    <p class="text-sm text-gray-400">{{ __('اسحب المجموعات لإعادة ترتيبها، واسحب الروابط بين المجموعات') }}</p>
                </div>
            
				<div class="kt-card-body p-6">

                    <div id="footer-groups" class="flex flex-col gap-4">
            
						@foreach ($footerGroups as $group)
            
							<div class="footer-group rounded-2xl border border-border bg-surface-container-lowest overflow-hidden" data-id="{{ $group->id }}">

                                {{-- Group Header (drag handle) --}}
                                <div class="group-handle flex items-center gap-3 px-4 py-3 bg-surface-container cursor-grab select-none border-b border-border">
                                    <i class="ki-filled ki-dots-square-vertical text-gray-400 text-xl shrink-0"></i>
                                    <span class="font-semibold text-sm flex-1">{{ $group->name }}</span>
                                    <a href="{{ route('dashboard.admin.settings.menus.edit', $group->id) }}" class="kt-btn kt-btn-xs kt-btn-outline shrink-0">
                                        <i class="ki-filled ki-pencil text-xs"></i>
                                    </a>
                                </div>

                                {{-- Children (cross-group sortable) --}}
                                <ul class="children-list flex flex-col gap-1 p-3 min-h-[60px]" data-parent-id="{{ $group->id }}">
                                    
									@foreach ($group->children as $child)
                                    
										<li class="flex items-center gap-3 px-3 py-2 rounded-lg border border-border bg-white cursor-grab hover:border-primary transition-colors" data-id="{{ $child->id }}">
                                            <i class="ki-filled ki-dots-square-vertical text-gray-300 text-base shrink-0"></i>
                                            <span class="flex-1 text-sm">{{ $child->name }}</span>
                                            <span class="text-xs text-gray-400 truncate max-w-[120px]">{{ $child->link }}</span>
                                            <a href="{{ route('dashboard.admin.settings.menus.edit', $child->id) }}" class="kt-btn kt-btn-xs kt-btn-light shrink-0">
                                                <i class="ki-filled ki-pencil text-xs"></i>
                                            </a>
                                    
										</li>
                                    
									@endforeach
									
                                </ul>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

    </div>

    <x-slot name="scripts">
        <script>

            const storeUrl = @json($storeUrl);
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrfToken } });

            function showNoty(text, type = 'success') {
                new Noty({ layout: 'topRight', type, text, killer: true, timeout: 2500 }).show();
            }

            function saveHeader() {
                const items = $('#header-sortable li').map(function () {
                    return $(this).data('id');
                }).get();

                $.post(storeUrl, { type: 'header', items }, () => {
                    showNoty(@json(trans('admin.messages.updated_successfully')));
                });
            }

            function saveFooter() {
                const groups = [];

                $('#footer-groups .footer-group').each(function () {
                    const groupId  = $(this).data('id');
                    const children = $(this).find('.children-list li').map(function () {
                        return $(this).data('id');
                    }).get();

                    groups.push({ id: groupId, children });
                });

                $.post(storeUrl, { type: 'footer', groups }, () => {
                    showNoty(@json(trans('admin.messages.updated_successfully')));
                });
            }

            // ===== Header Sortable =====
            $('#header-sortable').sortable({
                cursor: 'grabbing',
                placeholder: 'rounded-xl border-2 border-dashed border-primary/30 bg-primary/5 h-12',
                stop: function () { saveHeader(); },
            }).disableSelection();

            $('#save-header').on('click', saveHeader);

            // ===== Footer Sortable =====

            // Groups reorder
            $('#footer-groups').sortable({
                handle: '.group-handle',
                cursor: 'grabbing',
                items: '.footer-group',
                placeholder: 'rounded-2xl border-2 border-dashed border-primary/30 bg-primary/5 h-16',
                stop: function () { saveFooter(); },
            }).disableSelection();

            // Children sortable with cross-group drag
            $('.children-list').sortable({
                connectWith: '.children-list',
                cursor: 'grabbing',
                placeholder: 'rounded-lg border-2 border-dashed border-secondary/30 bg-secondary/5 h-10',
                stop: function () { saveFooter(); },
            }).disableSelection();

            $('#save-footer').on('click', saveFooter);

        </script>
    </x-slot>

    <x-slot name="styles">
        <style>
            .ui-sortable-helper { box-shadow: 0 8px 24px rgba(0,0,0,.12); opacity: .95; }
            .ui-sortable-placeholder { visibility: visible !important; }
            #footer-groups .footer-group { transition: box-shadow .2s; }
            #footer-groups .footer-group.ui-sortable-helper { box-shadow: 0 12px 32px rgba(0,0,0,.15); }
            .children-list { transition: background .2s; }
            .children-list.ui-sortable-over { background: rgba(var(--kt-primary-rgb), .03); }
        </style>
    </x-slot>

</x-dashboard.admin.layout.app>
