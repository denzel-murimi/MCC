<x-layout>
  <section class="bg-white py-4 md:mb-10 min-h-screen">
      <div class="container max-w-screen-2xl mx-auto px-4">
          <x-title>Gallery</x-title>

          <!-- Gallery Container -->
          <div class="mt-10">
          <div id="masonry-gallery" class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">        

          <!-- Modal -->
          <div id="image-modal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 overflow-auto">
              <div class="flex items-center justify-center min-h-screen p-4">
                  <div class="relative max-w-3xl w-full mx-4">
                    <button id="close-modal" class="absolute top-4 right-4 bg-black bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75 transition-opacity">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                      <img id="modal-image" src="" alt="" class="w-full h-auto rounded-lg">
                      <p id="modal-description" class="absolute bottom-5 left-0 right-0 bg-black bg-opacity-50 text-white text-center p-2"></p>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const gallery = document.getElementById('masonry-gallery');
          const modal = document.getElementById('image-modal');
          const modalImage = document.getElementById('modal-image');
          const modalDescription = document.getElementById('modal-description');
          const closeModal = document.getElementById('close-modal');

          fetch('/api/media-manager/folders/1')
              .then(response => response.json())
              .then(data => {
                  const images = data.data.media;
                  
                  images.forEach(image => {
                      const imgElement = document.createElement('div');
                      imgElement.className = 'mb-4 break-inside-avoid block';
                      
                      const filename = image.custom_properties?.original_filename || 'Gallery Image';
                      const description = image.custom_properties?.description || '';
                      
                      imgElement.innerHTML = `
                          <img 
                              src="${image.url}" 
                              alt="${filename}" 
                              class="w-full h-auto rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                              data-description="${description}"
                          >
                      `;
                      
                      gallery.appendChild(imgElement);
                      
                      const imgNode = imgElement.querySelector('img');
                      imgNode.addEventListener('click', () => {
                          modalImage.src = image.url;
                          modalDescription.textContent = description || 'No description available...';
                          modal.classList.remove('hidden');
                      });
                  });
              })
              .catch(error => {
                  console.error('Error fetching gallery:', error);
              });

          closeModal.addEventListener('click', () => {
              modal.classList.add('hidden');
          });

          modal.addEventListener('click', (e) => {
              if (e.target === modal) {
                  modal.classList.add('hidden');
              }
          });
      });
  </script>
</x-layout>