<x-layout>
    <header class="bg-black p-4 text-white flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <x-logo></x-logo>
            <h1 class="text-2xl font-bold">Mathare Care Center</h1>
        </div>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="#about" class="hover:underline">About</a></li>
                <li><a href="#programs" class="hover:underline">Programs</a></li>
                <li><a href="#contact" class="hover:underline">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="h-screen flex items-center justify-center text-center bg-cover bg-center"
        style="background-image: {{asset('hero1.webp')}};">
        <div class="bg-black bg-opacity-50 p-8 rounded-lg">
            <h2 class="text-4xl text-white font-bold">Supporting Special Needs Children in Mathare</h2>
            <p class="text-white mt-4">Providing care, education, and empowerment for children with disabilities.</p>
            <a href="#donate" class="mt-6 inline-block bg-yellow-400 text-black px-6 py-3 rounded-lg font-bold">Donate
                Now</a>
        </div>
    </section>

    <section id="about" class="p-8 bg-white text-center">
        <h2 class="text-3xl font-bold">About Us</h2>
        <p class="mt-4">Mathare Care Center is dedicated to improving the lives of children with disabilities through
            education, support, and community engagement.</p>
    </section>

    <section id="programs" class="p-8 bg-gray-200 text-center">
        <h2 class="text-3xl font-bold">Our Programs</h2>
        <p class="mt-4">We offer special education, vocational training, therapy, and community events.</p>
    </section>

    <footer id="contact" class="bg-blue-600 p-4 text-white text-center">
        <p>Contact us: info@matharecare.org | Follow us on social media</p>
    </footer>
</x-layout>
