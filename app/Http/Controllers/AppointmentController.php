<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Enums\AppointmentStatus;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
        {
            $query = Appointment::query();

            //Se o front-end enviou um termo de busca
            if ($request->filled('search')) {
                $query->where('customer_name', 'like', '%' . $request->search . '%');
            }

            return AppointmentResource::collection($query->paginate(10));

        }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $data = $request->validated();
        $data['status'] = AppointmentStatus::SCHEDULED;

        $appointment = Appointment::create($data);

        return new AppointmentResource($appointment);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());
        return new AppointmentResource($appointment);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return response()->noContent();
    }
}
