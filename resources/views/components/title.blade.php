<div class="text-center lg:text-left" x-data="reload">
    <button
        id="reload"
        @click="reload"
        class="font-semibold text-gray-900 hover:text-gray-400 text-xl md:text-2xl leading-normal transition ease-in-out duration-300 mb-5 lg:mb-0">

        {{ $slot }}
    </button>
    <script @cspNonce>
        document.addEventListener('alpine:init', () => {
            Alpine.data('reload', () => ({
                reload() {
                    window.location.reload();
                }
            }));
        });
    </script>

</div>
