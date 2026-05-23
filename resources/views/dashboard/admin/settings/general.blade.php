<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.settings') . ' - ' . trans('admin.settings.general') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.settings.general') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

            <form method="post" action="{{ route('dashboard.admin.settings.general.store') }}">
                @csrf

                <div class="p-6">

                    {{-- Language Tabs --}}
                    <div class="kt-tabs kt-tabs-line mb-6" data-kt-tabs="true">
                        @foreach (getLanguages() as $language)
                            <button type="button" class="kt-tab-toggle py-3 flex items-center gap-2 {{ $loop->first ? 'active' : '' }}" data-kt-tab-toggle="#general_tab_{{ $language->code }}">
                                <img src="{{ asset('admin_assets/media/flags/' . $language->flag) }}" class="w-5 h-5 rounded-full object-cover" onerror="this.style.display='none'" alt="{{ $language->name }}" />
                                {{ $language->name }}
                            </button>
                        @endforeach
                    </div>

                    @foreach (getLanguages() as $language)
                        @php $isFirst = $loop->first; @endphp

                        <div id="general_tab_{{ $language->code }}" class="{{ $isFirst ? '' : 'hidden' }}">
                            <div class="grid grid-cols-1 gap-4 mb-4">

                                <x-input.text
                                    name="name[{{ $language->code }}]"
                                    label="global.name"
                                    :required="$isFirst"
                                    :value="setting('general', $language->code)->name ?? ''" />

                                <x-input.textarea
                                    name="about[{{ $language->code }}]"
                                    label="global.about"
                                    :required="false"
                                    :value="setting('general', $language->code)->about ?? ''" />

                                <x-input.text
                                    name="copyright[{{ $language->code }}]"
                                    label="global.copyright"
                                    :required="false"
                                    :value="setting('general', $language->code)->copyright ?? ''" />

                            </div>
                        </div>
                    @endforeach

                    {{-- Phone + Email --}}
                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <x-input.text
                            name="phone"
                            label="global.phone"
                            :required="false"
                            :value="setting('general')->phone ?? ''" />

                        <x-input.text
                            name="email"
                            label="global.email"
                            :required="false"
                            :value="setting('general')->email ?? ''" />
                    </div>

                </div>

                <x-dashboard.admin.button.save />

            </form>

        </div>

    </div>

</x-dashboard.admin.layout.app>
