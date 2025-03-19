<x-layout>

<section class="p-8 bg-white text-center">
    <h2 class="text-3xl font-bold">About Us</h2>
    <p class="mt-4 text-lg">Mathare Care Center is a non-profit organization dedicated to improving the lives of children with disabilities in the Mathare slums. Established by individuals who have personally experienced the challenges of raising children with special needs, the organization aims to provide comprehensive support through education, therapy, vocational training and community integration.</p>
    <p class="mt-4 text-lg">Our primary goal is to enhance the quality of life for children with disabilities and their families by ensuring access to proper healthcare, education and social interaction. In the Mathare slums, children with special needs often face neglect and social exclusion due to a lack of awareness and resources. We strive to change this by offering structured programs that promote skill development, provide mobility assistance and create awareness about disability rights.</p>
    <p class="mt-4 text-lg">We also focus on empowering families and communities by equipping them with knowledge and training on how to care for and support children with disabilities. Through awareness campaigns, educational workshops and collaborations with both governmental and private institutions, Mathare Care Center envisions a society where every child, regardless of ability, has the opportunity to thrive and reach their full potential.</p>
</section>

<section class="p-8 bg-gray-200 text-center">
    <h3 class="text-2xl font-bold">Our Mission</h3>
    <p class="mt-4">We are committed to fostering an inclusive and supportive environment where children with disabilities can thrive. Our mission is to ensure that every child, regardless of their physical or mental challenges, has access to quality education, healthcare and social opportunities that promote their well-being. Through dedicated programs, advocacy and community engagement, we strive to break the barriers of discrimination and create a society that values and uplifts individuals with special needs. By working closely with families, educators and policymakers, we aim to empower these children with the tools and skills they need to lead independent and fulfilling lives.</p>
</section>


<section class="p-8 bg-white text-center">
    <h3 class="text-2xl font-bold">Meet Our Team</h3>
    <p class="mt-4">Our dedicated staff works together to ensure the success of our programs.</p>

    <!-- Staff Hierarchy - Pyramid Structure -->
    <div class="flex flex-col items-center mt-8">
        <!-- Top Level (CEO) -->
        <div class="w-1/3">
            <img src="{{ asset('Media/director.jpg') }}" class="w-24 h-24 rounded-full mx-auto" alt="Director">
            <p class="font-bold">Elizabeth Waithera</p>
            <p class="text-gray-500 text-sm">CEO</p>
        </div>

        <!-- Second Level (Managers) -->
        <div class="flex justify-center mt-6 space-x-8">
            <div class="w-1/4">
                <img src="{{ asset('Media/manager1.jpg') }}" class="w-20 h-20 rounded-full mx-auto" alt="Manager 1">
                <p class="font-bold">Nelson Mandela</p>
                <p class="text-gray-500 text-sm">Project Manager</p>
            </div>
            <div class="w-1/4">
                <img src="{{ asset('Media/manager2.jpg') }}" class="w-20 h-20 rounded-full mx-auto" alt="Manager 2">
                <p class="font-bold">Dennis Ombese</p>
                <p class="text-gray-500 text-sm">Senior Therapist</p>
            </div>
            <div class="w-1/4">
                <img src="{{ asset('Media/manager2.jpg') }}" class="w-20 h-20 rounded-full mx-auto" alt="Manager 2">
                <p class="font-bold">Jeremiah Arasa</p>
                <p class="text-gray-500 text-sm">Physiotherapist</p>
            </div>
        </div>

        <!-- Third Level (Staff) -->
        <div class="flex justify-center mt-6 space-x-6">
            <div class="w-1/5">
                <img src="{{ asset('Media/staff1.jpg') }}" class="w-16 h-16 rounded-full mx-auto" alt="Staff 1">
                <p class="font-bold">Ashlyne Elinati</p>
                <p class="text-gray-500 text-sm">Data Entry Clerk</p>
            </div>
            <div class="w-1/5">
                <img src="{{ asset('Media/staff2.jpg') }}" class="w-16 h-16 rounded-full mx-auto" alt="Staff 2">
                <p class="font-bold">Elizabeth John</p>
                <p class="text-gray-500 text-sm">Housekeeper</p>
            </div>
            <div class="w-1/5">
                <img src="/Media/WhatsApp Image 2025-01-28 at 11.06.16_386b319f" class="w-16 h-16 rounded-full mx-auto" alt="Staff 3">
                <p class="font-bold">Christopher Vucha</p>
                <p class="text-gray-500 text-sm">Social Worker</p>
            </div>
            <div class="w-1/5">
                <img src="{{ asset('Media/WhatsApp Image 2025-01-28 at 11.06.16_386b319f') }}" class="w-16 h-16 rounded-full mx-auto" alt="Staff 3">
                <p class="font-bold">Jacklin Akinyi</p>
                <p class="text-gray-500 text-sm">Caregiver</p>
            </div>
            <div class="w-1/5">
                <img src="{{ asset('Media/WhatsApp Image 2025-01-28 at 11.06.16_386b319f') }}" class="w-16 h-16 rounded-full mx-auto" alt="Staff 3">
                <p class="font-bold">Hellen Achungo</p>
                <p class="text-gray-500 text-sm">Caregiver</p>
            </div>
            <div class="w-1/5">
                <img src="{{ asset('Media/WhatsApp Image 2025-01-28 at 11.06.16_386b319f') }}" class="w-16 h-16 rounded-full mx-auto" alt="Staff 3">
                <p class="font-bold">Mary Kamau</p>
                <p class="text-gray-500 text-sm">Caregiver</p>
            </div>
        </div>
    </div>

</section>


</x-layout>
