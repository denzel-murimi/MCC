<x-layout>
    <section class="bg-white py-5 md:mb-10">
        <div class="container max-w-screen-xxl mx-auto px-4">
            <x-navbar></x-navbar>

            <div class="flex flex-col lg:flex-row justify-between space-x-20">
                <div class="text-center lg:text-left mt-40">
                    <h1 class="font-semibold text-gray-900 text-3xl md:text-6xl leading-normal mb-6">Caring today, <br> shaping tomorrow</h1>

                    <p class="font-light text-gray-400 text-md md:text-lg leading-normal mb-12">We provide care for disabled children and for peoples of <br> worldwide to support people and organizers</p>

                    <button class="px-6 py-4 bg-primary-900 font-semibold text-white text-lg rounded-xl hover:bg-secondary-700 transition ease-in-out duration-500">Our Story</button>
                </div>

                <div class="mt-24">
                    <img src="{{asset('images/home-img.png')}}" alt="Image">
                </div>
            </div>
        </div>
    </section>

    <!-- join volunters section -->
    <section class="bg-white py-16">

        <div class="container max-w-screen-xl mx-auto px-4">

            <div class="w-full h-full bg-blue-500 rounded-2xl md:rounded-3xl relative lg:flex items-center">
                <div class="hidden lg:block">
                    <img src="{{asset('images/humans.png')}}" alt="Image" class="relative z-10">

                    <img src="{{asset('images/pattern-2.png')}}" alt="Image" class="absolute top-14 left-40">

                    <img src="{{asset('images/pattern.png')}}" alt="Image" class="absolute top-0 z-0">
                </div>

                <div class="lg:relative py-4 lg:py-0">
                    <h1 class="font-semibold text-white text-xl md:text-4xl text-center lg:text-left leading-normal md:mb-5 lg:mb-10">Subscribe to our Weekly Newsletter. <br> Receive an email about  our program for the week!</h1>

                    <div class="hidden md:block flex items-center text-center lg:text-left space-x-5">
                        <input type="text" placeholder="Email" class="px-4 py-4 w-96 bg-gray-50 placeholder-gray-400 rounded-xl outline-none">

                        <button class="px-6 py-4 font-semibold bg-gray-50 text-info text-lg rounded-xl hover:bg-blue-500 hover:text-white transition ease-in-out duration-500">Join</button>
                    </div>
                </div>
            </div>

        </div> <!-- container.// -->

    </section>

    <x-footer></x-footer>

</x-layout>
