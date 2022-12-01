<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Role: User") }}
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-2 mt-5">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h6 class="text-white">Restaurant Tables reservation</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('reservation-step-two-store') }}">
                                        @csrf
                                        <div class="sm:col-span-6 mt-3">
                                            <label for="status" class="block text-sm font-medium text-gray-700">Restaurant</label>
                                            <div class="mt-1">
                                                <select class="selectpicker" multiple data-live-search="true"
                                                        name="restaurant_tables[]">
                                                    @foreach($tables as $key => $table)
                                                        <option value="{{ $table['id'] }}">{{ 'Seats (' . $table['seats'] . ')'}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('restaurant_tables')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @for($i = 1; $i <= $guestsAmount; $i++)
                                            <div class="mt-2">
                                                <div class="sm:col-span-6 mt-5">
                                                    <label for="name" class="block text-sm font-medium text-gray-700">
                                                       Guests {{$i}} Name
                                                    </label>
                                                    <div class="mt-1">
                                                        <input type="text" name="guests[{{$i - 1}}][name]"
                                                               value="{{ $reservation->guests[$i - 1]['name'] ?? '' }}"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                                    </div>
                                                    @error('guests.' . $i . '.name')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="sm:col-span-6 mt-3">
                                                    <label for="surname" class="block text-sm font-medium text-gray-700">
                                                        Guests {{$i}} Surname
                                                    </label>
                                                    <div class="mt-1">
                                                        <input type="text" name="guests[{{$i - 1}}][surname]"
                                                               value="{{ $reservation->guests[$i - 1]['surname'] ?? '' }}"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                                    </div>
                                                    @error('guests.' . $i . '.surname')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="sm:col-span-6 mt-3">
                                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                                        Guests {{$i}} Email </label>
                                                    <div class="mt-1">
                                                        <input type="email" name="guests[{{$i - 1}}][email]"
                                                               value="{{ $reservation->guests[$i - 1]['email'] ?? '' }}"
                                                               class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                                    </div>
                                                    @error('guests.' . $i . '.email')
                                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endfor

                                        <div class="mt-6 p-4 flex justify-end">
                                            <button type="submit"
                                                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                                                Reserve
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
