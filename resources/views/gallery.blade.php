<x-layout>
  <section class="bg-white py-4 md:mb-10 min-h-screen">
      <div class="container max-w-screen-2xl mx-auto px-4">
          <x-navbar></x-navbar>
          <x-title>Gallery</x-title>

          <!-- Gallery Container -->
          <div class="mt-10">
          <div id="masonry-gallery" class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
              <!-- Images will be inserted here -->
          </div>

          <!-- Modal -->
          <div id="image-modal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50">
              <div class="flex items-center justify-center h-full">
                  <div class="bg-white p-6 rounded-lg max-w-3xl w-full mx-4">
                      <img id="modal-image" src="" alt="" class="w-full h-auto rounded-lg">
                      <p id="modal-description" class="mt-4 text-gray-600"></p>
                      <button id="close-modal" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg">Close</button>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </section>
  <x-footer></x-footer>

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
                      imgElement.className = 'mb-4 break-inside-avoid block'; // Added block here
                      
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