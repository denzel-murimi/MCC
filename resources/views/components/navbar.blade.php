<nav class="flex-wrap lg:flex items-center" x-data="navbarToggle">
    <div class="flex items-center mb-10 lg:mb-0">
        <x-logo></x-logo>
        <button class="lg:hidden w-10 h-10 ml-auto flex items-center justify-center border border-primary-500 text-primary-500 rounded-md" @click="toggleNavbar">
            <i data-feather="menu"></i>
        </button>
    </div>

    <ul class="lg:flex flex-col lg:flex-row lg:items-center lg:mx-auto lg:space-x-8 xl:space-x-14" :class="menuClasses">
        <li class="font-semibold text-gray-900 hover:text-gray-400 transition ease-in-out duration-300 mb-5 lg:mb-0">
            <a href="/">Home</a>
        </li>
        <li class="font-semibold text-gray-900 hover:text-gray-400 transition ease-in-out duration-300 mb-5 lg:mb-0">
            <a href="{{route('program.index')}}">Our Programs</a>
        </li>
        <li class="font-semibold text-gray-900 hover:text-gray-400 transition ease-in-out duration-300 mb-5 lg:mb-0">
            <a href="{{route('gallery')}}">Gallery</a>
        </li>

        <li class="font-semibold text-gray-900 hover:text-gray-400 transition ease-in-out duration-300 mb-5 lg:mb-0">
            <a href="{{ route('contact') }}">Contact Us</a>
        </li>
{{--        <li class="font-semibold text-gray-900 hover:text-gray-400 transition ease-in-out duration-300 mb-5 lg:mb-0">--}}
{{--            <a href="{{ route('signin') }}">Sign in</a>--}}
{{--        </li>--}}

    </ul>

    <div class="lg:flex flex-col md:flex-row md:items-center text-center md:space-x-6" :class="menuClasses">
        <a href="{{ url('/donate') }}" class="px-4 py-4 bg-primary-500 text-white font-semibold text-lg rounded-xl hover:bg-primary-700 transition ease-in-out duration-500 mb-5 md:mb-0">Donate</a>

        <a href="{{ route('adopt.index') }}" class="px-4 py-4 border-2 border-primary-500 text-primary-500 font-semibold text-lg rounded-xl hover:bg-primary-700 hover:text-white transition ease-linear duration-500">Adopt a child</a>
    </div>
</nav>
