<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-4 px-6">
                            Booker ID
                        </th>
                        <th scope="col" class="py-4 px-6">
                            Restaurant Name
                        </th>
                        <th scope="col" class="py-4 px-6">
                            Reserved Restaurant Tables IDs
                        </th>
                        <th scope="col" class="py-4 px-6">
                            Reservation Date
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reservations as $reservation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $reservation->booker_id }}
                        </th>
                        <td class="py-4 px-6">
                            {{ $reservation->restaurant_name }}
                        </td>
                        <td class="py-4 px-6">
                            {{ json_encode($reservation->reserved_restaurant_tables_ids) }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $reservation->reservation_date }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-admin-layout>
