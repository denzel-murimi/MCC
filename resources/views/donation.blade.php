<x-layout>
    <div class="container mx-auto p-4 md:p-6 min-h-screen"
         x-data="{
            activeTab: '{{ session('activeTab') ?? 'mpesa'}}',

            copied: false,

            init() {
                @if($errors->mpesaValidation->any())
                    this.activeTab = 'mpesa';
                    this.scrollToForm();
                @endif
            },

            copyCode() {
                const code = document.querySelector('#code-to-copy');
                this.copiedCode = code ? code.innerHTML.trim() : '';
                navigator.clipboard.writeText(this.copiedCode);
                this.copied = true;
                setTimeout(() => {
                    this.copied = false;
                }, 5000);
            },

            scrollToForm() {
                setTimeout(() => {
                    const formElement = document.querySelector(`#${this.activeTab}-form`);
                    if (formElement) {
                        const rect = formElement.getBoundingClientRect();
                        const targetPosition = window.pageYOffset + rect.top - 20;
                        this.smoothScroll(targetPosition, 500);

                        const firstInput = formElement.querySelector('input');
                        if (firstInput) {
                            firstInput.focus();
                        }
                    }
                }, 100);
            },

            smoothScroll(targetPosition, duration) {
                const startPosition = window.pageYOffset;
                const distance = targetPosition - startPosition;
                let startTime = null;

                function easeInOutQuad(t, b, c, d) {
                    t /= d/2;
                    if (t < 1) return c/2*t*t + b;
                    t--;
                    return -c/2 * (t*(t-2) - 1) + b;
                }

                function animation(currentTime) {
                    if (startTime === null) startTime = currentTime;
                    const timeElapsed = currentTime - startTime;
                    const nextScrollPosition = easeInOutQuad(
                        timeElapsed, startPosition, distance, duration
                    );

                    window.scrollTo(0, nextScrollPosition);

                    if (timeElapsed < duration) {
                        requestAnimationFrame(animation);
                    }
                }

                requestAnimationFrame(animation);
            },

         }"
        x-cloak>
        <x-title>Support Mathare Care Center</x-title>
        <p class="mb-6 text-center text-lg text-gray-700">Your donation helps us continue our mission to provide support
            and care for the community.</p>

        <div class="flex flex-col md:flex-row bg-white rounded-xl shadow-xl overflow-hidden mt-6">
            <!-- Payment Method Selectors (Left Side) -->
            <div class="w-full md:w-1/3 bg-gray-100 p-6">
                <h2 class="text-xl font-bold mb-6 text-center">Choose Payment Method</h2>

                <div class="space-y-4">
                    <button
                        @click="activeTab = 'mpesa'; scrollToForm()"
                        :class="{'bg-green-600 text-white': activeTab === 'mpesa', 'bg-white hover:bg-gray-50': activeTab !== 'mpesa'}"
                        class="flex items-center space-x-3 w-full p-4 rounded-lg transition-all duration-200 shadow">
                        <svg width="24" height="24" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1"
                             xmlns="http://www.w3.org/2000/svg"
                             fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <defs>
                                    <style>.cls-1 {
                                            fill: none;
                                            stroke: #020202;
                                            stroke-miterlimit: 10;
                                            stroke-width: 1.91px;
                                        }</style>
                                </defs>
                                <rect class="cls-1" x="4.36" y="1.5" width="15.27" height="21" rx="2.04"></rect>
                                <path class="cls-1"
                                      d="M13.91,2.45H10.09a.94.94,0,0,1-.95-1h5.72A.94.94,0,0,1,13.91,2.45Z"></path>
                                <path class="cls-1"
                                      d="M9.14,14.86h3.34a1.43,1.43,0,0,0,1.43-1.43h0A1.43,1.43,0,0,0,12.48,12h-1a1.43,1.43,0,0,1-1.43-1.43h0a1.43,1.43,0,0,1,1.43-1.43h3.34"></path>
                                <line class="cls-1" x1="12" y1="7.23" x2="12" y2="9.14"></line>
                                <line class="cls-1" x1="12" y1="14.86" x2="12" y2="16.77"></line>
                            </g>
                        </svg>
                        <div class="text-left">
                            <p class="font-semibold">M-Pesa</p>
                            <p class="text-xs"
                               :class="{'text-gray-100': activeTab === 'mpesa', 'text-gray-500': activeTab !== 'mpesa'}">
                                Mobile money transfer</p>
                        </div>
                    </button>

                    <button
                        @click="activeTab = 'paypal'; scrollToForm()"
                        :class="{'bg-blue-600 text-white': activeTab === 'paypal', 'bg-white hover:bg-gray-50': activeTab !== 'paypal'}"
                        class="flex items-center space-x-3 w-full p-4 rounded-lg transition-all duration-200 shadow">
                        <svg fill="#000000" width="24" height="24" viewBox="0 0 512 512" id="Layer_1"
                             data-name="Layer 1"
                             xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M424.81,148.79c-.43,2.76-.93,5.58-1.49,8.48-19.17,98-84.76,131.8-168.54,131.8H212.13a20.67,20.67,0,0,0-20.47,17.46L169.82,444.37l-6.18,39.07a10.86,10.86,0,0,0,9.07,12.42,10.72,10.72,0,0,0,1.7.13h75.65a18.18,18.18,0,0,0,18-15.27l.74-3.83,14.24-90,.91-4.94a18.16,18.16,0,0,1,18-15.3h11.31c73.3,0,130.67-29.62,147.44-115.32,7-35.8,3.38-65.69-15.16-86.72A72.27,72.27,0,0,0,424.81,148.79Z"></path>
                                <path
                                    d="M385.52,51.09C363.84,26.52,324.71,16,274.63,16H129.25a20.75,20.75,0,0,0-20.54,17.48l-60.55,382a12.43,12.43,0,0,0,10.39,14.22,12.58,12.58,0,0,0,1.94.15h89.76l22.54-142.29-.7,4.46a20.67,20.67,0,0,1,20.47-17.46h42.65c83.77,0,149.36-33.86,168.54-131.8.57-2.9,1.05-5.72,1.49-8.48h0C410.94,98.06,405.19,73.41,385.52,51.09Z"></path>
                            </g>
                        </svg>
                        <div class="text-left">
                            <p class="font-semibold">PayPal</p>
                            <p class="text-xs"
                               :class="{'text-gray-100': activeTab === 'paypal', 'text-gray-500': activeTab !== 'paypal'}">
                                Credit/Debit Card</p>
                        </div>
                    </button>

                    <button
                        @click="activeTab = 'bitcoin'; scrollToForm()"
                        :class="{'bg-orange-600 text-white': activeTab === 'bitcoin', 'bg-white hover:bg-gray-50': activeTab !== 'bitcoin'}"
                        class="flex items-center space-x-3 w-full p-4 rounded-lg transition-all duration-200 shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-bitcoin">
                            <path
                                d="M11.767 19.089c4.924.868 6.14-6.025 1.216-6.894m-1.216 6.894L5.86 18.047m5.908 1.042-.347 1.97m1.563-8.864c4.924.869 6.14-6.025 1.215-6.893m-1.215 6.893-3.94-.694m5.155-6.2L8.29 4.26m5.908 1.042.348-1.97M7.48 20.364l3.126-17.727"/>
                        </svg>
                        <div class="text-left">
                            <p class="font-semibold">Bitcoin</p>
                            <p class="text-xs"
                               :class="{'text-gray-100': activeTab === 'bitcoin', 'text-gray-500': activeTab !== 'bitcoin'}">
                                Cryptocurrency</p>
                        </div>
                    </button>
                </div>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">100% of your donation goes directly to the operational costs of the
                        organization.</p>
                    <div class="flex justify-center space-x-4 mt-4">
                        <span class="text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <span class="text-sm text-gray-600">Secure Transaction</span>
                    </div>
                </div>
            </div>

            <!-- Payment Forms (Right Side) -->
            <div class="w-full md:w-2/3 p-6">
                <!-- Dynamic Form Container -->
                <div class="max-w-lg mx-auto">
                    <!-- M-Pesa Form -->
                    <div id="mpesa-form" x-show="activeTab === 'mpesa'" x-transition>
                        <div class="flex justify-center items-center">
                            <img src="{{asset('images/mpesa.png')}}" alt="MPESA">
                        </div>
                        <form method="POST" action="{{ route('mpesa.donate') }}"
                              class="space-y-6 bg-gray-100 p-4 rounded-lg">
                            @csrf
                            <div
                                x-data="{
                                            phoneNumber: '{{ old('phone') ?? '' }}',
                                            selectedCountry: {code: '+254', name: 'Kenya', flag: '🇰🇪'},
                                            countries: [
                                                {code: '+254', name: 'Kenya', flag: '🇰🇪'},
                                            ],
                                            isOpen: false,
                                            fullNumber: '',
                                            init() {
                                                this.updateFullNumber();
                                            },
                                            selectCountry(country) {
                                                this.selectedCountry = country;
                                                this.isOpen = false;
                                                this.updateFullNumber();
                                            },
                                            updateFullNumber() {
                                                this.fullNumber = this.selectedCountry.code + ' ' + (this.phoneNumber || '');
                                            }
                                        }"
                                x-init="init()"
                                x-cloak
                            >
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>

                                <div class="flex items-center">
                                    <div class="relative">
                                        <div
                                            @click="isOpen = !isOpen"
                                            class="flex items-center border rounded p-2 cursor-pointer"
                                        >
                                            <span class="mr-2" x-text="selectedCountry.flag"></span>
                                            <span x-text="selectedCountry.code"></span>
                                        </div>

                                        <div
                                            x-show="isOpen"
                                            @click.outside="isOpen = false"
                                            class="absolute z-10 w-48 border rounded mt-1 bg-white shadow-lg max-h-60 overflow-y-auto"
                                        >
                                            <template x-for="country in countries" :key="country.code">
                                                <div
                                                    @click="selectCountry(country)"
                                                    class="flex items-center p-2 hover:bg-gray-100 cursor-pointer"
                                                >
                                                    <span class="mr-2" x-text="country.flag"></span>
                                                    <span x-text="country.name"></span>
                                                    <span class="ml-auto text-gray-500" x-text="country.code"></span>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <input
                                        type="tel"
                                        x-model="phoneNumber"
                                        @input="updateFullNumber()"
                                        name="phone"
                                        id="phone"
                                        placeholder="(e.g. '712345678' or '112345678')"
                                        class="border rounded p-2 w-full ml-2
                                            {{
                                                $errors->mpesaValidation->has('phone')
                                                ? 'border-red-500 text-red-900 focus:ring placeholder-red-300 focus:border-red-500 focus:ring-red-300'
                                                : 'border-gray-300 focus:ring focus:ring-green-300 focus:border-green-500'
                                            }}"
                                        autocomplete="tel"
                                        required
                                    >
                                </div>

                                <!-- Optional: Display selected phone number -->
                                <div class="mt-2 text-sm text-gray-600">
                                    Full Number: <span x-text="fullNumber"></span>
                                </div>

                                @error('phone','mpesaValidation')
                                <p class="text-red-600 text-xs mt-2">{{$message}}</p>
                                @enderror
                            </div>

                            <div x-data="{
                                            amount: '{{old('amount') ?? ''}}',
                                            predefinedAmounts: [100, 500, 1000, 2000, 5000, 10000],
                                            selectAmount(value) {
                                                this.amount = value;
                                            }
                                         }">

                                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount
                                    (KES)</label>

                                <div class="mb-2 grid grid-cols-2 sm:grid-cols-3 gap-2 overflow-x-auto space-x-2">
                                    <template x-for="preset in predefinedAmounts" :key="preset">
                                        <button
                                            type="button"
                                            @click="selectAmount(preset)"
                                            class="px-3 py-1 bg-green-100 text-green-700 rounded-md hover:bg-green-200 transition-colors whitespace-nowrap"
                                            x-text="preset.toLocaleString() + ' KES'"
                                        ></button>
                                    </template>
                                </div>

                                <div class="relative">
                                    <span
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">KES</span>
                                    <input
                                        type="number"
                                        min="1"
                                        name="amount"
                                        id="amount"
                                        x-model="amount"
                                        class="w-full p-3 pl-12 border border-gray-300 rounded-lg focus:ring focus:ring-green-300 focus:border-green-500"
                                        required
                                    >
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200"
                            >
                                Donate via M-Pesa
                            </button>
                        </form>

                        <p class="text-xs text-gray-600 text-center mt-4">
                            You will receive an STK push notification on your phone to complete the payment
                        </p>
                    </div>

                    <!-- PayPal Form -->
                    <div id="paypal-form" x-show="activeTab === 'paypal'" x-transition>
                        <div class="flex justify-center items-center mb-4">
                            <img src="{{asset('images/paypal.png')}}" alt="PAYPAL" class="w-24">
                        </div>
                        <div class="space-y-6">
                            <div id="donate-button-container"
                                 class="flex justify-center items-center h-40 bg-gray-100 hover:bg-gray-200">
                                <div id="donate-button" class="p-4 border rounded border-gray-300 cursor-pointer"></div>
                                <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js"
                                        charset="UTF-8"></script>
                                <script>
                                    PayPal.Donation.Button({
                                        env: 'sandbox',
                                        hosted_button_id: 'YD2FH9CE4HBHC',
                                        image: {
                                            src: 'https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif',
                                            alt: 'Donate with PayPal button',
                                            title: 'PayPal - The safer, easier way to pay online!',
                                        },
                                        onComplete: function (params) {
                                            console.log("DonationComplete:" ,params);
                                            fetch('/paypal-complete',{
                                                method: 'post',
                                                headers: {
                                                    'Content-Type' : 'application/json',
                                                    'X-CSRF-TOKEN' : '{{csrf_token()}}',
                                                },
                                                body: JSON.stringify(params)
                                            });
                                        }
                                    }).render('#donate-button');
                                </script>
                            </div>


                            <p class="text-sm text-gray-600 text-center mt-6">
                                You will be redirected to PayPal to complete your donation securely.
                                You can use your PayPal account or credit/debit card.
                            </p>
                        </div>
                    </div>

                    <!-- Bitcoin Form -->
                    <div id="bitcoin-form" x-show="activeTab === 'bitcoin'" x-transition>
                        <div class="flex justify-center items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="50%" height="50%"
                                 version="1.1" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                                 image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"
                                 viewBox="0 0 4257.46 889.51"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                 xmlns:xodm="http://www.corel.com/coreldraw/odm/2003">
                                     <g id="Layer_x0020_1">
                                         <metadata id="CorelCorpID_0Corel-Layer"/>
                                         <g id="_1421487920208">
                                             <path fill="#F7931A" fill-rule="nonzero"
                                                   d="M875.92 551.95c-59.08,238.24 -300.11,383.47 -538.36,324.39 -238.24,-59.07 -383.47,-300.11 -324.39,-538.35 59.08,-238.25 300.11,-383.49 538.35,-324.41 0.4,0.1 0.81,0.2 1.21,0.31 237.61,59.63 382.17,300.28 323.19,538.06z"/>
                                             <path fill="white" fill-rule="nonzero"
                                                   d="M545.37 380.28c-13.89,55.56 -98.61,27.08 -126.11,20.28l24.3 -97.22c27.08,6.67 115.7,19.44 101.39,76.94l0.42 0zm-15.14 157.1c-15,60.54 -116.94,27.78 -150,19.57l26.8 -107.36c33.06,8.33 138.89,24.58 123.2,87.79zm111.11 -156.26c8.75,-59.17 -36.25,-90.97 -97.22,-112.08l20 -80.14 -49.3 -12.22 -19.44 78.06c-12.78,-3.19 -25.97,-6.25 -39.03,-9.17l19.44 -78.89 -48.75 -12.22 -20 80.14 -31.11 -6.94 -67.36 -16.81 -12.92 52.09c0,0 36.11,8.33 35.42,8.89 13.79,1.67 23.85,13.92 22.78,27.78l-22.78 91.25c1.71,0.39 3.39,0.94 5,1.67l-5.14 -1.39 -31.81 127.92c-2.98,9.36 -12.98,14.51 -22.35,11.53l-0.01 0c0,0.69 -35.56,-8.75 -35.56,-8.75l-24.17 55.56 63.47 15.7 34.72 9.03 -20.14 80.97 48.75 12.22 20 -80.14c13.14,3.61 26.07,6.94 38.75,10l-19.72 80.42 48.75 12.08 20.14 -80.83c83.33,15.71 145.69,9.44 172.08,-65.83 21.25,-60.56 -1.11,-95.42 -44.86,-118.2 31.94,-7.36 55.56,-27.78 62.36,-71.67z"/>
                                             <path fill="#4D4D4D" fill-rule="nonzero"
                                                   d="M1157.17 750c25.96,0.08 51.5,-6.53 74.17,-19.17 23.33,-12.44 43.85,-29.57 60.28,-50.28 17.12,-21.9 30.58,-46.43 39.86,-72.64 9.79,-27.08 14.76,-55.65 14.72,-84.44 1.56,-29.21 -4.68,-58.31 -18.06,-84.31 -11.94,-20.14 -34.17,-30.41 -66.39,-30.41 -14.04,0.48 -28,2.39 -41.67,5.69 -16.97,3.79 -32.67,11.93 -45.56,23.61l-73.61 307.78 11.81 2.22c3.51,0.86 7.1,1.42 10.69,1.67 4.61,0.57 9.25,0.8 13.89,0.69l19.86 -0.42zm146.25 -481.11c32.15,-0.74 64.07,5.82 93.33,19.17 25.4,12.11 47.72,29.82 65.28,51.81 17.98,22.74 31.2,48.85 38.89,76.8 8.42,30.82 12.57,62.64 12.36,94.59 -0.04,99.4 -38.57,194.91 -107.5,266.53 -33.42,34.28 -73.18,61.72 -117.08,80.83 -46.03,20.26 -95.82,30.59 -146.11,30.28l-35.56 0c-19.33,-0.63 -38.63,-2.29 -57.78,-5 -23.39,-3.39 -46.57,-8.02 -69.44,-13.89 -23.98,-5.69 -47.26,-13.98 -69.44,-24.72l195.14 -817.5 174.31 -27.78 -69.44 290.14c14.46,-6.54 29.47,-11.79 44.86,-15.69 15.86,-3.86 32.15,-5.78 48.47,-5.69l-0.28 0.14z"/>
                                             <path fill="#4D4D4D" fill-rule="nonzero"
                                                   d="M1774.39 209.3c-22.72,0.22 -44.87,-7.06 -63.06,-20.69 -19.28,-15.25 -29.7,-39.1 -27.78,-63.61 -0.08,-15.29 3.18,-30.42 9.58,-44.31 6.13,-13.53 14.74,-25.78 25.42,-36.11 10.67,-10.14 23.03,-18.32 36.53,-24.17 14.04,-6.03 29.17,-9.1 44.44,-9.03 22.56,-0.07 44.5,7.25 62.5,20.83 19.24,15.28 29.65,39.11 27.78,63.61 0.12,15.33 -3.1,30.5 -9.44,44.44 -6.13,13.46 -14.7,25.65 -25.28,35.97 -10.64,10.18 -23,18.36 -36.53,24.17 -14.04,6.03 -29.17,9.06 -44.44,8.89l0.28 0zm-80.97 663.76l-166.67 0 140.83 -591.68 167.64 0 -141.81 591.68z"/>
                                             <path fill="#4D4D4D" fill-rule="nonzero"
                                                   d="M1981.06 134.03l174.3 -26.94 -43.33 174.31 186.68 0 -33.63 137.22 -185.14 0 -49.44 206.39c-4.28,15.8 -6.93,32 -7.92,48.35 -1.02,13.22 0.94,26.5 5.69,38.87 4.65,11.1 13.26,20.07 24.17,25.14 15.7,6.94 32.84,10.1 50,9.17 17.58,0.06 35.12,-1.67 52.36,-5.14 17.35,-3.39 34.44,-8.03 51.11,-13.89l12.5 128.33c-23.93,8.6 -48.38,15.71 -73.2,21.25 -30.67,6.51 -61.98,9.54 -93.33,9.03 -51.81,0 -91.81,-7.78 -120.42,-23.06 -26.76,-13.61 -48.2,-35.81 -60.83,-63.06 -12.33,-28.91 -17.71,-60.31 -15.69,-91.67 1.87,-36.79 7.12,-73.33 15.69,-109.17l110.42 -465.69 0 0.56z"/>
                                             <path fill="#4D4D4D" fill-rule="nonzero"
                                                   d="M2292.59 636.8c-0.35,-49.08 8.01,-97.86 24.72,-144.02 15.67,-43.65 39.74,-83.8 70.83,-118.19 31.35,-34.11 69.47,-61.26 111.94,-79.74 46.32,-20 96.35,-29.99 146.8,-29.29 30.46,-0.36 60.86,2.85 90.56,9.57 24.97,5.92 49.26,14.39 72.5,25.28l-57.91 130.14c-15,-6.11 -30.56,-11.37 -46.67,-16.25 -19.21,-5.35 -39.1,-7.83 -59.03,-7.36 -50.36,-1.82 -98.8,19.47 -131.53,57.78 -32.5,38.23 -48.81,89.62 -48.89,154.17 -1.53,32.74 7.11,65.14 24.72,92.79 16.47,23.61 46.86,35.4 91.11,35.4 21.21,0.02 42.35,-2.26 63.06,-6.8 18.47,-3.94 36.57,-9.56 54.03,-16.81l12.36 133.9c-22.72,8.6 -45.9,15.93 -69.44,21.93 -29.89,6.74 -60.47,9.92 -91.11,9.46 -40.67,1.18 -81.15,-5.67 -119.17,-20.15 -30.22,-12.18 -57.43,-30.8 -79.72,-54.57 -21.15,-23.04 -36.78,-50.6 -45.69,-80.57 -9.43,-31.54 -14.11,-64.31 -13.89,-97.22l0.42 0.56z"/>
                                             <path fill="#4D4D4D" fill-rule="nonzero"
                                                   d="M3114.94 407.5c-23.5,-0.33 -46.47,7.14 -65.28,21.25 -19.07,14.76 -35.07,33.13 -47.08,54.03 -13.21,22.25 -23.13,46.31 -29.44,71.41 -6.11,24.06 -9.29,48.76 -9.44,73.59 -1.5,30.31 4.67,60.49 17.92,87.78 12.09,20.97 33.75,31.53 65.28,31.53 23.54,0.4 46.54,-7.13 65.28,-21.39 19.11,-14.76 35.14,-33.13 47.22,-54.01 13.02,-22.28 22.7,-46.33 28.76,-71.41 6.04,-24.11 9.22,-48.87 9.43,-73.75 1.56,-30.29 -4.63,-60.5 -17.92,-87.78 -12.08,-20.83 -33.89,-31.39 -65.28,-31.39l0.56 0.14zm-83.33 481.39c-35.39,0.82 -70.58,-5.32 -103.61,-18.06 -27.79,-10.96 -52.61,-28.26 -72.5,-50.56 -19.56,-22.46 -34.29,-48.69 -43.33,-77.08 -9.82,-31.83 -14.52,-65.03 -13.89,-98.33 0.11,-45.86 7.46,-91.43 21.82,-135 13.93,-43.85 35.68,-84.82 64.15,-120.97 28.6,-36.14 64.17,-66.18 104.58,-88.33 43.5,-23.39 92.28,-35.21 141.67,-34.31 35.18,-0.64 70.18,5.5 103.06,18.06 27.82,10.78 52.78,27.85 72.91,49.86 19.44,22.52 34.14,48.74 43.2,77.08 9.89,31.86 14.58,65.11 13.89,98.47 -0.14,45.82 -7.31,91.36 -21.25,135 -13.69,43.91 -35.04,85.04 -63.06,121.53 -28.18,36.29 -63.61,66.33 -104.03,88.2 -44.17,23.51 -93.58,35.37 -143.61,34.44z"/>
                                             <path fill="#4D4D4D" fill-rule="nonzero"
                                                   d="M3626.75 209.3c-22.68,0.24 -44.81,-7.04 -62.91,-20.69 -19.29,-15.25 -29.71,-39.1 -27.78,-63.61 -0.08,-15.29 3.18,-30.42 9.57,-44.31 5.96,-13.46 14.33,-25.69 24.72,-36.11 10.74,-10.11 23.14,-18.29 36.67,-24.17 14,-6.02 29.08,-9.09 44.32,-9.03 22.72,-0.2 44.91,7.14 63.06,20.83 19.24,15.28 29.64,39.11 27.78,63.61 0.03,15.35 -3.29,30.52 -9.74,44.44 -6.02,13.47 -14.56,25.68 -25.13,35.97 -10.64,10.18 -23,18.36 -36.53,24.17 -13.92,5.97 -28.9,9 -44.04,8.89zm-80.82 663.76l-166.67 0 140.56 -591.68 167.78 0 -141.67 591.68z"/>
                                             <path fill="#4D4D4D" fill-rule="nonzero"
                                                   d="M3807.59 308.33c12.64,-3.61 26.67,-8.06 41.67,-12.91 15,-4.86 32.5,-9.31 51.79,-13.89 21.17,-4.49 42.54,-7.87 64.04,-10.14 26.71,-2.82 53.56,-4.17 80.42,-4.03 87.78,0 148.33,25.5 181.67,76.53 19.96,30.56 30.06,67.84 30.3,111.85l0 3.17c-0.15,28.62 -4.42,60.05 -12.8,94.28l-76.53 319.44 -167.22 0 74.3 -312.79c4.44,-19.43 8.06,-38.32 10.7,-56.79 2.89,-15.99 2.89,-32.36 0,-48.33 -2.76,-13.35 -10.14,-25.29 -20.83,-33.75 -14.82,-9.72 -32.46,-14.26 -50.14,-12.92 -22.26,0.04 -44.46,2.32 -66.25,6.81l-109.17 458.33 -168.21 0 136.26 -564.86z"/>
                                         </g>
                                     </g>
                            </svg>
                        </div>
{{--                        <div class="space-y-6">--}}
{{--                            <div class="bg-gray-100 p-4 rounded-lg text-center">--}}
{{--                                <p class="text-sm text-gray-700 mb-4">Send your donation to the following Bitcoin--}}
{{--                                    address:</p>--}}
{{--                                <div class="bg-white p-3 rounded border border-gray-300">--}}
{{--                                    <p class="font-mono text-sm break-all select-all" id="code-to-copy">--}}
{{--                                        bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh</p>--}}
{{--                                </div>--}}

