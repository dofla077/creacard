<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @yield('subtitle' ??__('Dashboard') )
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="app">
                        @if(request()->routeIs('dashboard'))
                            <p>Welcome to dashboard for application test.</p>
                            <p>You can access
                                <a href="{{ route('customers.index') }}">customers</a> page to test
                                <a href="{{ route('quotations.index') }}">quotations</a> page to test.
                            </p>
                            <p>Enjoy :) </p>
                        @else
                            @yield('content')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
