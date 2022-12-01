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
                                    <form method="POST" action="{{ route('reservation-step-one-store') }}">
                                        @csrf
                                        <div class="sm:col-span-6">
                                            <label for="name" class="block text-sm font-medium text-gray-700"> Name
                                            </label>
                                            <div class="mt-1">
                                                <input type="text" name="booker[name]"
                                                       value="{{ $reservation->booker['name'] ?? '' }}"
                                                       class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                            </div>
                                            @error('booker.name')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="sm:col-span-6 mt-3">
                                            <label for="surname" class="block text-sm font-medium text-gray-700">
                                                Surname
                                            </label>
                                            <div class="mt-1">
                                                <input type="text" name="booker[surname]"
                                                       value="{{ $reservation->booker['surname'] ?? '' }}"
                                                       class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                            </div>
                                            @error('booker.surname')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="sm:col-span-6 mt-3">
                                            <label for="email" class="block text-sm font-medium text-gray-700">
                                                Email </label>
                                            <div class="mt-1">
                                                <input type="email" name="booker[email]"
                                                       value="{{ $reservation->booker['email'] ?? '' }}"
                                                       class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                            </div>
                                            @error('booker.email')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="sm:col-span-6 mt-3">
                                            <label for="phone" class="block text-sm font-medium text-gray-700"> Phone
                                                number
                                            </label>
                                            <div class="mt-1">
                                                <input type="text" name="booker[phone]" minlength="11" maxlength="11" placeholder="37061234567"
                                                       value="{{ $reservation->booker['phone'] ?? '' }}"
                                                       class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                            </div>
                                            @error('booker.phone')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="sm:col-span-6 mt-3">
                                            <label for="reservation_date"
                                                   class="block text-sm font-medium text-gray-700"> Reservation
                                                Date
                                            </label>
                                            <div class="mt-1">
                                                <input type="date" id="datePicker"
                                                       name="reservation_date"
                                                       value="{{ $reservation->reservation_date ?? '' }}"
                                                       class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                            </div>
                                            @error('reservation_date')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="sm:col-span-6 mt-3">
                                            <label for="status" class="block text-sm font-medium text-gray-700">Restaurant</label>
                                            <div class="mt-1">
                                                <select id="restaurant_name" name="restaurant_name"
                                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                                    @foreach ($restaurants as $restaurant)
                                                        <option
                                                            @selected($restaurant->name)>
                                                            {{ $restaurant->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('restaurant_name')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="sm:col-span-6 mt-3">
                                            <label for="guests_amount" class="block text-sm font-medium text-gray-700">
                                                Guest Number
                                            </label>
                                            <div class="mt-1">
                                                <input type="number" id="guests_amount" name="guests_amount"
                                                       value="{{ $reservation->guests_amount ?? '' }}"
                                                       class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                            </div>
                                            @error('guests_amount')
                                            <div class="text-sm text-red-400">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mt-6 p-4 flex justify-end">
                                            <button type="submit"
                                                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                                                Next
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
