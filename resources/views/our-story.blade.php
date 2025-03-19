<x-layout>
    
<div class="relative bg-cover bg-center h-[600px]" style="background-image: url('{{ asset('images/Team.jpg') }}');">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <h1 class="text-white text-5xl font-bold">Our Story</h1>
    </div>
</div>

<div class="container mx-auto px-6 py-12">
    <div class="text-center">
        <h2 class="text-4xl font-bold text-gray-800">A Journey of Hope and Care</h2>
        <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">
            Mathare Care Center began as a vision to create a safe space for children in need. Over the years, we've provided care, education, and support to hundreds of children, ensuring they have a brighter future.
        </p>
    </div>
    
    <div class="mt-12 grid md:grid-cols-2 gap-8">
        <div>
            <img src="{{ asset('images/Our-story.jpg') }}" alt="Children at Mathare Care Center" class="rounded-lg shadow-lg w-full">
        </div>
        <div class="flex flex-col justify-center">
            <h3 class="text-2xl font-semibold text-gray-800">Building a Future, One Child at a Time</h3>
            <p class="mt-4 text-gray-600">
                Our mission is to provide every child with the love, education and care they deserve. Through community support, we've expanded our reach and impact.
            </p>
        </div>
    </div>

    <div class="mt-12 flex justify-center">
        <a href="{{ url('/donate') }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-purple-700">Join Our Mission</a>
    </div>
</div>


</x-layout>