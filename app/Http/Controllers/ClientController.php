<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    public function index()
    {
        try {
            $clients = Client::paginate(10);
            return view('clients.index', compact('clients'));
        } catch (\Exception $e) {
            Log::error('Error fetching clients: ' . $e->getMessage());
            return back()->with('error', 'Unable to fetch clients.');
        }
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
            ]);

            Client::create($validated);
            return redirect()->route('clients.index')->with('success', 'Client created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating client: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Unable to create client.');
        }
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
            ]);

            $client->update($validated);
            return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating client: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Unable to update client.');
        }
    }

    public function destroy(Client $client)
    {
        try {
            $client->delete();
            return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting client: ' . $e->getMessage());
            return back()->with('error', 'Unable to delete client.');
        }
    }
}