<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function index()
    {
        try {
            $payments = Payment::with('client')->paginate(10);
            return view('payments.index', compact('payments'));
        } catch (\Exception $e) {
            Log::error('Error fetching payments: ' . $e->getMessage());
            return back()->with('error', 'Unable to fetch payments.');
        }
    }

    public function create()
    {
        try {
            $clients = Client::all();
            return view('payments.create', compact('clients'));
        } catch (\Exception $e) {
            Log::error('Error loading payment create form: ' . $e->getMessage());
            return back()->with('error', 'Unable to load create payment form.');
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'client_id' => 'required|exists:clients,id',
                'amount' => 'required|numeric|min:0',
            ]);

            Payment::create($validated);
			
			
			
            return redirect()->route('payments.index');
        } catch (\Exception $e) {
            Log::error('Error creating payment: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Unable to create payment.');
        }
    }

    public function edit(Payment $payment)
    {
        try {
            $clients = Client::all();
            return view('payments.edit', compact('payment', 'clients'));
        } catch (\Exception $e) {
            Log::error('Error loading payment edit form: ' . $e->getMessage());
            return back()->with('error', 'Unable to load edit payment form.');
        }
    }

    public function update(Request $request, Payment $payment)
    {
        try {
            $validated = $request->validate([
                'client_id' => 'required|exists:clients,id',
                'amount' => 'required|numeric|min:0',
            ]);

            $payment->update($validated);
            return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating payment: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Unable to update payment.');
        }
    }

    public function destroy(Payment $payment)
    {
        try {
            $payment->delete();
            return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting payment: ' . $e->getMessage());
            return back()->with('error', 'Unable to delete payment.');
        }
    }
}