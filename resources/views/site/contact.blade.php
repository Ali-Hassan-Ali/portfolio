<x-site.layout.app>

    <x-site.sections.navbar />

    <main class="pt-32 pb-24 px-6 md:px-12 max-w-7xl mx-auto">

        {{-- Hero --}}
        <header class="mb-20 flex flex-col md:flex-row justify-between items-end gap-8">
            <div class="max-w-2xl">
                <span class="text-secondary font-bold tracking-widest text-xs uppercase mb-4 block">
                    @setting('contact', 'badge')
                </span>
                <h1 class="text-primary font-montserrat font-black text-5xl md:text-7xl leading-tight tracking-tighter mb-6">
                    @setting('contact', 'title')
                </h1>
                <p class="text-on-surface-variant text-lg leading-relaxed max-w-xl">
                    @setting('contact', 'description')
                </p>
            </div>
            <div class="flex items-center gap-4 pb-4 shrink-0">
                <div class="h-px w-12 bg-outline-variant"></div>
                <span class="text-on-surface-variant text-sm font-medium">@setting('contact', 'headquarters')</span>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            {{-- ===== Left: Calendar + Map ===== --}}
            <section class="lg:col-span-5 space-y-8">

                {{-- Booking Calendar --}}
                <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border border-outline-variant/30"
                     x-data="appointmentCalendar()">

                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-primary font-bold text-xl">@setting('contact', 'consultation_title')</h2>
                        <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold uppercase">
                            {{ trans('site.contact.live_schedule') }}
                        </span>
                    </div>

                    {{-- Calendar Nav --}}
                    <div class="flex items-center justify-between mb-6">
                        <button type="button" @click="prevMonth"
                                class="p-2 hover:bg-surface-container-high rounded-full transition-colors text-primary">
                            <span class="material-symbols-outlined align-middle">{{ app()->isLocale('ar') ? 'chevron_right' : 'chevron_left' }}</span>
                        </button>
                        <span class="font-bold text-primary" x-text="monthLabel"></span>
                        <button type="button" @click="nextMonth"
                                class="p-2 hover:bg-surface-container-high rounded-full transition-colors text-primary">
                            <span class="material-symbols-outlined align-middle">{{ app()->isLocale('ar') ? 'chevron_left' : 'chevron_right' }}</span>
                        </button>
                    </div>

                    {{-- Day Headers --}}
                    <div class="grid grid-cols-7 gap-2 mb-3 text-center text-xs font-bold text-outline uppercase tracking-wider">
                        @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $d)
                            <div>{{ $d }}</div>
                        @endforeach
                    </div>

                    {{-- Days Grid --}}
                    <div class="grid grid-cols-7 gap-2">
                        <template x-for="(day, i) in calendarDays" :key="i">
                            <div class="h-10 flex items-center justify-center rounded-lg text-sm transition-all"
                                 :class="{
                                     'text-outline-variant cursor-default': !day.current,
                                     'cursor-pointer hover:bg-surface-container-high font-medium text-on-surface': day.current && !day.past && !day.selected,
                                     'accent-gradient text-white font-bold shadow-lg': day.selected,
                                     'opacity-40 cursor-not-allowed': day.past && day.current,
                                 }"
                                 @click="day.current && !day.past && selectDate(day)">
                                <span x-text="day.label"></span>
                            </div>
                        </template>
                    </div>

                    {{-- Time Slots --}}
                    <div class="mt-8 space-y-4">
                        <h3 class="text-sm font-bold text-on-surface-variant uppercase tracking-wide">
                            {{ trans('site.contact.available_slots') }}
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            <template x-for="slot in slots" :key="slot">
                                <button type="button"
                                        class="py-3 px-4 rounded-xl border text-primary text-sm font-bold transition-all"
                                        :class="selectedSlot === slot
                                            ? 'border-primary bg-primary/5'
                                            : 'border-outline-variant/30 hover:border-primary'"
                                        @click="selectedSlot = slot"
                                        x-text="slot">
                                </button>
                            </template>
                            <p x-show="selectedDate && slots.length === 0"
                               class="col-span-2 text-center text-sm text-outline-variant py-4">
                                {{ __('لا توجد مواعيد متاحة في هذا اليوم') }}
                            </p>
                        </div>
                    </div>

                    {{-- Appointment Mini-Form --}}
                    <div x-show="selectedDate && selectedSlot" x-cloak class="mt-6 space-y-3">
                        <input x-model="apptName" type="text"
                               placeholder="{{ trans('site.contact.full_name') }}"
                               class="w-full bg-surface-container-low border-none rounded-xl py-3 px-5 text-sm text-on-surface focus:ring-2 focus:ring-primary/20" />
                        <input x-model="apptEmail" type="email"
                               placeholder="{{ trans('site.contact.business_email') }}"
                               class="w-full bg-surface-container-low border-none rounded-xl py-3 px-5 text-sm text-on-surface focus:ring-2 focus:ring-primary/20" />
                        <input x-model="apptPhone" type="tel"
                               placeholder="{{ trans('site.phone') }}"
                               class="w-full bg-surface-container-low border-none rounded-xl py-3 px-5 text-sm text-on-surface focus:ring-2 focus:ring-primary/20" />
                    </div>

                    <button type="button" @click="submitAppointment"
                            :disabled="!selectedDate || !selectedSlot || apptLoading"
                            class="w-full mt-6 signature-gradient text-white py-4 rounded-xl font-bold text-sm tracking-widest uppercase flex items-center justify-center gap-2 shadow-xl shadow-primary/20 disabled:opacity-50 disabled:cursor-not-allowed transition-opacity">
                        <span x-show="!apptLoading">{{ trans('site.contact.confirm_appointment') }}</span>
                        <span x-show="apptLoading">...</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">
                            {{ app()->isLocale('ar') ? 'arrow_back' : 'arrow_right_alt' }}
                        </span>
                    </button>

                    {{-- Feedback --}}
                    <p x-show="apptMessage" x-text="apptMessage"
                       :class="apptSuccess ? 'text-green-600' : 'text-red-500'"
                       class="mt-3 text-sm text-center font-medium"></p>

                </div>

                {{-- Office Map --}}
                <div class="bg-surface-container-low rounded-xl overflow-hidden group border border-outline-variant/30">
                    <div class="h-48 w-full relative overflow-hidden">
                        @php $officeImg = setting('contact')->getValue('office_image'); @endphp
                        @if($officeImg)
                            <img src="{{ asset('storage/' . $officeImg) }}"
                                 class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700"
                                 alt="Office" />
                        @else
                            <div class="w-full h-full bg-surface-container-highest"></div>
                        @endif
                        <div class="absolute inset-0 bg-primary/10"></div>
                        <div class="absolute bottom-4 start-4 glass-card px-4 py-2 rounded-lg flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">location_on</span>
                            <span class="text-xs font-bold text-primary uppercase">@setting('contact', 'address')</span>
                        </div>
                    </div>
                </div>

            </section>

            {{-- ===== Right: Forms ===== --}}
            <section class="lg:col-span-7">
                <div class="glass-card rounded-xl p-8 md:p-12 shadow-2xl border border-outline-variant/30"
                     x-data="contactForms()">

                    {{-- Tab Buttons --}}
                    <div class="flex gap-8 border-b border-outline-variant/20 mb-10 overflow-x-auto">
                        <button type="button"
                                class="pb-4 font-bold text-lg whitespace-nowrap transition-colors"
                                :class="tab === 'rfq' ? 'text-primary border-b-2 border-secondary' : 'text-on-surface-variant hover:text-primary'"
                                @click="tab = 'rfq'">
                            {{ trans('site.contact.tab_rfq') }}
                        </button>
                        <button type="button"
                                class="pb-4 font-bold text-lg whitespace-nowrap transition-colors"
                                :class="tab === 'quick' ? 'text-primary border-b-2 border-secondary' : 'text-on-surface-variant hover:text-primary'"
                                @click="tab = 'quick'">
                            {{ trans('site.contact.tab_quick') }}
                        </button>
                    </div>

                    {{-- ===== RFQ Form ===== --}}
                    <form x-show="tab === 'rfq'" @submit.prevent="submitForm('rfq')" class="space-y-8">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.full_name') }}</label>
                                <input x-model="rfq.name" type="text" placeholder="John Doe"
                                       class="w-full bg-surface-container-low border-none rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/20 text-on-surface" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.business_email') }}</label>
                                <input x-model="rfq.email" type="email" placeholder="john@company.com"
                                       class="w-full bg-surface-container-low border-none rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/20 text-on-surface" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.company_name') }}</label>
                                <input x-model="rfq.company_name" type="text" placeholder="Global Enterprise"
                                       class="w-full bg-surface-container-low border-none rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/20 text-on-surface" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.activity_type') }}</label>
                                <select x-model="rfq.activity_type"
                                        class="w-full bg-surface-container-low border-none rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/20 appearance-none text-on-surface">
                                    <option value="">{{ trans('site.select') }}</option>
                                    <option value="web_dev">Web & App Development</option>
                                    <option value="digital_marketing">Digital Marketing</option>
                                    <option value="branding">Branding</option>
                                    <option value="content">Content Creation</option>
                                    <option value="seo">SEO Optimization</option>
                                    <option value="consultancy">Business Consultancy</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.budget_range') }}</label>
                                <span class="text-xs font-bold text-secondary" x-text="budgetLabel"></span>
                            </div>
                            <input x-model="rfq.budget_range" type="range" min="0" max="100"
                                   class="w-full h-1.5 bg-surface-container-highest rounded-lg appearance-none cursor-pointer accent-secondary" />
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.project_scope') }}</label>
                            <textarea x-model="rfq.project_scope" rows="5"
                                      placeholder="{{ trans('site.contact.scope_placeholder') }}"
                                      class="w-full bg-surface-container-low border-none rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/20 text-on-surface"></textarea>
                        </div>

                        <div class="flex items-center gap-3">
                            <input x-model="rfq.agreed" type="checkbox" id="terms-rfq"
                                   class="rounded border-outline-variant text-secondary focus:ring-secondary" />
                            <label for="terms-rfq" class="text-sm text-on-surface-variant">
                                {!! trans('site.contact.privacy_agree', ['link' => '<a href="#" class="text-primary underline font-medium">' . trans('site.contact.privacy_policy') . '</a>']) !!}
                            </label>
                        </div>

                        <p x-show="formMessage" x-text="formMessage"
                           :class="formSuccess ? 'text-green-600' : 'text-red-500'"
                           class="text-sm font-medium"></p>

                        <button type="submit" :disabled="loading"
                                class="w-full signature-gradient text-white py-5 rounded-xl font-bold text-base tracking-[0.2em] uppercase shadow-2xl shadow-primary/30 hover:scale-[1.02] active:scale-95 transition-all disabled:opacity-60">
                            <span x-show="!loading">{{ trans('site.contact.submit_rfq') }}</span>
                            <span x-show="loading">...</span>
                        </button>

                    </form>

                    {{-- ===== Quick Contact Form ===== --}}
                    <form x-show="tab === 'quick'" @submit.prevent="submitForm('quick')" class="space-y-6" x-cloak>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.full_name') }}</label>
                                <input x-model="quick.name" type="text" placeholder="{{ trans('site.enter_name') }}"
                                       class="w-full bg-surface-container-low border-none rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/20 text-on-surface" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.email') }}</label>
                                <input x-model="quick.email" type="email" placeholder="{{ trans('site.enter_email') }}"
                                       class="w-full bg-surface-container-low border-none rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/20 text-on-surface" />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.phone') }}</label>
                            <input x-model="quick.phone" type="tel" placeholder="{{ trans('site.enter_phone') }}"
                                   class="w-full bg-surface-container-low border-none rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/20 text-on-surface" />
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.message') }}</label>
                            <textarea x-model="quick.message" rows="5" placeholder="{{ trans('site.enter_message') }}"
                                      class="w-full bg-surface-container-low border-none rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/20 text-on-surface"></textarea>
                        </div>

                        <p x-show="formMessage" x-text="formMessage"
                           :class="formSuccess ? 'text-green-600' : 'text-red-500'"
                           class="text-sm font-medium"></p>

                        <button type="submit" :disabled="loading"
                                class="w-full signature-gradient text-white py-5 rounded-xl font-bold text-base tracking-[0.2em] uppercase shadow-2xl shadow-primary/30 hover:scale-[1.02] active:scale-95 transition-all disabled:opacity-60">
                            <span x-show="!loading">{{ trans('site.contact.send_message') }}</span>
                            <span x-show="loading">...</span>
                        </button>

                    </form>

                </div>
            </section>

        </div>

    </main>

    @push('scripts')
    @php
        $defaultSlots = ['09:00 AM', '10:30 AM', '01:15 PM', '03:45 PM'];
        $timeSlots    = setting('contact')->getValue('time_slots') ?? $defaultSlots;
        $timeSlots    = is_array($timeSlots) && count($timeSlots) ? $timeSlots : $defaultSlots;
    @endphp
    <script>
        const CSRF = '{{ csrf_token() }}';
        const ROUTES = {
            contact:     '{{ route('contact.store') }}',
            appointment: '{{ route('contact.appointment.store') }}',
            slots:       '{{ route('contact.slots') }}',
        };

        function contactForms() {
            return {
                tab: 'rfq',
                loading: false,
                formMessage: '',
                formSuccess: false,

                rfq: { name: '', email: '', company_name: '', activity_type: '', budget_range: 70, project_scope: '', agreed: false },
                quick: { name: '', email: '', phone: '', message: '' },

                get budgetLabel() {
                    const v = parseInt(this.rfq.budget_range);
                    if (v < 20)  return '< 50k SAR';
                    if (v < 40)  return '50k – 100k SAR';
                    if (v < 60)  return '100k – 150k SAR';
                    if (v < 80)  return '150k – 200k SAR';
                    return '200k+ SAR';
                },

                async submitForm(type) {
                    this.formMessage = '';
                    this.loading = true;

                    const data = type === 'rfq'
                        ? { ...this.rfq, type: 'rfq' }
                        : { ...this.quick, type: 'quick' };

                    try {
                        const res = await fetch(ROUTES.contact, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                            body: JSON.stringify(data),
                        });

                        const json = await res.json();
                        this.formSuccess = json.success;
                        this.formMessage = json.message;

                        if (json.success) {
                            type === 'rfq'
                                ? this.rfq = { name: '', email: '', company_name: '', activity_type: '', budget_range: 70, project_scope: '', agreed: false }
                                : this.quick = { name: '', email: '', phone: '', message: '' };
                        }
                    } catch (e) {
                        this.formSuccess = false;
                        this.formMessage = 'Something went wrong. Please try again.';
                    } finally {
                        this.loading = false;
                    }
                },
            };
        }

        function appointmentCalendar() {
            return {
                today: new Date(),
                current: new Date(),
                selectedDate: null,
                selectedSlot: null,
                slots: @json($timeSlots),
                apptName: '', apptEmail: '', apptPhone: '',
                apptLoading: false, apptMessage: '', apptSuccess: false,

                get monthLabel() {
                    return this.current.toLocaleDateString('{{ app()->getLocale() }}', { month: 'long', year: 'numeric' });
                },

                get calendarDays() {
                    const year  = this.current.getFullYear();
                    const month = this.current.getMonth();
                    const first = new Date(year, month, 1).getDay();
                    const days  = new Date(year, month + 1, 0).getDate();
                    const result = [];

                    for (let i = 0; i < first; i++) {
                        const d = new Date(year, month, -first + i + 1);
                        result.push({ label: d.getDate(), current: false, past: true, date: null, selected: false });
                    }
                    for (let d = 1; d <= days; d++) {
                        const date = new Date(year, month, d);
                        const isSelected = this.selectedDate?.toDateString() === date.toDateString();
                        result.push({
                            label: d,
                            current: true,
                            past: date < new Date(this.today.getFullYear(), this.today.getMonth(), this.today.getDate()),
                            date,
                            selected: isSelected,
                        });
                    }
                    return result;
                },

                prevMonth() { this.current = new Date(this.current.getFullYear(), this.current.getMonth() - 1, 1); },
                nextMonth() { this.current = new Date(this.current.getFullYear(), this.current.getMonth() + 1, 1); },

                async selectDate(day) {
                    this.selectedDate = day.date;
                    this.selectedSlot = null;
                    const dateStr = day.date.toISOString().split('T')[0];

                    const res = await fetch(`${ROUTES.slots}?date=${dateStr}`);
                    this.slots = await res.json();
                },

                async submitAppointment() {
                    if (!this.selectedDate || !this.selectedSlot || !this.apptName || !this.apptEmail) return;

                    this.apptLoading = true;
                    this.apptMessage = '';

                    const data = {
                        name:      this.apptName,
                        email:     this.apptEmail,
                        phone:     this.apptPhone,
                        date:      this.selectedDate.toISOString().split('T')[0],
                        time_slot: this.selectedSlot,
                    };

                    try {
                        const res = await fetch(ROUTES.appointment, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                            body: JSON.stringify(data),
                        });

                        const json = await res.json();
                        this.apptSuccess = json.success;
                        this.apptMessage = json.message;

                        if (json.success) {
                            this.selectedDate = null;
                            this.selectedSlot = null;
                            this.apptName = this.apptEmail = this.apptPhone = '';
                        }
                    } catch (e) {
                        this.apptSuccess = false;
                        this.apptMessage = 'Something went wrong.';
                    } finally {
                        this.apptLoading = false;
                    }
                },
            };
        }
    </script>
    @endpush

    <x-site.sections.footer />

</x-site.layout.app>
