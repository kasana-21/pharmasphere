<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{ route('generate-token') }}">
                    @csrf
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Generate Token for the drugs API</button>
                </form>

                @if (session('token'))
                    <div>
                        Your token is: {{ session('token') }}
                        <div class="mt-2">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="copyButton">Copy Token</button>
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        const copyButton = document.getElementById('copyButton');
        copyButton.addEventListener('click', () => {
            navigator.clipboard.writeText('{{ session('token') }}');

            // Change button to a tick
            copyButton.textContent = '✓';

            // Change button back to "Copy" after 7 seconds
            setTimeout(() => {
                copyButton.textContent = 'Copy';
            }, 7000);
        });
    </script>
</x-app-layout>
