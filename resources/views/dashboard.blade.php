<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Create Prescriptions -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 shadow-lg rounded-xl p-6 hover:scale-105 transition-transform duration-300">
                <h3 class="text-lg font-bold text-white mb-4">Create a New Prescription</h3>
                <p class="text-sm text-white/90 mb-6">
                    Easily create and manage prescriptions for your medical needs.
                </p>
                <form action="{{ route('prescriptions.create') }}" method="GET">
                    <button type="submit" class="px-4 py-2 bg-white text-indigo-600 font-semibold rounded-lg shadow-md hover:bg-gray-100 transition-all duration-300">
                        Create Prescriptions
                    </button>
                </form>
            </div>

            <!-- My Prescriptions -->
            <div class="bg-gradient-to-r from-green-500 to-teal-600 shadow-lg rounded-xl p-6 hover:scale-105 transition-transform duration-300">
                <h3 class="text-lg font-bold text-white mb-4">View Your Prescriptions</h3>
                <p class="text-sm text-white/90 mb-6">
                    Check the details of your uploaded prescriptions and track their status.
                </p>
                <form action="{{ route('prescriptions.index') }}" method="GET">
                    <button type="submit" class="px-4 py-2 bg-white text-teal-600 font-semibold rounded-lg shadow-md hover:bg-gray-100 transition-all duration-300">
                        My Prescriptions
                    </button>
                </form>
            </div>

            <!-- My Quotations -->
            <div class="bg-gradient-to-r from-purple-500 to-pink-600 shadow-lg rounded-xl p-6 hover:scale-105 transition-transform duration-300">
                <h3 class="text-lg font-bold text-white mb-4">Manage Your Quotations</h3>
                <p class="text-sm text-white/90 mb-6">
                    Access and review all the quotations prepared for your prescriptions.
                </p>
                <form action="{{ route('pharmacy.quotations.index') }}" method="GET">
                    <button type="submit" class="px-4 py-2 bg-white text-pink-600 font-semibold rounded-lg shadow-md hover:bg-gray-100 transition-all duration-300">
                        My Quotations
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
