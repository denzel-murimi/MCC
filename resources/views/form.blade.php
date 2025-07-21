<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Complete Your Adoption</h1>
        <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-6">
            <img src="{{ $child->child_image_url }}" alt="{{ $child->name }}" class="w-full h-48 object-cover rounded-lg">
            <h2 class="text-xl font-semibold mt-4">
                {{ $child->name }},
                <span class="text-xs">{{ \Carbon\Carbon::parse($child->dob)->age ?? 'N/A' }} years</span>
            </h2>
            <p class="text-sm mt-2">{{ $child->gender ?? 'N/A' }}</p>
            <p class="text-gray-600">{!! str($child->condition)->sanitizeHtml() !!}</p>
            <p class="text-sm mt-2">
                Caregiver:
                <span>{{ !empty($child->caregiver) ? implode(', ', $child->caregiver) : 'N/A' }}</span>
            </p>

            <form action="{{ route('adopt.store', $child->hashid) }}" method="POST" class="mt-6">
                @csrf

                <label class="block text-gray-700">Your Name</label>
                <input type="text" name="name" class="w-full p-2 border rounded-lg mb-4" value="{{ old('name') }}" required>

                <label class="block text-gray-700">Your Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded-lg mb-4" value="{{ old('email') }}" required>

                <label class="block text-gray-700">Your Phone Number</label>
                <input type="text" name="phone" class="w-full p-2 border rounded-lg mb-4" value="{{ old('phone') }}" required>

                <label class="block text-gray-700 text-sm font-bold mb-2">Contribution Type</label>
                <div class="flex gap-4 mb-6">
                    @foreach(['one-time', 'recurring'] as $option)
                        <label class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-xl cursor-pointer transition hover:bg-gray-100">
                            <input type="radio" name="contribution_type" value="{{ $option }}" class="hidden peer" {{ old('contribution_type') === $option ? 'checked' : '' }} required>
                            <span class="w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:border-primary-500 peer-checked:bg-primary-500">
                                <span class="w-2 h-2 bg-white rounded-full"></span>
                            </span>
                            {{ ucfirst($option) }}
                        </label>
                    @endforeach
                </div>

                <!-- Only show if "recurring" is selected on the server (after POST) -->
                    <div class="mb-4" id="recurringFields" style="display: none">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Frequency</label>
                        <select name="frequency" class="w-full p-2 border rounded-lg mb-2" required>
                        @foreach(['hourly', 'daily', 'monthly', 'quarterly', 'biannually', 'annually'] as $freq)
                                <option value="{{ $freq }}" {{ old('frequency') === $freq ? 'selected' : '' }}>{{ ucfirst($freq) }}</option>
                            @endforeach
                        </select>

                        <label class="block text-gray-700 text-sm font-semibold mb-2">Duration (months)</label>
                        <input type="number" name="duration" min="1" max="36"
                               class="w-full p-2 border rounded-lg mb-2"
                               value="{{ old('duration') }}" placeholder="e.g. 12">

                        <p class="text-xs text-gray-500">You can cancel anytime. Payments are handled securely via Paystack.</p>
                    </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Contribution Amount (KES)</label>
                    <div class="flex gap-2 mb-2">
                        @foreach([5000, 10000, 20000, 50000] as $preset)
                            <button type="button"
                                    class="px-3 py-1 rounded border border-gray-300 bg-gray-100 hover:bg-primary-100"
                                    onclick="document.querySelector('[name=amount]').value = '{{ $preset }}'">
                                {{ number_format($preset) }}
                            </button>
                        @endforeach
                    </div>
                    <input type="number" name="amount" min="100"
                           class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500"
                           value="{{ old('amount') }}" required>
                </div>

                <button type="submit"
                        class="w-full bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">
                    Submit Adoption Pledge
                </button>
            </form>
        </div>
    </div>
    <script @cspNonce>
        document.addEventListener('DOMContentLoaded', function () {
            const contributionRadios = document.querySelectorAll('input[name="contribution_type"]');
            const recurringFields = document.getElementById('recurringFields');

            function toggleRecurringFields() {
                const selected = document.querySelector('input[name="contribution_type"]:checked');
                recurringFields.style.display = selected && selected.value === 'recurring' ? 'block' : 'none';
            }

            contributionRadios.forEach(radio => {
                radio.addEventListener('change', toggleRecurringFields);
            });

            // Run on page load in case of old('contribution_type') === 'recurring'
            toggleRecurringFields();
        });
    </script>

</x-layout>
