<footer class="bg-white py-16">
    <div class="container max-w-screen-2xl mx-auto px-4">
        <div class="flex flex-col lg:flex-row lg:justify-between">
            <div class="space-y-7 mb-10 lg:mb-0">
                <div class="flex justify-center lg:justify-start">
                    <x-logo></x-logo>
                </div>

                <p class="font-light text-gray-400 text-md md:text-lg text-center lg:text-left">
                    Donate and help us take care of our children
                </p>

                <div class="flex items-center justify-center lg:justify-start space-x-5">
                    <a href="https://www.facebook.com/Matharecenter" target="_blank"
                        class="px-3 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-info hover:text-white transition ease-in-out duration-500">
                        <i data-feather="facebook"></i>
                    </a>

                    <a href="https://www.instagram.com/matharecarecenter1" target="_blank"
                        class="px-3 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-info hover:text-white transition ease-in-out duration-500">
                        <i data-feather="instagram"></i>
                    </a>

                    <a href="https://www.tiktok.com/@mathare_care_center" target="_blank"
                        class="px-3 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-info hover:text-white transition ease-in-out duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
       <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm4.75 7.5c-.83 0-1.57-.34-2.11-.88l-.31-.31V15c0 2.48-2.02 4.5-4.5 4.5S5.5 17.48 5.5 15s2.02-4.5 4.5-4.5c.07 0 .13 0 .2.01V12c-.07 0-.13-.01-.2-.01-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3V5h2c.25 1.48 1.52 2.62 3.05 2.72v1.78h-.05z"/>
   </svg>
                    </a>

                    <a href="mailto:matharedaycarecenter@gmail.com"
                        class="px-3 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-info hover:text-white transition ease-in-out duration-500">
                        <i data-feather="mail"></i>
                    </a>

                    <a href="tel:+25471131200"
                        class="px-3 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-info hover:text-white transition ease-in-out duration-500">
                        <i data-feather="phone"></i>
                    </a>
                </div>
            </div>

            <div class="text-center lg:text-left space-y-7 mb-10 lg:mb-0">
                <h4 class="font-semibold text-gray-900 text-lg md:text-2xl">Quick links</h4>

                <a href="{{ url('/donate') }}"
                    class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">Donate
                    Now</a>

                <a href="{{ route('volunteer.signup') }}"
                    class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">Volunteer
                    Sign-Up</a>
            </div>

            <div class="text-center lg:text-left space-y-7 mb-10 lg:mb-0">
                <h4 class="font-semibold text-gray-900 text-lg md:text-2xl">Organization</h4>

                <a  href="{{ route('our-story') }}"
                    class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">About
                    Us</a>

                <a href="{{route('gallery')}}"
                    class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">Gallery</a>
            </div>

            <div class="text-center lg:text-left space-y-7 mb-10 lg:mb-0">
                <h4 class="font-semibold text-gray-900 text-lg md:text-2xl">Legal</h4>

                <a href="{{ url('/faq') }}"
                    class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">FAQ</a>

                <a href="{{ url('/terms') }}"
                    class="block font-light text-gray-400 text-sm md:text-lg hover:text-gray-800 transition ease-in-out duration-300">Terms
                    & Conditions</a>
            </div>
        </div>
    </div> <!-- container.// -->
</footer>
