<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.websites') . ' - ' . trans('admin.websites.cta') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.websites.cta') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

            <form method="post" action="{{ route('dashboard.admin.websites.cta.store') }}">
                @csrf

                <div class="p-6">

                    {{-- Language Tabs --}}
                    <div class="kt-tabs kt-tabs-line mb-6" data-kt-tabs="true">
                        @foreach (getLanguages() as $language)
                            <button type="button" class="kt-tab-toggle py-3 flex items-center gap-2 {{ $loop->first ? 'active' : '' }}" data-kt-tab-toggle="#cta_tab_{{ $language->code }}">
                                <img src="{{ asset('admin_assets/media/flags/' . $language->flag) }}" class="w-5 h-5 rounded-full object-cover" onerror="this.style.display='none'" alt="{{ $language->name }}" />
                                {{ $language->name }}
                            </button>
                        @endforeach
                    </div>

                    {{-- Tab Content --}}
                    @foreach (getLanguages() as $language)
                        @php $isFirst = $loop->first; @endphp

                        <div id="cta_tab_{{ $language->code }}" class="{{ $isFirst ? '' : 'hidden' }}">

                            <div class="grid grid-cols-1 gap-4 mb-4">
                                <x-input.text
                                    name="title[{{ $language->code }}]"
                                    label="global.title"
                                    :required="$isFirst"
                                    :value="setting('cta', $language->code)->title ?? ''" />

                                <x-input.textarea
                                    name="description[{{ $language->code }}]"
                                    label="global.description"
                                    :required="$isFirst"
                                    :value="setting('cta', $language->code)->description ?? ''" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <x-input.text
                                    name="btn_primary[{{ $language->code }}]"
                                    label="global.btn_primary"
                                    :required="false"
                                    :value="setting('cta', $language->code)->btn_primary ?? ''" />

                                <x-input.text
                                    name="btn_secondary[{{ $language->code }}]"
                                    label="global.btn_secondary"
                                    :required="false"
                                    :value="setting('cta', $language->code)->btn_secondary ?? ''" />
                            </div>

                        </div>
                    @endforeach

                </div>

                <x-input.checkbox :value="setting('cta')->status" />

                <x-dashboard.admin.button.save />

            </form>

        </div>

    </div>

</x-dashboard.admin.layout.app>
