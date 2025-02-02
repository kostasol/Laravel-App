<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <!-- Date Range Filter -->
                    <div class="mb-4">
                        <form id="filter-form" class="flex space-x-4">
                            <div>
                                <x-input-label for="start_date" :value="__('Start Date')" />
                                <x-text-input id="start_date" type="date" name="start_date" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="end_date" :value="__('End Date')" />
                                <x-text-input id="end_date" type="date" name="end_date" class="mt-1" />
                            </div>
                            <div class="flex items-end">
                                <x-primary-button type="button" id="filter-btn">
                                    {{ __('Filter') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                    <!-- DataTable -->
                    <div class="overflow-x-auto">
                        <table id="clients-table" class="min-w-full">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Latest Payment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(function() {
            let table = $('#clients-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("dashboard") }}',
                    data: function(d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                    }
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                    {data: 'latest_payment', name: 'latest_payment'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            $('#filter-btn').click(function() {
                table.draw();
            });
        });
    </script>
    @endpush
</x-app-layout>