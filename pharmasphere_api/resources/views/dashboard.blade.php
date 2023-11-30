<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-bold text-lg mb-4">API Token Generator</h2>
                    <p>Click the button below to generate a new token for the Drugs API.</p>
                    <form method="POST" action="{{ route('generate-token') }}" class="mt-4">
                        @csrf
                        <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded" type="submit" id="generateButton" title="Click to generate a new token">Generate Token</button>
                    </form>

                    @if (session('token'))
                        <div class="mt-4">
                            <h3 class="font-bold text-md mb-2">Your Token</h3>
                            <p class="mb-2">Here is your token: <strong id="token">{{ session('token') }}</strong></p>
                            <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded" id="copyButton" title="Click to copy the token">Copy Token</button>
                            <p id="copySuccess" class="text-green-500 mt-2" style="display: none;">Token copied to clipboard!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        const copyButton = document.getElementById('copyButton');
        const copySuccess = document.getElementById('copySuccess');
        const generateButton = document.getElementById('generateButton');
        const token = document.getElementById('token');

        copyButton.addEventListener('click', () => {
            navigator.clipboard.writeText(token.textContent);

            // Show success message
            copySuccess.style.display = 'block';

            // Hide success message after 7 seconds
            setTimeout(() => {
                copySuccess.style.display = 'none';
            }, 7000);
        });

        generateButton.addEventListener('click', () => {
            generateButton.textContent = 'Generating...';
            generateButton.disabled = true;
        });
    </script>
</x-app-layout>
