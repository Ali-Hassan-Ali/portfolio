<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.settings') . ' - ' . trans('admin.settings.menus') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.settings.menus') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

            <form method="post" action="{{ route('dashboard.admin.settings.menus.store') }}">
                @csrf

                <div class="p-6">

                    {{-- Language Tabs --}}
                    <div class="kt-tabs kt-tabs-line mb-6" data-kt-tabs="true">
                        @foreach (getLanguages() as $language)
                            <button type="button" class="kt-tab-toggle py-3 flex items-center gap-2 {{ $loop->first ? 'active' : '' }}" data-kt-tab-toggle="#menu_tab_{{ $language->code }}">
                                <img src="{{ asset('admin_assets/media/flags/' . $language->flag) }}" class="w-5 h-5 rounded-full object-cover" onerror="this.style.display='none'" alt="{{ $language->name }}" />
                                {{ $language->name }}
                            </button>
                        @endforeach
                    </div>

                    @foreach (getLanguages() as $language)
                        <div id="menu_tab_{{ $language->code }}" class="{{ $loop->first ? '' : 'hidden' }}">
                            <x-input.text
                                name="name[{{ $language->code }}]"
                                label="global.name"
                                :required="$loop->first" />
                        </div>
                    @endforeach

                    <div class="grid grid-cols-3 gap-4 mt-4">

                        <x-input.text name="link" label="global.link" :required="true" />

                        <div class="mt-2">
                            <label class="block text-sm font-medium mb-1">{{ trans('admin.global.type') }}</label>
                            <select name="type" class="kt-select block w-full">
                                @foreach ($types as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-2">
                            <label class="block text-sm font-medium mb-1">{{ trans('admin.global.parent') }}</label>
                            <select name="parent_id" class="kt-select block w-full">
                                <option value="">— {{ trans('admin.global.none') }} —</option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                </div>

                <x-input.checkbox :label="false" />

                <x-dashboard.admin.button.save />

            </form>

        </div>

    </div>

</x-dashboard.admin.layout.app>
