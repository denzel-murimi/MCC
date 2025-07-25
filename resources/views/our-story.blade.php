<x-layout>

    <style @cspNonce>
        .backg-cover{
            background-image: url('{{ asset('images/Team.jpg') }}');
        }
    </style>
    <div class="relative bg-cover bg-center h-[600px] backg-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <h1 class="text-white text-5xl font-bold">Our Story</h1>
        </div>
    </div>

    <div class="container mx-auto px-6 py-12">
        <div class="text-center">
            <h2 class="text-4xl font-bold text-gray-800">A Journey of Hope and Care</h2>
            <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">
                Mathare Care Center began as a vision to create a safe space for children in need. Over the years, we've
                provided care, education, and support to hundreds of children, ensuring they have a brighter future.
            </p>
        </div>

        <div class="mt-12 grid md:grid-cols-2 gap-8">
            <div>
                <img src="{{ asset('images/Our-story.jpg') }}" alt="Children at Mathare Care Center"
                     class="rounded-lg shadow-lg w-full">
            </div>
            <div class="flex flex-col justify-center">
                <h3 class="text-2xl font-semibold text-gray-800">Building a Future, One Child at a Time</h3>
                <p class="mt-4 text-gray-600">
                    Our mission is to provide every child with the love, education and care they deserve. Through
                    community support, we've expanded our reach and impact.
                </p>
            </div>
        </div>

        <div class="mt-12 flex justify-center">
            <a href="{{ url('/donate') }}"
               class="bg-purple-600 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-purple-700">Join
                Our Mission</a>
        </div>
    </div>

    <section class="p-6 md:p-12 bg-white text-center">
        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-8">
            <div class="col-span-2">
                <h2 class="text-3xl font-bold">About Us</h2>
                <p class="mt-4 text-lg">Mathare Care Center is a non-profit organization dedicated to improving the
                    lives of children with disabilities in the Mathare slums and its environs. Established by individuals who have
                    personally experienced the challenges of raising children with special needs, the organization aims
                    to provide comprehensive support to children and youth through education, therapy, vocational training and community
                    integration.</p>
                <p class="mt-4 text-lg">Our primary goal is to enhance the quality of life for children with
                    disabilities and their families by ensuring access to proper healthcare, education and social
                    interaction. In the Mathare slums, children with special needs often face neglect and social
                    exclusion due to a lack of awareness and resources. We strive to change this by offering structured
                    programs that promote skill development, provide mobility assistance and create awareness about
                    disability rights.</p>
                <p class="mt-4 text-lg">We also focus on empowering families and communities by equipping them with
                    knowledge and training on how to care for and support children with disabilities. Through awareness
                    campaigns, educational workshops and collaborations with both governmental and private institutions,
                    Mathare Care Center envisions a society where every child, regardless of ability, has the
                    opportunity to thrive and reach their full potential.</p>
            </div>
            <div class="md:pl-6 col-span-1">
                <h3 class="text-2xl font-bold">Our Mission</h3>
                <p class="mt-4">We are committed to fostering an inclusive and supportive environment where children
                    with disabilities can thrive. Our mission is to ensure that every child, regardless of their
                    physical or mental challenges, has access to quality education, healthcare and social opportunities
                    that promote their well-being. Through dedicated programs, advocacy and community engagement, we
                    strive to break the barriers of discrimination and create a society that values and uplifts
                    individuals with special needs. By working closely with families, educators and policymakers, we aim
                    to empower these children with the tools and skills they need to lead independent and fulfilling
                    lives.</p>
            </div>
        </div>
    </section>


    <section class="p-8 bg-white text-center">
        <h3 class="text-2xl font-bold">Meet Our Team</h3>
        <p class="mt-4">Our dedicated staff works together to ensure the success of our programs.</p>

        <!-- Staff Hierarchy - Pyramid Structure -->
        <div class="flex flex-col items-center mt-8 space-y-8">
            <!-- Top Level (CEO) -->
            <div class="w-2/3 sm:w-1/3">
                <img src="{{ asset('images/ceo.jpg') }}" class="w-25 h-25 rounded-full mx-auto" alt="Director">
                <p class="font-bold">Elizabeth Waithera</p>
                <p class="text-gray-500 text-sm">CEO</p>
            </div>

            <!-- Second Level (Managers) -->
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-x-8 gap-y-6">
                <div>
                    <img src="{{ asset('images/ndelu2.jpg') }}" class="w-25 h-25 rounded-full mx-auto" alt="Manager 1">
                    <p class="font-bold">Nelson Mandela</p>
                    <p class="text-gray-500 text-sm">Project Manager</p>
                </div>
                <div>
                    <img src="{{ asset('images/denno.jpg') }}" class="w-25 h-25 rounded-full mx-auto" alt="Manager 2">
                    <p class="font-bold">Dennis Ombese</p>
                    <p class="text-gray-500 text-sm">Senior Therapist</p>
                </div>
                <div>
                    <img src="{{ asset('images/jere.jpg') }}" class="w-25 h-25 rounded-full mx-auto" alt="Manager 3">
                    <p class="font-bold">Jeremiah Arasa</p>
                    <p class="text-gray-500 text-sm">Physiotherapist</p>
                </div>
                <div>
                    <img src="{{ asset('images/collo.jpg') }}" class="w-25 h-25 rounded-full mx-auto" alt="Manager 4">
                    <p class="font-bold">Collins Imonje</p>
                    <p class="text-gray-500 text-sm">Occupational Therapist</p>
                </div>
            </div>

            <!-- Third Level (Staff) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-x-6 gap-y-6">
                <div>
                    <img src="{{ asset('images/ashe.jpg') }}" class="w-25 h-25 rounded-full mx-auto" alt="Staff 1">
                    <p class="font-bold">Ashlyne Elinati</p>
                    <p class="text-gray-500 text-sm">Data Entry Clerk</p>
                </div>
                <div>
                    <img src="{{ asset('images/mwende.jpg') }}" class="w-25 h-25 rounded-full mx-auto" alt="Staff 2">
                    <p class="font-bold">Elizabeth John</p>
                    <p class="text-gray-500 text-sm">Housekeeper</p>
                </div>
                <div>
                    <img src="{{ asset('images/chris.jpg') }}" class="w-25 h-25 rounded-full mx-auto" alt="Staff 3">
                    <p class="font-bold">Christopher Vucha</p>
                    <p class="text-gray-500 text-sm">Social Worker</p>
                </div>
                <div>
                    <img src="{{ asset('images/jacklin.jpg') }}" class="w-25 h-25 rounded-full mx-auto" alt="Staff 4">
                    <p class="font-bold">Jacklin Akinyi</p>
                    <p class="text-gray-500 text-sm">Caregiver</p>
                </div>
                <div>
                    <img src="{{ asset('images/hellen.jpg') }}" class="w-25 h-25 rounded-full mx-auto" alt="Staff 5">
                    <p class="font-bold">Hellen Achungo</p>
                    <p class="text-gray-500 text-sm">Caregiver</p>
                </div>
                <div>
                    <img src="{{ asset('images/mary.jpg') }}" class="w-25 h-25 rounded-full mx-auto" alt="Staff 6">
                    <p class="font-bold">Mary Kamau</p>
                    <p class="text-gray-500 text-sm">Caregiver</p>
                </div>
            </div>

            <!-- IT Consultants -->
            <div class="flex items-center justify-center">
                <div class="w-1/2 md:w-1/4">
                    <img src="{{ asset('images/victor.jpg') }}" class="w-25 h-25 rounded-full mx-auto"
                         alt="IT Consultant 1">
                    <p class="font-bold">Victor Gichuru</p>
                    <p class="text-gray-500 text-sm">IT Consultant</p>
                </div>
                <div class="w-1/2 md:w-1/4">
                    <img src="{{ asset('images/denzey.png') }}" class="w-25 h-25 rounded-full mx-auto"
                         alt="IT Consultant 2">
                    <p class="font-bold">Denzel Murimi</p>
                    <p class="text-gray-500 text-sm">IT Consultant</p>
                </div>
            </div>

        </div>
    </section>


</x-layout>
