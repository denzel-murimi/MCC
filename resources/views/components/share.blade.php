<div x-data="shareComponent"
     x-cloak
     class="relative inline-block">

    <!-- Share Button -->
    <button x-ref="button"
            x-on:click="toggle"
            :aria-expanded="open"
            :aria-controls="panelId"
            type="button"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-100 focus:ring focus:ring-gray-100">
        <span>Share</span>
        <ion-icon name="share-social-outline" class="h-4 w-4"></ion-icon>
    </button>

    <!-- Dropdown Panel -->
    <div x-ref="panel"
         x-show="open"
         x-transition.origin.top.left
         x-on:click.outside="close"
         :id="panelId"
         class="absolute left-0 z-10 mt-2 w-48 rounded-lg border border-gray-100 bg-white text-left text-sm shadow-lg">
        <div class="p-2">
            <!-- Facebook -->
            <button x-on:click="shareFacebook"
                    class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                <ion-icon name="logo-facebook" class="h-5 w-5 text-blue-600"></ion-icon>
                Facebook
            </button>

            <!-- Instagram -->
            <button x-on:click="shareInstagram"
                    class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                <ion-icon name="logo-instagram" class="h-5 w-5 text-pink-600"></ion-icon>
                Instagram
            </button>

            <!-- Twitter/X -->
            <button x-on:click="shareTwitter"
                    class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" class="h-5 w-5">
                    <path d="M14.42 10.63L22.55 0H20.38L13.21 9.24L7.26 0H0L8.51 13.38L0 24H2.17L9.76 14.27L16.05 24H23.31L14.42 10.63ZM10.73 13.32L9.94 12.07L2.68 1.51H6.38L11.96 9.93L12.75 11.19L20.38 22.49H16.69L10.73 13.32Z"></path>
                </svg>
                X/Twitter
            </button>

            <!-- Email -->
            <button x-on:click="shareEmail"
                    class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                <ion-icon name="mail-outline" class="h-5 w-5 text-gray-600"></ion-icon>
                Email
            </button>

            <!-- WhatsApp -->
            <button x-on:click="shareWhatsapp"
                    class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                <ion-icon name="logo-whatsapp" class="h-5 w-5 text-green-600"></ion-icon>
                WhatsApp
            </button>

            <!-- Copy Link -->
            <button x-on:click="copyLink"
                    class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                <ion-icon name="link-outline" class="h-5 w-5 text-gray-600"></ion-icon>
                <span x-text="copyButtonText"></span>
            </button>
        </div>
    </div>

    <!-- Success Toast -->
    <div x-show="copied"
         x-transition
         class="fixed top-4 right-4 rounded-lg bg-indigo-950 px-6 py-3 text-sm text-white shadow-lg z-50 text-center">
        Link copied to clipboard!
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('shareComponent', () => ({
            open: false,
            copied: false,
            panelId: 'share-panel-' + Math.random().toString(36).substr(2, 9),

            get copyButtonText() {
                return this.copied ? 'Copied!' : 'Copy Link';
            },

            init() {
                // Handle escape key
                this.$el.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && this.open) {
                        e.preventDefault();
                        e.stopPropagation();
                        this.close();
                    }
                });

                // Handle focus management
                window.addEventListener('focusin', (e) => {
                    if (this.open && !this.$refs.panel.contains(e.target)) {
                        this.close();
                    }
                });
            },

            toggle() {
                if (this.open) {
                    this.close();
                } else {
                    this.$refs.button.focus();
                    this.open = true;
                }
            },

            close() {
                if (!this.open) return;
                this.open = false;
                this.$refs.button.focus();
            },

            copyLink() {
                const url = window.location.href;
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url)
                        .then(() => {
                            this.copied = true;
                            setTimeout(() => this.copied = false, 2000);
                        })
                        .catch(() => {
                            this.fallbackCopyLink(url);
                        });
                } else {
                    this.fallbackCopyLink(url);
                }
            },

            fallbackCopyLink(url) {
                const textArea = document.createElement('textarea');
                textArea.value = url;
                textArea.style.position = 'fixed';
                textArea.style.left = '-999999px';
                textArea.style.top = '-999999px';
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();

                try {
                    document.execCommand('copy');
                    this.copied = true;
                    setTimeout(() => this.copied = false, 2000);
                } catch (err) {
                    console.error('Copy failed:', err);
                }

                document.body.removeChild(textArea);
            },

            shareFacebook() {
                this.openShareWindow('facebook');
            },

            shareInstagram() {
                this.openShareWindow('instagram');
            },

            shareTwitter() {
                this.openShareWindow('twitter');
            },

            shareEmail() {
                this.openShareWindow('email');
            },

            shareWhatsapp() {
                this.openShareWindow('whatsapp');
            },

            openShareWindow(platform) {
                const shareUrl = encodeURIComponent(window.location.href);
                const shareTitle = encodeURIComponent(document.title);

                const urls = {
                    facebook: `https://www.facebook.com/sharer/sharer.php?u=${shareUrl}`,
                    twitter: `https://twitter.com/intent/tweet?url=${shareUrl}&text=${shareTitle}`,
                    email: `mailto:?subject=${shareTitle}&body=${shareUrl}`,
                    instagram: `https://instagram.com/share?url=${shareUrl}`,
                    whatsapp: `https://wa.me/?text=${shareUrl}`,
                };

                if (urls[platform]) {
                    window.open(urls[platform], '_blank', 'width=600,height=400,scrollbars=yes,resizable=yes');
                }
            }
        }));
    });
</script>
