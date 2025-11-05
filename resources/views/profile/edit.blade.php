<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <!-- Minimal profile icon -->
            <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-br from-blue-400 to-indigo-600 text-white rounded-xl shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </div>

            <div>
                <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100 leading-tight">
                    {{ __('Profile') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage your account, security and preferences</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-6">
            <!-- Card style wrapper -->
            <div class="p-6 bg-white/90 dark:bg-gray-800/70 backdrop-blur rounded-2xl border border-gray-200/50 dark:border-gray-700/50 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-gradient-to-br from-green-300 to-teal-400 rounded-lg text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c2.761 0 5-2.239 5-5S14.761 1 12 1 7 3.239 7 6s2.239 5 5 5zM4 22v-2a4 4 0 014-4h8a4 4 0 014 4v2" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Profile Information</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Update your name, email and other details</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 bg-white/90 dark:bg-gray-800/70 backdrop-blur rounded-2xl border border-gray-200/50 dark:border-gray-700/50 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-gradient-to-br from-purple-400 to-pink-500 rounded-lg text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11V7m0 0a4 4 0 110 8 4 4 0 010-8zM5 21h14" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Security</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Change your password and secure your account</p>
                    </div>
                </div>

                <div class="mt-6 max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 bg-white/90 dark:bg-gray-800/70 backdrop-blur rounded-2xl border border-red-200/40 dark:border-red-800/40 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-red-500 rounded-lg text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Danger Zone</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Permanently delete your account</p>
                    </div>
                </div>

                <div class="mt-6 max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            @if(auth()->user()->role === 'admin')
                <div class="p-6 bg-white/95 dark:bg-gray-800/75 backdrop-blur rounded-2xl border border-yellow-200/40 dark:border-yellow-800/40 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-yellow-400 rounded-lg text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                    <circle cx="12" cy="12" r="9" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Admin Panel</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Manage bio data and system resources</p>
                            </div>
                        </div>

                        <div class="hidden sm:flex items-center space-x-3">
                            <a href="{{ route('admin.bioData.index') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full shadow-sm transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                Manage Bio Data
                            </a>
                            <a href="{{ route('biodataCollect') }}" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-full shadow-sm transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Add New
                            </a>
                        </div>
                    </div>

                    <div class="mt-6 max-w-xl sm:hidden flex space-x-3">
                        <a href="{{ route('admin.bioData.index') }}" class="flex-1 inline-flex justify-center items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow-sm transition">
                            Manage
                        </a>
                        <a href="{{ route('biodataCollect') }}" class="flex-1 inline-flex justify-center items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow-sm transition">
                            Add
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
