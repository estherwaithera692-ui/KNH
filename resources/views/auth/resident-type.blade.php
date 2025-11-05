<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Select Resident Type
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Please select your resident type to continue
                </p>
            </div>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('resident.type.store') }}">
                @csrf

                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="resident_type" class="sr-only">Resident Type</label>
                        <select id="resident_type" name="resident_type" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                            <option value="">Select Resident Type</option>
                            <option value="NON-RESIDENT">NON-RESIDENT</option>
                            <option value="RESIDENT">RESIDENT</option>
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-yellow-100 bg-blue-600 hover:bg-blue-700 shadow-md focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-offset-2">
                        Continue
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
