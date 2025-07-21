<x-layout>
    <section class="bg-white py-4 md:mb-10 min-h-screen">
        <div class="container max-w-screen-2xl mx-auto px-4">
            <x-title>Gallery</x-title>

            <!-- Loading State -->
            <div id="loading-state" class="flex justify-center items-center mt-10">
                <svg class="animate-spin h-10 w-10 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="ml-3 text-gray-600">Loading gallery...</span>
            </div>

            <!-- Error Message -->
            <div id="error-message" class="hidden mt-10 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p id="error-text" class="text-red-700">Unable to load gallery images.</p>
                </div>
                <button id="retry-button" class="mt-3 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                    Try Again
                </button>
            </div>

            <!-- Empty Gallery State -->
            <div id="empty-gallery" class="hidden mt-10 p-8 text-center bg-gray-50 rounded-lg border border-gray-200">
                <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No images found</h3>
                <p class="mt-2 text-gray-500">There are currently no images in this gallery.</p>
            </div>

            <!-- Gallery Container -->
            <div id="masonry-gallery" class="hidden mt-10 columns-2 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
                <!-- Images will be inserted here by JavaScript -->
            </div>

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
    </section>
    <script @cspNonce>
        document.addEventListener('DOMContentLoaded', function() {
            const gallery = document.getElementById('masonry-gallery');
            const loadingState = document.getElementById('loading-state');
            const errorMessage = document.getElementById('error-message');
            const errorText = document.getElementById('error-text');
            const emptyGallery = document.getElementById('empty-gallery');
            const retryButton = document.getElementById('retry-button');
            const modal = document.getElementById('image-modal');
            const modalImage = document.getElementById('modal-image');
            const modalDescription = document.getElementById('modal-description');
            const closeModal = document.getElementById('close-modal');

            function loadGallery() {
                // Reset state
                gallery.classList.add('hidden');
                loadingState.classList.remove('hidden');
                errorMessage.classList.add('hidden');
                emptyGallery.classList.add('hidden');

                fetch('/api/media-manager/folders/1')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        loadingState.classList.add('hidden');

                        const images = data.data.media;

                        // Clear existing images
                        gallery.innerHTML = '';

                        if (!images || images.length === 0) {
                            emptyGallery.classList.remove('hidden');
                            return;
                        }

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

                        gallery.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error fetching gallery:', error);
                        loadingState.classList.add('hidden');

                        // Show appropriate error message
                        if (error.message.includes('404')) {
                            errorText.textContent = 'Gallery not found. The requested gallery folder does not exist.';
                        } else if (error.message.includes('500')) {
                            errorText.textContent = 'Server error. Please try again later.';
                        } else {
                            errorText.textContent = 'Unable to load gallery images. Please check your connection and try again.';
                        }

                        errorMessage.classList.remove('hidden');
                    });
            }

            // Initial load
            loadGallery();

            // Retry button
            retryButton.addEventListener('click', loadGallery);

            // Modal functionality
            closeModal.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
</x-layout>
