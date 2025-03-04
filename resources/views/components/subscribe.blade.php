<section class="bg-white py-16">

    <div class="container max-w-screen-xl mx-auto px-4">

        <div class="w-full h-full bg-primary-800 rounded-2xl md:rounded-3xl relative lg:flex items-center">
            <div class="hidden lg:block">
                <img src="{{asset('images/humans.png')}}" alt="Image" class="relative z-10">

                <img src="{{asset('images/pattern-2.png')}}" alt="Image" class="absolute top-14 left-40">

                <img src="{{asset('images/pattern.png')}}" alt="Image" class="absolute top-0 z-0">
            </div>

            <div class="lg:relative py-4 lg:py-0">
                <h1 class="font-semibold text-white text-xl md:text-4xl text-center lg:text-left leading-normal md:mb-5 lg:mb-10">Subscribe to our Weekly Newsletter. <br> Receive an email about  our program for the week!</h1>

                <div class="hidden md:block flex items-center text-center lg:text-left space-x-5">
                    <form action="{{route('subscribe')}}" method="post">
                        @csrf
                    <input type="email" name="email" placeholder="Email" class="px-4 py-4 w-96 bg-gray-50 placeholder-gray-400 rounded-xl outline-none">

                    <button class="px-6 py-4 font-semibold bg-gray-50 text-info text-lg rounded-xl hover:bg-blue-500 hover:text-white transition ease-in-out duration-500" type="submit">Join</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</section>
