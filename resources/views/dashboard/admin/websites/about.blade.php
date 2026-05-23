<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.websites') . ' - ' . trans('admin.websites.about') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.websites.about') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

            <form method="post" action="{{ route('dashboard.admin.websites.about.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="p-6">

                    {{-- Image --}}
                    <div class="p-4 border rounded-xl bg-gray-50 flex justify-center items-center mt-5">

                        <div class="w-full max-w-[220px] flex justify-center">
                            <x-input.image :value="asset('storage/' . setting('about')->image_path)"/>
                        </div>

                    </div>

                    {{-- Language Tabs --}}
                    <div class="kt-tabs kt-tabs-line mb-6" data-kt-tabs="true">
                        @foreach (getLanguages() as $language)
                            <button type="button" class="kt-tab-toggle py-3 flex items-center gap-2 {{ $loop->first ? 'active' : '' }}" data-kt-tab-toggle="#about_tab_{{ $language->code }}">
                                <img src="{{ asset('admin_assets/media/flags/' . $language->flag) }}" class="w-5 h-5 rounded-full object-cover" onerror="this.style.display='none'" alt="{{ $language->name }}" />
                                {{ $language->name }}
                            </button>
                        @endforeach
                    </div>

                    {{-- Tab Content --}}
                    @foreach (getLanguages() as $language)
                        @php $isFirst = $loop->first; @endphp

                        <div id="about_tab_{{ $language->code }}" class="{{ $isFirst ? '' : 'hidden' }}">

                            <div class="grid grid-cols-2 gap-4 mb-2">
                                <x-input.text
                                    name="badge[{{ $language->code }}]"
                                    label="global.badge"
                                    :required="false"
                                    :value="setting('about', $language->code)->badge ?? ''" />

                                <x-input.text
                                    name="title[{{ $language->code }}]"
                                    label="global.title"
                                    :required="$isFirst"
                                    :value="setting('about', $language->code)->title ?? ''" />
                            </div>

                            <div class="grid grid-cols-1 gap-4 mb-2">
                                <x-input.textarea
                                    name="description[{{ $language->code }}]"
                                    label="global.description"
                                    :required="$isFirst"
                                    :value="setting('about', $language->code)->description ?? ''" />
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <x-input.text
                                    name="stat_label[{{ $language->code }}]"
                                    label="global.stat_label"
                                    :required="false"
                                    :value="setting('about', $language->code)->stat_label ?? ''" />

                                <x-input.text
                                    name="learn_more[{{ $language->code }}]"
                                    label="global.learn_more"
                                    :required="false"
                                    :value="setting('about', $language->code)->learn_more ?? ''" />
                            </div>

                            {{-- 2 Highlights --}}
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">{{ trans('admin.websites.highlights') }}</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                @for ($i = 0; $i < 2; $i++)
                                    @php
                                        $savedTitle = setting('about', $language->code)->getValue("highlights.$i.title") ?? '';
                                        $savedDesc  = setting('about', $language->code)->getValue("highlights.$i.description") ?? '';
                                    @endphp

                                    <div class="border border-gray-100 rounded-xl p-4 bg-gray-50/50">
                                        <p class="text-xs font-bold text-primary mb-3">{{ trans('admin.websites.highlight') }} {{ $i + 1 }}</p>

                                        <x-input.text
                                            name="highlights[{{ $i }}][title][{{ $language->code }}]"
                                            label="global.title"
                                            :required="false"
                                            :value="$savedTitle" />

                                        <x-input.textarea
                                            name="highlights[{{ $i }}][description][{{ $language->code }}]"
                                            label="global.description"
                                            :required="false"
                                            :value="$savedDesc" />
                                    </div>
                                @endfor

                            </div>

                        </div>
                    @endforeach

                    {{-- Stat Number + Status --}}
                    <div class="mt-6 grid grid-cols-2 gap-4 items-end">
                        <x-input.text
                            name="stat_number"
                            label="global.stat_number"
                            :required="false"
                            :value="setting('about')->stat_number ?? ''" />

                        <div>
                            <x-input.checkbox :value="setting('about')->status" />
                        </div>
                    </div>

                </div>

                <x-dashboard.admin.button.save />

            </form>

        </div>

    </div>

</x-dashboard.admin.layout.app>
