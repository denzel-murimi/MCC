<x-layout>

    <div class="container max-w-screen-xl mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-5xl font-bold text-gray-900">Volunteer Sign-Up</h1>
            <p class="text-gray-500 mt-4">Join us and make a difference in the lives of children.</p>
        </div>
        
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <form action="{{ route('volunteer.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-gray-700 font-medium">Full Name</label>
                    <input type="text" name="name" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-info">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium">Email Address</label>
                    <input type="email" name="email" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-info">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium">Phone Number</label>
                    <input type="tel" name="phone" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-info">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium">Availability</label>
                    <select name="availability" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-info">
                        <option value="Weekdays">Weekdays</option>
                        <option value="Weekends">Weekends</option>
                        <option value="Flexible">Flexible</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium">Message (Optional)</label>
                    <textarea name="message" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-info"></textarea>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="px-6 py-3 bg-info text-blue font-bold rounded-lg hover:bg-blue-700 transition duration-300">Sign Up</button>
                </div>
            </form>
        </div>
    </div>


</x-layout>

