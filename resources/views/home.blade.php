<x-layout>
    <section class="bg-white py-4 md:mb-10">
        <div class="container max-w-screen-2xl mx-auto px-4">

            <x-title>Mathare Care Center</x-title>

            <div class="flex flex-col lg:flex-row justify-between space-x-20">
                <div class="text-center lg:text-left mt-40">
                    <h1 class="font-semibold text-gray-900 text-3xl md:text-6xl leading-normal mb-6">Caring today, <br>
                        shaping tomorrow</h1>

                    <p class="font-light text-gray-400 text-md md:text-lg leading-normal mb-12">We provide care for
                        disabled children and for peoples of <br> worldwide to support people and organizers</p>

                        <a href="{{ route('our-story') }}">
    <button class="px-6 py-4 bg-primary-800 font-semibold text-white text-lg rounded-xl hover:bg-primary-500 transition ease-in-out duration-500">
        Our Story
    </button>
</a>

                </div>

                <div class="mt-24">
                    <img src="{{ asset('images/home-img.png') }}" alt="Image">
                </div>
            </div>
        </div>
    </section>


    <section class="bg-white py-16">

        <div class="container max-w-screen-xl mx-auto px-4">

            <div class="flex flex-col lg:flex-row justify-between space-x-16">
                <div class="flex justify-center lg:justify-start">
                    <img src="{{asset('images/feature-img.png')}}" alt="Image">
                </div>

                <div class="mt-16">
                    <h1 class="font-semibold text-gray-900 text-xl md:text-4xl mb-20">You can help lots of children by
                        <br> donating</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 md:space-x-20 mb-16">
                        <div class="mb-5 md:mb-0">
                            <div class="w-20 py-6 flex justify-center bg-info bg-opacity-5 rounded-xl mb-4">
                                <i data-feather="users" class="text-info"></i>
                            </div>

                            <h3 class="font-semibold text-gray-900 text-xl md:text-3xl mb-4">{{\App\Models\Donation::count()}}</h3>

                            <p class="font-light text-gray-400 text-md md:text-lg">All time <br>Donations
                            </p>
                        </div>

                        <div>
                            <div class="w-20 py-6 flex justify-center bg-red-500 bg-opacity-5 rounded-xl mb-4">
                                <i data-feather="award" class="text-red-500"></i>
                            </div>

                            <h3 class="font-semibold text-gray-900 text-xl md:text-3xl mb-4">~ KES {{round(\App\Models\Donation::sum('amount'),-3)}}</h3>

                            <p class="font-light text-gray-400 text-md md:text-lg">Raised and counting <br> donations in
                                all time</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 md:space-x-20">
                        <div class="mb-5 md:mb-0">
                            <div class="w-20 py-6 flex justify-center bg-yellow-500 bg-opacity-5 rounded-xl mb-4">
                                <i data-feather="users" class="text-yellow-500"></i>
                            </div>

                            <h3 class="font-semibold text-gray-900 text-xl md:text-3xl mb-4">{{round(\App\Models\Volunteer::count())}}+</h3>

                            <p class="font-light text-gray-400 text-md md:text-lg">Our volunteer around the <br> world
                            </p>
                        </div>

                        <div>
                            <div class="w-20 py-6 flex justify-center bg-green-500 bg-opacity-5 rounded-xl mb-4">
                                <i data-feather="trending-up" class="text-green-500"></i>
                            </div>

                            <h3 class="font-semibold text-gray-900 text-xl md:text-3xl mb-4">98%</h3>

                            <p class="font-light text-gray-400 text-md md:text-lg">Positive review from <br> public</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <x-subscribe></x-subscribe>

</x-layout>
