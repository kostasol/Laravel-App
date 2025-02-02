<?php

namespace App\Services;

use App\Models\Client;
use Yajra\DataTables\Services\DataTable;

class ClientDataTable extends DataTable
{
        public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('latest_payment', function ($client) {
                if (request()->filled(['start_date', 'end_date'])) {
                    $paymentInRange = $client->payments()
                        ->whereBetween('created_at', [
                            request('start_date') . ' 00:00:00',
                            request('end_date') . ' 23:59:59'
                        ])
                        ->latest()
                        ->first();
                    
                    if ($paymentInRange) {
                        return '$ ' . number_format($paymentInRange->amount, 2);
                    }
                    return 'No payments in selected period';
                }

                return $client->latestPayment 
                    ? '$ ' . number_format($client->latestPayment->amount, 2) 
                    : 'No payments';
            })
            ->addColumn('action', function($client) {
                return '<div class="flex space-x-2">
                    <a href="'.route('clients.edit', $client).'" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    <form action="'.route('clients.destroy', $client).'" method="POST" class="inline">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                    </form>
                </div>';
            })
            ->rawColumns(['action']);
    }

    public function query(Client $model)
    {
        return $model->newQuery()
            ->with(['payments' => function($query) {
                if (request()->filled(['start_date', 'end_date'])) {
                    $query->whereBetween('created_at', [
                        request('start_date') . ' 00:00:00',
                        request('end_date') . ' 23:59:59'
                    ]);
                }
            }]);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('clients-table')
            ->columns($this->getColumns())
            ->minifiedAjax('', null, ['start_date', 'end_date'])
            ->orderBy(1)
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => [],
                'responsive' => true,
                'autoWidth' => false,

                'createdRow' => "function(row, data, dataIndex) {
                    $(row).addClass('bg-white dark:bg-gray-700');
                    $('td', row).addClass('px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white');
                }",
                'drawCallback' => "function() {
                    $('.dataTables_wrapper').addClass('dark:bg-gray-800 dark:text-white-100');
                }"
            ]);
    }

    protected function getColumns()
    {
        return [
            'name' => ['title' => 'Name', 'data' => 'name', 'name' => 'name'],
            'surname' => ['title' => 'Surname', 'data' => 'surname', 'name' => 'surname'],
            'latest_payment' => ['title' => 'Latest Payment', 'data' => 'latest_payment', 'name' => 'latest_payment'],
            'action' => ['title' => 'Actions', 'data' => 'action', 'name' => 'action', 'orderable' => false, 'searchable' => false],
        ];
    }

    protected function getBuilderParameters(): array
    {
        return [
            'order' => [[0, 'asc']],
            'initComplete' => "function() {
                $('.dataTables_wrapper').addClass('dark:bg-gray-800 dark:text-white');
                $('#clients-table tbody tr').addClass('dark:text-white');
            }"
        ];
    }
}