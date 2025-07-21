<x-layout>
    <div class="container min-h-screen mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Adopt a Child</h1>

        <p class="max-w-2xl mx-auto mb-8 text-lg text-center text-gray-700 bg-blue-50 border-l-4 border-blue-400 p-4 rounded shadow">
            Welcome to our Adopt a Child program! Here, you can make a meaningful difference in a child's life by contributing a monthly donation. Your support helps provide essential needs such as education, healthcare, and nutrition. Simply select a child below to begin your journey of making a lasting impact—no account required, just your generosity and care.
        </p>

        @if($children->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($children as $child)
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <img src="{{ $child->child_image_url }}" alt="{{ $child->name }}" class="w-full h-48 object-cover rounded-lg">
                        <h2 class="text-xl font-semibold mt-4">{{ $child->name }}, <span class="text-xs">{{\Carbon\Carbon::parse($child->dob)->age ?? 'N/A'}} years</span></h2>
                        <p class="text-gray-600 line-clamp-3">{!! str($child->condition)->sanitizeHtml()->limit(100) !!}</p>

                        <a href="{{ route('adopt.form', ['hashid' => $child->hashid]) }}"
                           class="mt-4 inline-block bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">
                            Select {{ $child->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-16">
                <div class="text-center">
                    <h3 class="text-2xl font-semibold text-gray-600 mb-2">No Children Available</h3>
                    <p class="text-gray-500 mb-6 max-w-md">
                        There are currently no children available for adoption. Please check back later or contact us for more information.
                    </p>
                </div>
            </div>
        @endif
    </div>
</x-layout>
