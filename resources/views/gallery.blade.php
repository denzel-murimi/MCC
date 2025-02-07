<x-layout>
    <section class="bg-white py-4 md:mb-10 min-h-screen">
        <div class="container max-w-screen-2xl mx-auto px-4">
            <x-navbar></x-navbar>

            <x-title>Gallery</x-title>

            <div class="mt-10">
                <div class="grid gap-4">
                    <!-- Main Carousel -->
                    <div class="relative h-[300px] md:h-[480px] overflow-hidden rounded-lg">
                      <!-- Carousel Items -->
                      <div data-carousel-item="0" class="absolute inset-0 w-full h-full transition-opacity duration-500 opacity-0">
                        <img 
                          src="https://images.unsplash.com/photo-1499696010180-025ef6e1a8f9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                          class="w-full h-full object-cover object-center" 
                          alt="Main image 1"
                        >
                      </div>
                      <!-- Repeat for other images -->
                      <div data-carousel-item="1" class="absolute inset-0 w-full h-full transition-opacity duration-500 opacity-0">
                        <img 
                          src="https://images.unsplash.com/photo-1432462770865-65b70566d673?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                          class="w-full h-full object-cover object-center" 
                          alt="Main image 2"
                        >
                      </div>
                      <div data-carousel-item="2" class="absolute inset-0 w-full h-full transition-opacity duration-500 opacity-0">
                        <img 
                          src="https://images.unsplash.com/photo-1493246507139-91e8fad9978e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2940&q=80"
                          class="w-full h-full object-cover object-center" 
                          alt="Main image 3"
                        >
                      </div>
                      <div data-carousel-item="3" class="absolute inset-0 w-full h-full transition-opacity duration-500 opacity-0">
                        <img 
                          src="https://images.unsplash.com/photo-1518623489648-a173ef7824f3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2762&q=80"
                          class="w-full h-full object-cover object-center" 
                          alt="Main image 4"
                        >
                      </div>
                      <div data-carousel-item="4" class="absolute inset-0 w-full h-full transition-opacity duration-500 opacity-0">
                        <img 
                          src="https://images.unsplash.com/photo-1682407186023-12c70a4a35e0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2832&q=80"
                          class="w-full h-full object-cover object-center" 
                          alt="Main image 5"
                        >
                      </div>
                    </div>
                  
                    <!-- Thumbnails -->
                    <div class="grid grid-cols-5 gap-4">
                      <div class="p-1 rounded-lg transition-all duration-300 cursor-pointer ring-2 ring-transparent hover:ring-blue-300"
                           data-index="0">
                        <img
                          src="https://images.unsplash.com/photo-1499696010180-025ef6e1a8f9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                          class="object-cover object-center h-20 w-full rounded-lg" alt="Thumbnail 1">
                      </div>
                      <!-- Repeat for other thumbnails -->
                      <div class="p-1 rounded-lg transition-all duration-300 cursor-pointer ring-2 ring-transparent hover:ring-blue-300"
                           data-index="1">
                        <img
                          src="https://images.unsplash.com/photo-1432462770865-65b70566d673?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                          class="object-cover object-center h-20 w-full rounded-lg" alt="Thumbnail 2">
                      </div>
                      <div class="p-1 rounded-lg transition-all duration-300 cursor-pointer ring-2 ring-transparent hover:ring-blue-300"
                           data-index="2">
                        <img
                          src="https://images.unsplash.com/photo-1493246507139-91e8fad9978e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2940&q=80"
                          class="object-cover object-center h-20 w-full rounded-lg" alt="Thumbnail 3">
                      </div>
                      <div class="p-1 rounded-lg transition-all duration-300 cursor-pointer ring-2 ring-transparent hover:ring-blue-300"
                           data-index="3">
                        <img
                          src="https://images.unsplash.com/photo-1518623489648-a173ef7824f3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2762&q=80"
                          class="object-cover object-center h-20 w-full rounded-lg" alt="Thumbnail 4">
                      </div>
                      <div class="p-1 rounded-lg transition-all duration-300 cursor-pointer ring-2 ring-transparent hover:ring-blue-300"
                           data-index="4">
                        <img
                          src="https://images.unsplash.com/photo-1682407186023-12c70a4a35e0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2832&q=80"
                          class="object-cover object-center h-20 w-full rounded-lg" alt="Thumbnail 5">
                      </div>
                    </div>
                  </div>
                  
                  <script>
                  document.addEventListener('DOMContentLoaded', function() {
                    const carouselItems = document.querySelectorAll('[data-carousel-item]');
                    const thumbnails = document.querySelectorAll('[data-index]');
                    let activeIndex = 0;
                    let autoRotateInterval;
                  
                    function updateCarousel(index) {
                      // Update main image
                      carouselItems.forEach(item => {
                        item.classList.toggle('opacity-0', item.dataset.carouselItem != index);
                        item.classList.toggle('opacity-100', item.dataset.carouselItem == index);
                      });
                  
                      // Update thumbnails
                      thumbnails.forEach(thumb => {
                        const ringColor = thumb.dataset.index == index ? 'ring-blue-500' : 'ring-transparent';
                        thumb.className = `p-1 rounded-lg transition-all duration-300 cursor-pointer ring-2 ${ringColor} hover:ring-blue-300`;
                      });
                    }
                  
                    function startAutoRotate() {
                      autoRotateInterval = setInterval(() => {
                        activeIndex = (activeIndex + 1) % carouselItems.length;
                        updateCarousel(activeIndex);
                      }, 5000);
                    }
                  
                    // Thumbnail click handler
                    thumbnails.forEach(thumb => {
                      thumb.addEventListener('click', () => {
                        activeIndex = parseInt(thumb.dataset.index);
                        clearInterval(autoRotateInterval);
                        updateCarousel(activeIndex);
                        startAutoRotate();
                      });
                    });
                  
                    // Initialize
                    updateCarousel(0);
                    startAutoRotate();
                  });
                  </script>
            </div>

        </div>
    </section>
    
    <x-footer></x-footer>
</x-layout>
