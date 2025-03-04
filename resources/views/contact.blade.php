<x-layout>

    <section class="p-8 bg-white text-center">
        <a
        href="#reload"
        onclick="event.preventDefault(); window.location.reload();"
        class="font-semibold text-gray-900 hover:text-gray-400 text-xl md:text-2xl leading-normal transition ease-in-out duration-300 mb-5 lg:mb-0">Contact Us</a>
        <p class="mt-4">Reach out to us for any inquiries or support.</p>

        <div class="mt-8 max-w-lg mx-auto">
            <form action="{{ route('contact.submit') }}" method="POST" class="bg-gray-100 p-6 rounded-lg shadow-md">
                @csrf
                <div class="mb-4">
                    <label class="block text-left font-bold mb-1">Name</label>
                    <input type="text" name="name" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-left font-bold mb-1">Email</label>
                    <input type="email" name="email" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-left font-bold mb-1">Message</label>
                    <textarea name="message" class="w-full p-2 border rounded" rows="4" required></textarea>
                </div>

                <button type="submit" class="bg-primary-600 text-white px-6 py-2 rounded hover:bg-primary-800">Send
                    Message</button>
            </form>
        </div>
    </section>


</x-layout>
