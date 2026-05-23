<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.websites') . ' - ' . trans('admin.websites.why_us') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.websites.why_us') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

            <form method="post" action="{{ route('dashboard.admin.websites.why_us.store') }}">
                @csrf

                <div class="p-6">

                    {{-- Language Tabs --}}
                    <div class="kt-tabs kt-tabs-line mb-6" data-kt-tabs="true">
                        @foreach (getLanguages() as $language)
                            <button type="button" class="kt-tab-toggle py-3 flex items-center gap-2 {{ $loop->first ? 'active' : '' }}" data-kt-tab-toggle="#why_us_tab_{{ $language->code }}">
                                <img src="{{ asset('admin_assets/media/flags/' . $language->flag) }}" class="w-5 h-5 rounded-full object-cover" onerror="this.style.display='none'" alt="{{ $language->name }}" />
                                {{ $language->name }}
                            </button>
                        @endforeach
                    </div>

                    {{-- Tab Content --}}
                    @foreach (getLanguages() as $language)
                        @php $isFirst = $loop->first; @endphp

                        <div id="why_us_tab_{{ $language->code }}" class="{{ $isFirst ? '' : 'hidden' }}">

                            {{-- Title + Description --}}
                            <div class="grid grid-cols-1 gap-4 mb-6">
                                <x-input.text
                                    name="title[{{ $language->code }}]"
                                    label="global.title"
                                    :required="$isFirst"
                                    :value="setting('why_us', $language->code)->title ?? ''" />

                                <x-input.textarea
                                    name="description[{{ $language->code }}]"
                                    label="global.description"
                                    :required="$isFirst"
                                    :value="setting('why_us', $language->code)->description ?? ''" />
                            </div>

                            {{-- Pillars + Features side by side --}}
                            <div class="grid grid-cols-2 gap-4">

                                {{-- Pillars (2) --}}
                                <div>
                                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">{{ trans('admin.websites.pillars') }}</p>
                                    <div class="flex flex-col gap-4">
                                        @for ($i = 0; $i < 2; $i++)
                                            <div class="border border-gray-100 rounded-xl p-4 bg-gray-50/50">
                                                <p class="text-xs font-bold text-primary mb-3">{{ trans('admin.websites.pillar') }} {{ $i + 1 }}</p>
                                                <x-input.text
                                                    name="pillars[{{ $i }}][title][{{ $language->code }}]"
                                                    label="global.title"
                                                    :required="false"
                                                    :value="setting('why_us', $language->code)->getValue('pillars.' . $i . '.title') ?? ''" />
                                                <x-input.textarea
                                                    name="pillars[{{ $i }}][description][{{ $language->code }}]"
                                                    label="global.description"
                                                    :required="false"
                                                    :value="setting('why_us', $language->code)->getValue('pillars.' . $i . '.description') ?? ''" />
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                {{-- Features (2) --}}
                                <div>
                                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">{{ trans('admin.websites.features') }}</p>
                                    <div class="flex flex-col gap-4">
                                        @for ($i = 0; $i < 2; $i++)
                                            <div class="border border-gray-100 rounded-xl p-4 bg-gray-50/50">
                                                <p class="text-xs font-bold text-secondary mb-3">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</p>
                                                <x-input.text
                                                    name="features[{{ $i }}][title][{{ $language->code }}]"
                                                    label="global.title"
                                                    :required="false"
                                                    :value="setting('why_us', $language->code)->getValue('features.' . $i . '.title') ?? ''" />
                                                <x-input.textarea
                                                    name="features[{{ $i }}][description][{{ $language->code }}]"
                                                    label="global.description"
                                                    :required="false"
                                                    :value="setting('why_us', $language->code)->getValue('features.' . $i . '.description') ?? ''" />
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

                <x-input.checkbox :value="setting('why_us')->status" />

                <x-dashboard.admin.button.save />

            </form>

        </div>

    </div>

</x-dashboard.admin.layout.app>
