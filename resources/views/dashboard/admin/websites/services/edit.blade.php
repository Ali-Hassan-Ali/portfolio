<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.websites') . ' - ' . trans('admin.models.services') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.services') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

            <form method="post" action="{{ route('dashboard.admin.websites.services.update', ['service' => $service->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('put')

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
					
					<div id="tab_{{ $language->code }}" class="{{ $loop->first ? '' : 'hidden' }}">
					
						<div class="grid grid-cols-1 gap-4">

							<x-input.text name="name[{{ $language->code }}]" label="global.name" :value="$service->getTranslations('name')[$language->code] ?? ''"  :required="$loop->first" />

							<x-input.textarea name="description[{{ $language->code }}]" label="global.description" :value="$service->getTranslations('description')[$language->code] ?? ''"  :required="$loop->first" />

						</div>

					</div>

				@endforeach
				
				<div class="flex gap-4 items-center mt-3">

                    {{-- Icon Preview --}}
                    <div class="flex items-center justify-center w-14 h-14 py-2 rounded-xl bg-primary shadow shrink-0">
                        <span class="material-symbols-outlined text-white text-4xl" id="icon-live-preview">
                            category
                        </span>
                    </div>

                    {{-- Icon Input --}}
                    <div class="flex-1">
                        <label class="block text-sm font-medium mb-1">{{ trans('admin.global.icon') }}</label>
                        <input type="text"
                            name="icon"
                            id="icon-field"
                            value="{{ old('icon', $service->icon) }}"
                            placeholder="مثال: devices, shopping_cart, phone_android, mail"
                            class="kt-input block w-full"
                            oninput="document.getElementById('icon-live-preview').textContent = this.value.trim() || 'category'" />
                        <a href="https://fonts.google.com/icons" target="_blank"
                            class="text-xs text-primary hover:underline mt-1 inline-block">
                            تصفح أيقونات Google Fonts
                        </a>
                    </div>

                    {{-- Status --}}
                    <div class="flex flex-col gap-1 shrink-0">
                        <x-input.checkbox :label="false" :value="$service->status" />
                    </div>

				</div>

                <x-dashboard.admin.button.save />

            </form>

        </div>

    </div>

</x-dashboard.admin.layout.app>