{{--                                <div class="my-6 flex justify-center">--}}
{{--                                    <!-- This would be a QR code in a real implementation -->--}}
{{--                                    <div--}}
{{--                                        class="w-48 h-48 bg-white border border-gray-300 rounded-lg flex items-center justify-center">--}}
{{--                                        <p class="text-gray-500 text-sm">Bitcoin QR Code</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="mt-4">--}}
{{--                                    <button--}}
{{--                                        @click="copyCode()"--}}
{{--                                        class="text-orange-600 hover:text-orange-700 font-medium">--}}
{{--                                        <span class="flex items-center justify-center">--}}
{{--                                            <svg x-show="!copied"--}}
{{--                                                 xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"--}}
{{--                                                 viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                                      d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>--}}
{{--                                            </svg>--}}
{{--                                            <svg--}}
{{--                                                x-show="copied"--}}
{{--                                                xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                class="h-5 w-5 mr-2 text-green-500"--}}
{{--                                                fill="none"--}}
{{--                                                viewBox="0 0 24 24"--}}
{{--                                                stroke="currentColor">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                                      d="M5 13l4 4L19 7"/>--}}
{{--                                            </svg>--}}
{{--                                            Copy Address--}}
{{--                                        </span>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <form class="mt-6">--}}
{{--                                <div>--}}
{{--                                    <label for="btc-email" class="block text-sm font-medium text-gray-700">Email--}}
{{--                                        (Optional - to receive a donation receipt)</label>--}}
{{--                                    <input type="email" id="btc-email"--}}
{{--                                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-orange-300 focus:border-orange-500">--}}
{{--                                </div>--}}

{{--                                <button type="submit"--}}
{{--                                        class="w-full bg-orange-600 hover:bg-orange-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 mt-4">--}}
{{--                                    I've Made My Donation--}}
{{--                                </button>--}}
{{--                            </form>--}}

{{--                            <p class="text-xs text-gray-600 text-center mt-4">--}}
{{--                                After sending your donation, click the button above to let us know!--}}
{{--                            </p>--}}
{{--                        </div>--}}
                        <div class="space-y-6 flex items-center justify-center border-2 border-gray-200 rounded-lg">
                        <iframe src="https://nowpayments.io/embeds/donation-widget?api_key=7BZGMY9-2PEM4DK-QBKZB2Z-YXDTDMT" width="346" height="623" frameborder="0" scrolling="no" style="overflow-y: hidden;">
                            Can't load widget
                        </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Impact Section -->
        <div class="mt-12 text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Your Impact</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-green-600 text-4xl font-bold mb-2">$25</div>
                    <p class="text-gray-700">Provides meals for 10 children for a day</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-green-600 text-4xl font-bold mb-2">$50</div>
                    <p class="text-gray-700">Supplies cleaning materials for the compound</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-green-600 text-4xl font-bold mb-2">$100</div>
                    <p class="text-gray-700">Funds medical care for 5 disabled children</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
