<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrescriptionRequest;
use App\Http\Requests\QuotationRequest;
use App\Models\Prescription;
use App\Models\Quotation;
use App\Services\PrescriptionService;
use App\Services\QuotationService;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuotationNotification;

use Illuminate\Http\Request;

class QuotationController extends Controller
{
    protected $service;

    public function __construct(QuotationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        // Get quotations for prescriptions that belong to the authenticated user
        $quotations = Quotation::whereHas('prescription', function($query) {
            $query->where('user_id', auth()->id()); // Only get quotations for prescriptions owned by the logged-in user
        })->get();

        return view('quotations.index', compact('quotations'));
    }



    public function store(QuotationRequest $request, Prescription $prescription)
    {
        $quotation = $this->service->create($request->validated(), $prescription);

        // // Send email notification
        // Mail::to($prescription->user->email)->send(new QuotationNotification($quotation));

        return redirect()->route('pharmacy.prescriptions.index')
            ->with('success', 'Quotation prepared and sent to the user.');
    }

    public function updateStatus(Request $request, Quotation $quotation)
    {
        $request->validate(['status' => 'required|in:accepted,rejected']);
        $quotation->update(['status' => $request->status]);

        // Notify Pharmacy
        // $pharmacyEmail = config('app.pharmacy_email');
        // Mail::to($pharmacyEmail)->send(new QuotationStatusNotification($quotation));

        return redirect()->route('prescriptions.index')
            ->with('success', 'Quotation status updated successfully.');
    }

    public function create(Prescription $prescription)
    {
        return view('pharmacy.quotations.create', compact('prescription'));
    }

}
