<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ClientDataTable;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $clientDataTable;

    public function __construct(ClientDataTable $clientDataTable)
    {
        $this->clientDataTable = $clientDataTable;
    }

	public function index(Request $request)
	{
		try {
			if ($request->ajax()) {
				$query = Client::with('latestPayment')
					->when($request->filled(['start_date', 'end_date']), function($query) use ($request) {
						$query->whereHas('payments', function($q) use ($request) {
							$q->whereBetween('created_at', [
								$request->start_date . ' 00:00:00',
								$request->end_date . ' 23:59:59'
							]);
						});
					});
				
				return $this->clientDataTable->with('query', $query)->ajax();
			}

			return view('dashboard');
		} catch (\Exception $e) {
			\Log::error('Dashboard error: ' . $e->getMessage());
			return back()->with('error', 'An error occurred while loading the dashboard.');
		}
	}
}
