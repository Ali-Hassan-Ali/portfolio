<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactRequest;
use App\Http\Requests\Site\AppointmentRequest;
use App\Models\Contact;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('site.contact');

    }//end of index

    public function storeContact(ContactRequest $request): JsonResponse
    {
        Contact::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => __('site.contact.success'),
        ]);

    }//end of storeContact

    public function storeAppointment(AppointmentRequest $request): JsonResponse
    {
        $available = (new Appointment)->isAvailable(
            $request->date,
            $request->time_slot
        );

        if (!$available) {
            return response()->json([
                'success' => false,
                'message' => __('site.contact.slot_taken'),
            ], 422);
        }

        Appointment::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => __('site.contact.appointment_success'),
        ]);

    }//end of storeAppointment

    public function availableSlots(): JsonResponse
    {
        $date  = request('date');
        $slots = setting('contact')->getValue('time_slots') ?? [];

        $booked = Appointment::where('date', $date)
                             ->where('status', '!=', 'cancelled')
                             ->pluck('time_slot')
                             ->toArray();

        $available = array_values(array_filter(
            is_array($slots) ? $slots : [],
            fn($slot) => !in_array($slot, $booked)
        ));

        return response()->json($available);

    }//end of availableSlots

}//end of controller
