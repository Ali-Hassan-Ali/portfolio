<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.websites') . ' - ' . trans('admin.websites.hero') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.websites.hero') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

            <form method="post" action="{{ route('dashboard.admin.websites.hero.store') }}">
                @csrf

                <div class="p-6">

                    {{-- Language Tabs --}}
                    <div class="kt-tabs kt-tabs-line mb-6" data-kt-tabs="true">
                        @foreach (getLanguages() as $language)
                            <button type="button" class="kt-tab-toggle py-3 flex items-center gap-2 {{ $loop->first ? 'active' : '' }}" data-kt-tab-toggle="#tab_{{ $language->code }}">
                                <img src="{{ asset('admin_assets/media/flags/' . $language->flag) }}" class="w-5 h-5 rounded-full object-cover" onerror="this.style.display='none'" alt="{{ $language->name }}" />
                                {{ $language->name }}
                            </button>
                        @endforeach
                    </div>

                    {{-- Tab Content --}}
                    @foreach (getLanguages() as $language)
                        @php $isFirst = $loop->first; @endphp

                        <div id="tab_{{ $language->code }}" class="{{ $isFirst ? '' : 'hidden' }}">

                            <div class="grid grid-cols-3 gap-4 mb-6">

                                <x-input.text
                                    name="badge[{{ $language->code }}]"
                                    label="global.badge"
                                    :required="false"
                                    :value="setting('hero', $language->code)->badge ?? ''" />

                                <x-input.text
                                    name="title[{{ $language->code }}]"
                                    label="global.title"
                                    :required="$isFirst"
                                    :value="setting('hero', $language->code)->title ?? ''" />

                                <x-input.text
                                    name="sub_title[{{ $language->code }}]"
                                    label="global.sub_title"
                                    :required="$isFirst"
                                    :value="setting('hero', $language->code)->sub_title ?? ''" />

                            </div>

                            {{-- 3 Feature Cards --}}
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">{{ trans('admin.websites.hero_features') }}</p>

                            {{-- Row 1: Feature 1 + Feature 2 --}}
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                @for ($i = 0; $i < 2; $i++)
                                    @php
                                        $savedTitle = setting('hero', $language->code)->getValue("features.$i.title") ?? '';
                                        $savedDesc  = setting('hero', $language->code)->getValue("features.$i.description") ?? '';
                                    @endphp
                                    <div class="border border-gray-100 rounded-xl p-4 bg-gray-50/50">
                                        <p class="text-xs font-bold text-primary mb-3">{{ trans('admin.websites.feature') }} {{ $i + 1 }}</p>
                                        <x-input.text
                                            name="features[{{ $i }}][title][{{ $language->code }}]"
                                            label="global.title"
                                            :required="$isFirst"
                                            :value="$savedTitle" />
                                        <x-input.textarea
                                            name="features[{{ $i }}][description][{{ $language->code }}]"
                                            label="global.description"
                                            :required="$isFirst"
                                            :value="$savedDesc" />
                                    </div>
                                @endfor
                            </div>

                            {{-- Row 2: Icons + Feature 3 --}}
                            <div class="grid grid-cols-2 gap-4">

                                {{-- Icons (left) --}}
                                <div class="border border-gray-100 rounded-xl p-4 bg-gray-50/50">
                                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-3">{{ trans('admin.websites.feature_icons') }}</p>
                                    <div class="flex flex-col gap-3">
                                        @for ($i = 0; $i < 3; $i++)
                                            @php $savedIcon = setting('hero')->getValue("features.$i.icon") ?? ''; @endphp
                                            <div class="flex gap-3 items-center">
                                                <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary shadow shrink-0">
                                                    <span class="material-symbols-outlined text-white text-xl" id="icon-preview-{{ $i }}">{{ $savedIcon ?: 'star' }}</span>
                                                </div>
                                                <input
                                                    type="text"
                                                    name="features[{{ $i }}][icon]"
                                                    value="{{ $savedIcon }}"
                                                    placeholder="{{ trans('admin.websites.feature') }} {{ $i + 1 }}"
                                                    class="kt-input block w-full"
                                                    oninput="document.getElementById('icon-preview-{{ $i }}').textContent = this.value.trim() || 'star'" />
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                {{-- Feature 3 (right) --}}
                                @php
                                    $savedTitle = setting('hero', $language->code)->getValue("features.2.title") ?? '';
                                    $savedDesc  = setting('hero', $language->code)->getValue("features.2.description") ?? '';
                                @endphp
                                <div class="border border-gray-100 rounded-xl p-4 bg-gray-50/50">
                                    <p class="text-xs font-bold text-primary mb-3">{{ trans('admin.websites.feature') }} 3</p>
                                    <x-input.text
                                        name="features[2][title][{{ $language->code }}]"
                                        label="global.title"
                                        :required="$isFirst"
                                        :value="$savedTitle" />
                                    <x-input.textarea
                                        name="features[2][description][{{ $language->code }}]"
                                        label="global.description"
                                        :required="$isFirst"
                                        :value="$savedDesc" />
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

                <x-input.checkbox :value="setting('hero')->status" />

                <x-dashboard.admin.button.save />

            </form>

        </div>

    </div>

</x-dashboard.admin.layout.app>
