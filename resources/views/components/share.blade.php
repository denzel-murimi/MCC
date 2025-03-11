<div x-data="{
            open: false,
            copied: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }
                this.$refs.button.focus()
                this.open = true
            },
            close(focusAfter) {
                if (!this.open) return
                this.open = false
                focusAfter && focusAfter.focus()
            },
            copyLink() {
                navigator.clipboard.writeText(window.location.href)
                    .then(() => {
                        this.copied = true;
                        setTimeout(() => this.copied = false, 2000);
                    });
            },
            shareUrl: window.location.href,
            shareTitle: document.title,
            share(platform) {
                const urls = {
                    facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(this.shareUrl)}`,
                    twitter: `https://twitter.com/intent/tweet?url=${encodeURIComponent(this.shareUrl)}&text=${encodeURIComponent(this.shareTitle)}`,
                    email: `mailto:?subject=${encodeURIComponent(this.shareTitle)}&body=${encodeURIComponent(this.shareUrl)}`,
                    instagram: `https://instagram.com/share?url=${encodeURIComponent(this.shareUrl)}`,
                    whatsapp: `https://wa.me/?text=${encodeURIComponent(this.shareUrl)}`,
                    };

                if (urls[platform]) {
                    window.open(urls[platform], '_blank', 'width=600,height=400');
                }
            }
        }"
     x-on:keydown.escape.prevent.stop="close($refs.button)"
     x-on:focusin.window="!$refs.panel.contains($event.target) && close()"
     x-id="['dropdown-button']"
     class="relative inline-block">

    <!-- Share Button -->
    <button x-ref="button"
            x-on:click="toggle()"
            :aria-expanded="open"
            :aria-controls="$id('dropdown-button')"
            type="button"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-100 focus:ring focus:ring-gray-100">
        <span>Share</span>
        <ion-icon name="share-social-outline" class="h-4 w-4"></ion-icon>
    </button>

    <!-- Dropdown Panel -->
    <div x-ref="panel"
         x-show="open"
         x-transition.origin.top.left
         x-on:click.outside="close($refs.button)"
         :id="$id('dropdown-button')"
         class="absolute left-0 z-10 mt-2 w-48 rounded-lg border border-gray-100 bg-white text-left text-sm shadow-lg"
         style="display: none;">
        <div class="p-2">
            <!-- Facebook -->
            <button @click="share('facebook')"
                    class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                <ion-icon name="logo-facebook" class="h-5 w-5 text-blue-600"></ion-icon>
                Facebook
            </button>

            <!-- Instagram -->
            <button @click="share('instagram')"
                    class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                <ion-icon name="logo-instagram" class="h-5 w-5 text-pink-600"></ion-icon>
                Instagram
            </button>

            <!-- Twitter -->
            <button @click="share('twitter')"
                    class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                <i>
                <svg viewBox="0 0 24 24" width="50" height="50" fill="black" xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5">
                    <path d="M14.42 10.63L22.55 0H20.38L13.21 9.24L7.26 0H0L8.51 13.38L0 24H2.17L9.76 14.27L16.05 24H23.31L14.42 10.63ZM10.73 13.32L9.94 12.07L2.68 1.51H6.38L11.96 9.93L12.75 11.19L20.38 22.49H16.69L10.73 13.32Z"></path>
                </svg>
                </i>
                X/Twitter
            </button>

            <!-- Email -->
            <button @click="share('email')"
                    class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                <ion-icon name="mail-outline" class="h-5 w-5 text-gray-600"></ion-icon>
                Email
            </button>

            <!-- Whatsapp -->
            <button @click="share('whatsapp')"
                    class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                <ion-icon name="logo-whatsapp" class="h-5 w-5 text-green-600"></ion-icon>
                WhatsApp
            </button>

            <!-- Copy Link -->
            <button @click="copyLink()"
                    class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                <ion-icon name="link-outline" class="h-5 w-5 text-gray-600"></ion-icon>
                <span x-text="copied ? 'Copied!' : 'Copy Link'"></span>
            </button>
        </div>
    </div>
    <div x-show="copied"
         x-transition
         class="fixed top-4 right-1 -translate-x-1/2 rounded-lg bg-indigo-950 px-6 py-3 text-sm text-white shadow-lg z-50 text-center"
         style="display: none;">
        Link copied to clipboard!
    </div>
</div>
