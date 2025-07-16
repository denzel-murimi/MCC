
<x-layout>
<div class="container min-h-screen mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Adopt a Child</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($children as $child)
        <div class="bg-white shadow-lg rounded-lg p-4">
            <img src="{{ $child->child_image_url }}" alt="{{ $child->name }}" class="w-full h-48 object-cover rounded-lg">
            <h2 class="text-xl font-semibold mt-4">{{ $child->name }}</h2>
            <p class="text-gray-600">{{ Str::limit($child->condition, 100) }}</p>

            <a href="{{ route('adopt.form', ['id' => $child->id]) }}"
               class="mt-4 inline-block bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">
                Select {{ $child->name }}
            </a>
        </div>
        @endforeach
    </div>
</div>


</x-layout>

