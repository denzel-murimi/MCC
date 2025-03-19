<x-layout>
<section class="p-8 bg-white">
    <h2 class="text-3xl font-bold text-center">Frequently Asked Questions</h2>

    <div class="mt-8 max-w-3xl mx-auto">
        <h3 class="text-2xl font-semibold mt-6">General Information</h3>
        <details class="mt-2 p-4 bg-gray-100 rounded">
            <summary class="font-medium cursor-pointer">What is Mathare Care Center?</summary>
            <p class="mt-2 text-gray-700">Mathare Care Center is a non-profit organization dedicated to supporting children with disabilities in the Mathare slums.</p>
        </details>
        
        <details class="mt-2 p-4 bg-gray-100 rounded">
            <summary class="font-medium cursor-pointer">Who do you help?</summary>
            <p class="mt-2 text-gray-700">We focus on helping children with disabilities and their families by providing education, therapy and social support.</p>
        </details>

        <h3 class="text-2xl font-semibold mt-6">Donations</h3>
        <details class="mt-2 p-4 bg-gray-100 rounded">
            <summary class="font-medium cursor-pointer">How can I donate?</summary>
            <p class="mt-2 text-gray-700">You can donate via M-Pesa, PayPal or Bitcoin. Visit our <a href="{{ url('/donate') }}" class="text-blue-500">Donate Now</a> page.</p>
        </details>

        <details class="mt-2 p-4 bg-gray-100 rounded">
            <summary class="font-medium cursor-pointer">Are my donations tax-deductible?</summary>
            <p class="mt-2 text-gray-700">Yes, donations are tax-deductible. You will receive a receipt for your contribution.</p>
        </details>

        <h3 class="text-2xl font-semibold mt-6">Volunteering</h3>
        <details class="mt-2 p-4 bg-gray-100 rounded">
            <summary class="font-medium cursor-pointer">How can I become a volunteer?</summary>
            <p class="mt-2 text-gray-700">Fill out the <a href="{{ url('/volunteer') }}" class="text-blue-500">volunteer application form</a> and we will get in touch.</p>
        </details>

        <details class="mt-2 p-4 bg-gray-100 rounded">
            <summary class="font-medium cursor-pointer">Do I need special skills to volunteer?</summary>
            <p class="mt-2 text-gray-700">Not necessarily! We welcome anyone with a passion to help and we provide necessary training.</p>
        </details>
    </div>
</section>
</x-layout>
