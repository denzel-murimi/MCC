<x-layout>
    <div class="container mx-auto p-4 md:p-6 min-h-screen"
         x-data="{
            activeTab: '{{ session('activeTab') ?? 'paystack'}}',

            copied: false,

            init() {
{{--                @if($errors->mpesaValidation->any())--}}
{{--                    this.activeTab = 'mpesa';--}}
{{--                    this.scrollToForm();--}}
{{--                @endif--}}
                @if($errors->paystackValidation->any())
                    this.activeTab = 'paystack';
{{--                    this.scrollToForm();--}}
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

{{--            scrollToForm() {--}}
{{--                setTimeout(() => {--}}
{{--                    const formElement = document.querySelector(`#${this.activeTab}-form`);--}}
{{--                    if (formElement) {--}}
{{--                        const rect = formElement.getBoundingClientRect();--}}
{{--                        const targetPosition = window.pageYOffset + rect.top - 20;--}}
{{--                        this.smoothScroll(targetPosition, 500);--}}

{{--                        const firstInput = formElement.querySelector('input');--}}
{{--                        if (firstInput) {--}}
{{--                            firstInput.focus();--}}
{{--                        }--}}
{{--                    }--}}
{{--                }, 100);--}}
{{--            },--}}

{{--            smoothScroll(targetPosition, duration) {--}}
{{--                const startPosition = window.pageYOffset;--}}
{{--                const distance = targetPosition - startPosition;--}}
{{--                let startTime = null;--}}

{{--                function easeInOutQuad(t, b, c, d) {--}}
{{--                    t /= d/2;--}}
{{--                    if (t < 1) return c/2*t*t + b;--}}
{{--                    t--;--}}
{{--                    return -c/2 * (t*(t-2) - 1) + b;--}}
{{--                }--}}

{{--                function animation(currentTime) {--}}
{{--                    if (startTime === null) startTime = currentTime;--}}
{{--                    const timeElapsed = currentTime - startTime;--}}
{{--                    const nextScrollPosition = easeInOutQuad(--}}
{{--                        timeElapsed, startPosition, distance, duration--}}
{{--                    );--}}

{{--                    window.scrollTo(0, nextScrollPosition);--}}

{{--                    if (timeElapsed < duration) {--}}
{{--                        requestAnimationFrame(animation);--}}
{{--                    }--}}
{{--                }--}}

{{--                requestAnimationFrame(animation);--}}
{{--            },--}}

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
{{--                    <button--}}
{{--                        @click="activeTab = 'mpesa'; scrollToForm()"--}}
{{--                        :class="{'bg-green-600 text-white': activeTab === 'mpesa', 'bg-white hover:bg-gray-50': activeTab !== 'mpesa'}"--}}
{{--                        class="flex items-center space-x-3 w-full p-4 rounded-lg transition-all duration-200 shadow">--}}
{{--                        <svg width="24" height="24" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1"--}}
{{--                             xmlns="http://www.w3.org/2000/svg"--}}
{{--                             fill="#000000">--}}
{{--                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>--}}
{{--                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>--}}
{{--                            <g id="SVGRepo_iconCarrier">--}}
{{--                                <defs>--}}
{{--                                    <style>.cls-1 {--}}
{{--                                            fill: none;--}}
{{--                                            stroke: #020202;--}}
{{--                                            stroke-miterlimit: 10;--}}
{{--                                            stroke-width: 1.91px;--}}
{{--                                        }</style>--}}
{{--                                </defs>--}}
{{--                                <rect class="cls-1" x="4.36" y="1.5" width="15.27" height="21" rx="2.04"></rect>--}}
{{--                                <path class="cls-1"--}}
{{--                                      d="M13.91,2.45H10.09a.94.94,0,0,1-.95-1h5.72A.94.94,0,0,1,13.91,2.45Z"></path>--}}
{{--                                <path class="cls-1"--}}
{{--                                      d="M9.14,14.86h3.34a1.43,1.43,0,0,0,1.43-1.43h0A1.43,1.43,0,0,0,12.48,12h-1a1.43,1.43,0,0,1-1.43-1.43h0a1.43,1.43,0,0,1,1.43-1.43h3.34"></path>--}}
{{--                                <line class="cls-1" x1="12" y1="7.23" x2="12" y2="9.14"></line>--}}
{{--                                <line class="cls-1" x1="12" y1="14.86" x2="12" y2="16.77"></line>--}}
{{--                            </g>--}}
{{--                        </svg>--}}
{{--                        <div class="text-left">--}}
{{--                            <p class="font-semibold">M-Pesa</p>--}}
{{--                            <p class="text-xs"--}}
{{--                               :class="{'text-gray-100': activeTab === 'mpesa', 'text-gray-500': activeTab !== 'mpesa'}">--}}
{{--                                Mobile money transfer</p>--}}
{{--                        </div>--}}
{{--                    </button>--}}

                    <button
                        @click="activeTab = 'paystack';"
                        :class="{'bg-gradient-to-r from-green-600 to-blue-600 text-white': activeTab === 'paystack', 'bg-white hover:bg-gray-50': activeTab !== 'paystack'}"
                        class="flex items-center space-x-3 w-full p-4 rounded-lg transition-all duration-200 shadow">
                        <svg
                            height="24" viewBox="0 0 780 500" width="24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g transform="translate(15 15)">
                                <path
                                    d="m709.241 1h-669.485c-21.128 0-38.256 16.705-38.256 37.31v391.756c0 20.604 17.128 37.31 38.256 37.31h669.485c21.132 0 38.259-16.705 38.259-37.31v-391.756c0-20.605-17.127-37.31-38.259-37.31z" fill="none"
                                    stroke="#393939" stroke-width="30"/><g
                                    fill-opacity=".196">
                                    <path d="m677.65 276.44h4.016l.384 10.516h10.945l-10.12-23.386 3.796-1.609 11.165 25.315v3.219h-15.73v9.009h-4.456v-9.009h-4.893v-3.539h4.893zm-23.625-14.479c3.851 0 7.534 1.287 10.726 4.29l-2.477 2.735c-2.529-2.306-4.785-3.431-8.028-3.431-4.015 0-7.205 2.197-7.205 6.273 0 4.452 3.576 6.491 7.205 6.491h2.255l.55 3.54h-3.19c-4.454 0-7.862 1.716-7.862 7.022 0 4.615 3.133 7.563 8.468 7.563 3.082 0 6.271-1.232 8.414-3.698l3.079 2.466c-2.858 3.432-7.368 4.882-11.604 4.882-7.808 0-13.144-4.826-13.144-11.213 0-5.733 4.181-8.739 8.636-9.062-4.016-.752-7.425-4.13-7.425-8.579-.001-5.042 4.509-9.279 11.602-9.279zm-32.973 0c5.112 0 8.524 1.771 11.548 5.31l-3.189 2.361c-2.421-2.738-4.454-3.917-8.193-3.917-4.236 0-6.766 2.575-6.766 6.706 0 6.06 3.078 10.081 17.377 23.437v3.646h-22.492l-.549-3.807h17.817c-12.483-11.103-16.937-16.629-16.937-23.383 0-5.901 4.232-10.353 11.384-10.353zm-34.681.644 11.218 6.757-1.981 3.164-8.688-5.095v28.426h9.352v3.646h-21.834v-3.646h7.919v-33.252zm-73.593 13.835h4.014l.385 10.516h10.944l-10.119-23.386 3.793-1.609 11.164 25.315v3.219h-15.726v9.009h-4.455v-9.009h-4.896v-3.539h4.896zm-23.625-14.479c3.849 0 7.531 1.287 10.722 4.29l-2.475 2.735c-2.529-2.306-4.784-3.431-8.028-3.431-4.016 0-7.204 2.197-7.204 6.273 0 4.452 3.574 6.491 7.204 6.491h2.255l.55 3.54h-3.19c-4.454 0-7.864 1.716-7.864 7.022 0 4.615 3.135 7.563 8.471 7.563 3.077 0 6.268-1.232 8.413-3.698l3.08 2.466c-2.86 3.432-7.37 4.882-11.604 4.882-7.812 0-13.145-4.826-13.145-11.213 0-5.733 4.18-8.739 8.634-9.062-4.015-.752-7.425-4.13-7.425-8.579 0-5.042 4.51-9.279 11.606-9.279zm-32.977 0c5.116 0 8.525 1.771 11.55 5.31l-3.191 2.361c-2.418-2.738-4.452-3.917-8.192-3.917-4.233 0-6.765 2.575-6.765 6.706 0 6.06 3.08 10.081 17.378 23.437v3.646h-22.492l-.549-3.807h17.817c-12.485-11.103-16.939-16.629-16.939-23.383 0-5.901 4.233-10.353 11.383-10.353zm-34.678.644 11.218 6.757-1.98 3.164-8.688-5.095v28.426h9.349v3.646h-21.833v-3.646h7.921v-33.252zm-73.594 13.835h4.014l.385 10.516h10.944l-10.119-23.386 3.796-1.609 11.162 25.315v3.219h-15.729v9.009h-4.453v-9.009h-4.895v-3.539h4.895zm-23.626-14.479c3.85 0 7.536 1.287 10.725 4.29l-2.476 2.735c-2.53-2.306-4.785-3.431-8.03-3.431-4.014 0-7.204 2.197-7.204 6.273 0 4.452 3.574 6.491 7.204 6.491h2.256l.55 3.54h-3.19c-4.456 0-7.866 1.716-7.866 7.022 0 4.615 3.136 7.563 8.47 7.563 3.08 0 6.269-1.232 8.416-3.698l3.079 2.466c-2.86 3.432-7.368 4.882-11.604 4.882-7.81 0-13.143-4.826-13.143-11.213 0-5.733 4.18-8.739 8.634-9.062-4.015-.752-7.424-4.13-7.424-8.579 0-5.042 4.51-9.279 11.603-9.279zm-32.974 0c5.114 0 8.523 1.771 11.548 5.31l-3.189 2.361c-2.42-2.738-4.456-3.917-8.194-3.917-4.234 0-6.765 2.575-6.765 6.706 0 6.06 3.081 10.081 17.378 23.437v3.646h-22.493l-.549-3.807h17.817c-12.482-11.103-16.938-16.629-16.938-23.383.001-5.901 4.236-10.353 11.385-10.353zm-34.679.644 11.219 6.757-1.979 3.164-8.689-5.095v28.426h9.349v3.646h-21.834v-3.646h7.919v-33.252zm-73.595 13.835h4.015l.385 10.516h10.944l-10.119-23.386 3.793-1.609 11.165 25.315v3.219h-15.729v9.009h-4.455v-9.009h-4.894v-3.539h4.894v-10.516zm-23.625-14.479c3.849 0 7.533 1.287 10.723 4.29l-2.473 2.735c-2.53-2.306-4.785-3.431-8.029-3.431-4.016 0-7.205 2.197-7.205 6.273 0 4.452 3.575 6.491 7.205 6.491h2.254l.55 3.54h-3.189c-4.454 0-7.864 1.716-7.864 7.022 0 4.615 3.134 7.563 8.469 7.563 3.08 0 6.269-1.232 8.414-3.698l3.079 2.466c-2.859 3.432-7.369 4.882-11.602 4.882-7.81 0-13.145-4.826-13.145-11.213 0-5.733 4.18-8.739 8.635-9.062-4.016-.752-7.425-4.13-7.425-8.579-.001-5.042 4.509-9.279 11.603-9.279zm-32.974 0c5.115 0 8.524 1.771 11.548 5.31l-3.19 2.361c-2.419-2.738-4.454-3.917-8.194-3.917-4.234 0-6.765 2.575-6.765 6.706 0 6.06 3.08 10.081 17.379 23.437v3.646h-22.492l-.551-3.807h17.818c-12.483-11.103-16.938-16.629-16.938-23.383.001-5.901 4.235-10.353 11.385-10.353zm-34.68.644 11.219 6.757-1.98 3.164-8.688-5.095v28.426h9.349v3.646h-21.834v-3.646h7.919v-33.252z"/><path d="m698.27 366.58v-2.515c-2.429-.229-4.122-.613-5.081-1.146-.96-.548-1.676-1.829-2.15-3.846h-2.652v25.979h3.588v-18.472zm-21.297 0v-2.515c-2.428-.229-4.12-.613-5.08-1.146-.959-.548-1.675-1.829-2.146-3.846h-2.656v25.979h3.589v-18.472h6.296zm-29.437 18.472c-.126-2.247-.6-4.202-1.422-5.866-.834-1.664-2.453-3.177-4.857-4.536l-3.584-2.021c-1.608-.912-2.736-1.688-3.382-2.333-1.023-1.009-1.533-2.16-1.533-3.463 0-1.517.468-2.719 1.402-3.606.935-.899 2.178-1.349 3.736-1.349 2.303 0 3.896.851 4.781 2.551.474.912.735 2.174.783 3.789h3.421c-.038-2.271-.467-4.124-1.29-5.556-1.457-2.525-4.027-3.789-7.714-3.789-3.065 0-5.301.807-6.708 2.423-1.418 1.616-2.13 3.414-2.13 5.393 0 2.091.754 3.875 2.261 5.355.873.862 2.436 1.907 4.689 3.135l2.561 1.383c1.22.655 2.178 1.282 2.876 1.878 1.245 1.057 2.029 2.23 2.351 3.517h-14.606v3.096h18.365zm-30.038.711c3.163 0 5.459-.845 6.892-2.533 1.42-1.699 2.131-3.764 2.131-6.191h-3.513c-.149 1.686-.474 2.914-.971 3.678-.872 1.372-2.447 2.058-4.728 2.058-1.769 0-3.188-.461-4.257-1.385-1.072-.92-1.606-2.11-1.606-3.569 0-1.798.564-3.055 1.696-3.771 1.123-.717 2.685-1.074 4.691-1.074.223 0 .453.007.69.019.226 0 .455.007.692.019v-2.896c-.351.036-.643.06-.878.072-.237.013-.493.02-.766.02-1.258 0-2.293-.196-3.103-.585-1.421-.681-2.13-1.895-2.13-3.645 0-1.298.475-2.301 1.421-3.005.945-.704 2.048-1.057 3.306-1.057 2.24 0 3.791.727 4.651 2.186.473.803.741 1.945.805 3.427h3.323c0-1.943-.398-3.597-1.194-4.957-1.372-2.429-3.781-3.643-7.229-3.643-2.728 0-4.839.595-6.335 1.785-1.492 1.178-2.241 2.891-2.241 5.138 0 1.604.442 2.903 1.325 3.898.549.619 1.26 1.105 2.132 1.457-1.407.376-2.503 1.105-3.287 2.188-.798 1.067-1.197 2.379-1.197 3.936 0 2.488.842 4.517 2.524 6.084 1.681 1.562 4.066 2.346 7.156 2.346zm-26.694-7.36c-.225 1.87-1.115 3.164-2.67 3.88-.799.364-1.719.546-2.765.546-1.994 0-3.47-.618-4.428-1.857-.962-1.238-1.44-2.612-1.44-4.118 0-1.821.573-3.23 1.72-4.225 1.133-.997 2.497-1.495 4.092-1.495 1.157 0 2.153.218 2.987.655.822.438 1.526 1.045 2.112 1.822l2.914-.164-2.039-14.046h-13.896v3.169h11.376l1.139 7.252c-.622-.462-1.213-.808-1.772-1.039-.998-.4-2.151-.603-3.458-.603-2.452 0-4.533.772-6.238 2.316-1.708 1.54-2.559 3.496-2.559 5.865 0 2.466.782 4.64 2.353 6.522 1.558 1.881 4.047 2.823 7.474 2.823 2.178 0 4.109-.594 5.789-1.786 1.668-1.201 2.603-3.041 2.803-5.519h-3.494zm-26.973-8.508c-1.482 0-2.642-.399-3.477-1.201-.834-.814-1.252-1.78-1.252-2.897 0-.974.401-1.865 1.195-2.678.798-.813 2.014-1.221 3.644-1.221 1.619 0 2.79.407 3.512 1.221.724.812 1.084 1.767 1.084 2.858 0 1.229-.466 2.186-1.4 2.879s-2.037 1.039-3.306 1.039zm-.207 12.917c-1.556 0-2.845-.408-3.867-1.22-1.033-.828-1.551-2.053-1.551-3.68 0-1.691.531-2.971 1.589-3.845 1.06-.876 2.417-1.312 4.073-1.312 1.605 0 2.921.45 3.939 1.348 1.009.888 1.515 2.118 1.515 3.7 0 1.357-.46 2.538-1.382 3.533-.935.982-2.374 1.476-4.316 1.476zm4.781-11.66c.935-.39 1.663-.846 2.187-1.368.985-.971 1.477-2.233 1.477-3.79 0-1.94-.725-3.609-2.169-5.008-1.444-1.396-3.491-2.095-6.144-2.095-2.566 0-4.577.662-6.036 1.987-1.455 1.309-2.184 2.847-2.184 4.607 0 1.627.423 2.945 1.27 3.953.475.57 1.209 1.13 2.206 1.677-1.108.496-1.981 1.068-2.616 1.711-1.186 1.216-1.773 2.794-1.773 4.738 0 2.295.789 4.244 2.369 5.848 1.584 1.591 3.818 2.387 6.709 2.387 2.602 0 4.805-.686 6.612-2.061 1.794-1.382 2.688-3.388 2.688-6.011 0-1.543-.384-2.872-1.156-3.988-.773-1.129-1.92-1.993-3.44-2.587z"/><path d="m519.2 367.54v-2.515c-2.427-.231-4.121-.611-5.078-1.147-.961-.546-1.678-1.829-2.148-3.844h-2.653v25.98h3.587v-18.474zm-27.569 19.185c3.161 0 5.46-.845 6.893-2.531 1.419-1.702 2.13-3.767 2.13-6.196h-3.513c-.149 1.688-.474 2.916-.971 3.679-.872 1.373-2.447 2.06-4.725 2.06-1.771 0-3.189-.461-4.26-1.385-1.074-.922-1.608-2.112-1.608-3.57 0-1.798.567-3.055 1.701-3.771 1.12-.717 2.683-1.075 4.688-1.075.224 0 .454.008.69.019.226 0 .456.007.69.021v-2.899c-.347.037-.64.062-.877.074-.237.015-.49.018-.765.018-1.258 0-2.292-.194-3.104-.583-1.417-.681-2.127-1.896-2.127-3.643 0-1.3.471-2.303 1.42-3.006.945-.705 2.047-1.057 3.303-1.057 2.244 0 3.795.729 4.653 2.186.475.801.74 1.942.804 3.426h3.325c0-1.943-.399-3.597-1.195-4.956-1.371-2.429-3.781-3.644-7.229-3.644-2.728 0-4.838.594-6.332 1.784-1.494 1.179-2.242 2.89-2.242 5.139 0 1.603.441 2.903 1.325 3.9.549.615 1.26 1.102 2.132 1.456-1.408.377-2.504 1.104-3.29 2.185-.796 1.071-1.195 2.383-1.195 3.937 0 2.49.843 4.517 2.523 6.083 1.681 1.568 4.065 2.353 7.152 2.353h.004zm-12.554-.71c-.123-2.25-.599-4.205-1.42-5.868-.833-1.662-2.454-3.177-4.856-4.536l-3.586-2.022c-1.607-.909-2.733-1.688-3.38-2.331-1.023-1.009-1.534-2.161-1.534-3.461 0-1.518.468-2.722 1.402-3.607.933-.899 2.178-1.349 3.734-1.349 2.305 0 3.899.851 4.782 2.551.474.91.735 2.174.784 3.79h3.42c-.037-2.272-.467-4.125-1.288-5.558-1.457-2.527-4.031-3.787-7.717-3.787-3.063 0-5.299.805-6.705 2.422-1.42 1.615-2.13 3.412-2.13 5.392 0 2.088.753 3.876 2.261 5.356.871.863 2.434 1.906 4.689 3.133l2.558 1.385c1.221.656 2.178 1.281 2.878 1.876 1.244 1.058 2.03 2.229 2.354 3.518h-14.61v3.099zm-23.761-18.475v-2.515c-2.429-.231-4.121-.611-5.08-1.147-.96-.546-1.676-1.829-2.148-3.844h-2.651v25.98h3.584v-18.474zm-38.179 19.185c3.161 0 5.458-.845 6.891-2.531 1.42-1.702 2.129-3.767 2.129-6.196h-3.512c-.147 1.688-.472 2.916-.971 3.679-.87 1.373-2.446 2.06-4.727 2.06-1.768 0-3.188-.461-4.258-1.385-1.072-.922-1.608-2.112-1.608-3.57 0-1.798.568-3.055 1.701-3.771 1.12-.717 2.683-1.075 4.688-1.075.225 0 .453.008.692.019.224 0 .455.007.691.021v-2.899c-.348.037-.643.062-.879.074-.238.015-.492.018-.768.018-1.256 0-2.29-.194-3.098-.583-1.42-.681-2.132-1.896-2.132-3.643 0-1.3.474-2.303 1.421-3.006.945-.705 2.046-1.057 3.307-1.057 2.241 0 3.791.729 4.65 2.186.473.801.74 1.942.804 3.426h3.324c0-1.943-.397-3.597-1.196-4.956-1.369-2.429-3.777-3.644-7.227-3.644-2.728 0-4.839.594-6.334 1.784-1.493 1.179-2.241 2.89-2.241 5.139 0 1.603.442 2.903 1.325 3.9.55.615 1.257 1.102 2.131 1.456-1.408.377-2.503 1.104-3.287 2.185-.797 1.071-1.196 2.383-1.196 3.937 0 2.49.842 4.517 2.521 6.083 1.684 1.564 4.068 2.349 7.159 2.349zm-24.007-9.948v-11.823l8.575 11.823zm-.056 9.238v-6.377h11.731v-3.207l-12.253-16.578h-2.839v16.925h-3.943v2.859h3.943v6.378zm-13.317-6.651c-.225 1.869-1.115 3.162-2.672 3.879-.798.366-1.718.548-2.764.548-1.994 0-3.469-.62-4.429-1.858-.958-1.238-1.438-2.611-1.438-4.116 0-1.823.574-3.233 1.718-4.228 1.134-.996 2.499-1.494 4.091-1.494 1.16 0 2.153.217 2.99.656.821.437 1.524 1.044 2.111 1.822l2.914-.164-2.038-14.047h-13.897v3.17h11.378l1.138 7.252c-.624-.463-1.214-.81-1.774-1.04-.996-.4-2.148-.602-3.457-.602-2.453 0-4.532.771-6.237 2.314-1.707 1.542-2.561 3.497-2.561 5.866 0 2.467.784 4.639 2.354 6.521 1.556 1.884 4.047 2.825 7.472 2.825 2.178 0 4.111-.595 5.791-1.785 1.668-1.202 2.603-3.043 2.804-5.521h-3.494zm-21.296 0c-.225 1.869-1.114 3.162-2.672 3.879-.797.366-1.718.548-2.764.548-1.993 0-3.468-.62-4.428-1.858-.959-1.238-1.437-2.611-1.437-4.116 0-1.823.572-3.233 1.718-4.228 1.133-.996 2.497-1.494 4.091-1.494 1.156 0 2.154.217 2.988.656.821.437 1.527 1.044 2.111 1.822l2.914-.164-2.037-14.047h-13.897v3.17h11.375l1.139 7.252c-.622-.463-1.214-.81-1.776-1.04-.995-.4-2.146-.602-3.454-.602-2.454 0-4.533.771-6.239 2.314-1.707 1.542-2.559 3.497-2.559 5.866 0 2.467.784 4.639 2.353 6.521 1.557 1.884 4.047 2.825 7.472 2.825 2.181 0 4.111-.595 5.792-1.785 1.667-1.202 2.602-3.043 2.802-5.521h-3.495.003z"/></g><path d="m7.5 144.64h732v-95.142h-732z" fill="#393939" stroke="#393939"/><path d="m41.669 166.1h537.5v74.62h-537.5z" fill-opacity=".196"/><path d="m496.92 187.18-9.754 5.877 1.721 2.751 7.555-4.43v24.718h-8.128v3.172h18.983v-3.172h-6.885v-28.916zm27.191-.559c-4.446 0-7.412 1.54-10.044 4.617l2.775 2.052c2.104-2.378 3.874-3.405 7.125-3.405 3.683 0 5.882 2.238 5.882 5.83 0 5.27-2.679 8.769-15.109 20.381v3.172h19.557l.479-3.312h-15.494c10.855-9.653 14.729-14.458 14.729-20.333 0-5.131-3.683-9.002-9.9-9.002zm28.673 0c-3.348 0-6.551 1.12-9.324 3.731l2.151 2.377c2.2-2.005 4.161-2.984 6.981-2.984 3.491 0 6.265 1.911 6.265 5.456 0 3.871-3.107 5.644-6.265 5.644h-1.96l-.479 3.078h2.773c3.874 0 6.84 1.493 6.84 6.109 0 4.011-2.727 6.577-7.365 6.577-2.676 0-5.451-1.073-7.316-3.218l-2.679 2.145c2.488 2.985 6.41 4.244 10.092 4.244 6.791 0 11.428-4.198 11.428-9.748 0-4.989-3.634-7.601-7.507-7.881 3.491-.652 6.456-3.591 6.456-7.462 0-4.384-3.921-8.068-10.091-8.068z" stroke="#393939"/></g>
                        </svg>

                        <div class="text-left">
                            <p class="font-semibold">Mobile Money/Credit/Debit Card</p>
                            <p class="text-xs"
                               :class="{'text-gray-100': activeTab === 'paystack', 'text-gray-500': activeTab !== 'paystack'}">
                                Bank Transfer</p>
                        </div>
                    </button>

{{--                    <button--}}
{{--                        @click="activeTab = 'paypal'; scrollToForm()"--}}
{{--                        :class="{'bg-blue-600 text-white': activeTab === 'paypal', 'bg-white hover:bg-gray-50': activeTab !== 'paypal'}"--}}
{{--                        class="flex items-center space-x-3 w-full p-4 rounded-lg transition-all duration-200 shadow">--}}
{{--                        <svg fill="#000000" width="24" height="24" viewBox="0 0 512 512" id="Layer_1"--}}
{{--                             data-name="Layer 1"--}}
{{--                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>--}}
{{--                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>--}}
{{--                            <g id="SVGRepo_iconCarrier">--}}
{{--                                <path--}}
{{--                                    d="M424.81,148.79c-.43,2.76-.93,5.58-1.49,8.48-19.17,98-84.76,131.8-168.54,131.8H212.13a20.67,20.67,0,0,0-20.47,17.46L169.82,444.37l-6.18,39.07a10.86,10.86,0,0,0,9.07,12.42,10.72,10.72,0,0,0,1.7.13h75.65a18.18,18.18,0,0,0,18-15.27l.74-3.83,14.24-90,.91-4.94a18.16,18.16,0,0,1,18-15.3h11.31c73.3,0,130.67-29.62,147.44-115.32,7-35.8,3.38-65.69-15.16-86.72A72.27,72.27,0,0,0,424.81,148.79Z"></path>--}}
{{--                                <path--}}
{{--                                    d="M385.52,51.09C363.84,26.52,324.71,16,274.63,16H129.25a20.75,20.75,0,0,0-20.54,17.48l-60.55,382a12.43,12.43,0,0,0,10.39,14.22,12.58,12.58,0,0,0,1.94.15h89.76l22.54-142.29-.7,4.46a20.67,20.67,0,0,1,20.47-17.46h42.65c83.77,0,149.36-33.86,168.54-131.8.57-2.9,1.05-5.72,1.49-8.48h0C410.94,98.06,405.19,73.41,385.52,51.09Z"></path>--}}
{{--                            </g>--}}
{{--                        </svg>--}}
{{--                        <div class="text-left">--}}
{{--                            <p class="font-semibold">PayPal</p>--}}
{{--                            <p class="text-xs"--}}
{{--                               :class="{'text-gray-100': activeTab === 'paypal', 'text-gray-500': activeTab !== 'paypal'}">--}}
{{--                                Credit/Debit Card</p>--}}
{{--                        </div>--}}
{{--                    </button>--}}

                    <button
                        @click="activeTab = 'bitcoin';"
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
{{--                    <!-- M-Pesa Form -->--}}
{{--                    <div id="mpesa-form" x-show="activeTab === 'mpesa'" x-transition>--}}
{{--                        <div class="flex justify-center items-center">--}}
{{--                            <img src="{{asset('images/mpesa.png')}}" alt="MPESA">--}}
{{--                        </div>--}}
{{--                        <form method="POST" action="{{ route('mpesa.donate') }}"--}}
{{--                              class="space-y-6 bg-gray-100 p-4 rounded-lg">--}}
{{--                            @csrf--}}
{{--                            <div--}}
{{--                                x-data="{--}}
{{--                                            phoneNumber: '{{ old('phone') ?? '' }}',--}}
{{--                                            selectedCountry: {code: '+254', name: 'Kenya', flag: '🇰🇪'},--}}
{{--                                            countries: [--}}
{{--                                                {code: '+254', name: 'Kenya', flag: '🇰🇪'},--}}
{{--                                            ],--}}
{{--                                            isOpen: false,--}}
{{--                                            fullNumber: '',--}}
{{--                                            init() {--}}
{{--                                                this.updateFullNumber();--}}
{{--                                            },--}}
{{--                                            selectCountry(country) {--}}
{{--                                                this.selectedCountry = country;--}}
{{--                                                this.isOpen = false;--}}
{{--                                                this.updateFullNumber();--}}
{{--                                            },--}}
{{--                                            updateFullNumber() {--}}
{{--                                                this.fullNumber = this.selectedCountry.code + ' ' + (this.phoneNumber || '');--}}
{{--                                            }--}}
{{--                                        }"--}}
{{--                                x-init="init()"--}}
{{--                                x-cloak--}}
{{--                            >--}}
{{--                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>--}}

{{--                                <div class="flex items-center">--}}
{{--                                    <div class="relative">--}}
{{--                                        <div--}}
{{--                                            @click="isOpen = !isOpen"--}}
{{--                                            class="flex items-center border rounded p-2 cursor-pointer"--}}
{{--                                        >--}}
{{--                                            <span class="mr-2" x-text="selectedCountry.flag"></span>--}}
{{--                                            <span x-text="selectedCountry.code"></span>--}}
{{--                                        </div>--}}

{{--                                        <div--}}
{{--                                            x-show="isOpen"--}}
{{--                                            @click.outside="isOpen = false"--}}
{{--                                            class="absolute z-10 w-48 border rounded mt-1 bg-white shadow-lg max-h-60 overflow-y-auto"--}}
{{--                                        >--}}
{{--                                            <template x-for="country in countries" :key="country.code">--}}
{{--                                                <div--}}
{{--                                                    @click="selectCountry(country)"--}}
{{--                                                    class="flex items-center p-2 hover:bg-gray-100 cursor-pointer"--}}
{{--                                                >--}}
{{--                                                    <span class="mr-2" x-text="country.flag"></span>--}}
{{--                                                    <span x-text="country.name"></span>--}}
{{--                                                    <span class="ml-auto text-gray-500" x-text="country.code"></span>--}}
{{--                                                </div>--}}
{{--                                            </template>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <input--}}
{{--                                        type="tel"--}}
{{--                                        x-model="phoneNumber"--}}
{{--                                        @input="updateFullNumber()"--}}
{{--                                        name="phone"--}}
{{--                                        id="phone"--}}
{{--                                        placeholder="(e.g. '712345678' or '112345678')"--}}
{{--                                        class="border rounded p-2 w-full ml-2--}}
{{--                                            }}--}}
{{--                                                $errors->mpesaValidation->has('phone')--}}
{{--                                                ? 'border-red-500 text-red-900 focus:ring placeholder-red-300 focus:border-red-500 focus:ring-red-300'--}}
{{--                                                : 'border-gray-300 focus:ring focus:ring-green-300 focus:border-green-500'--}}
{{--                                            }}"--}}
{{--                                        autocomplete="tel"--}}
{{--                                        required--}}
{{--                                    >--}}
{{--                                </div>--}}

{{--                                <!-- Optional: Display selected phone number -->--}}
{{--                                <div class="mt-2 text-sm text-gray-600">--}}
{{--                                    Full Number: <span x-text="fullNumber"></span>--}}
{{--                                </div>--}}

{{--                                @error('phone','mpesaValidation')--}}
{{--                                <p class="text-red-600 text-xs mt-2">{{$message}}</p>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

{{--                            <div x-data="{--}}
{{--                                            amount: '{{old('amount') ?? ''}}',--}}
{{--                                            predefinedAmounts: [100, 500, 1000, 2000, 5000, 10000],--}}
{{--                                            selectAmount(value) {--}}
{{--                                                this.amount = value;--}}
{{--                                            }--}}
{{--                                         }">--}}

{{--                                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount--}}
{{--                                    (KES)</label>--}}

{{--                                <div class="mb-2 grid grid-cols-2 sm:grid-cols-3 gap-2 overflow-x-auto space-x-2">--}}
{{--                                    <template x-for="preset in predefinedAmounts" :key="preset">--}}
{{--                                        <button--}}
{{--                                            type="button"--}}
{{--                                            @click="selectAmount(preset)"--}}
{{--                                            class="px-3 py-1 bg-green-100 text-green-700 rounded-md hover:bg-green-200 transition-colors whitespace-nowrap"--}}
{{--                                            x-text="preset.toLocaleString() + ' KES'"--}}
{{--                                        ></button>--}}
{{--                                    </template>--}}
{{--                                </div>--}}

{{--                                <div class="relative">--}}
{{--                                    <span--}}
{{--                                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">KES</span>--}}
{{--                                    <input--}}
{{--                                        type="number"--}}
{{--                                        min="1"--}}
{{--                                        name="amount"--}}
{{--                                        id="amount"--}}
{{--                                        x-model="amount"--}}
{{--                                        class="w-full p-3 pl-12 border border-gray-300 rounded-lg focus:ring focus:ring-green-300 focus:border-green-500"--}}
{{--                                        required--}}
{{--                                    >--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <button--}}
{{--                                type="submit"--}}
{{--                                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200"--}}
{{--                            >--}}
{{--                                Donate via M-Pesa--}}
{{--                            </button>--}}
{{--                        </form>--}}

{{--                        <p class="text-xs text-gray-600 text-center mt-4">--}}
{{--                            You will receive an STK push notification on your phone to complete the payment--}}
{{--                        </p>--}}
{{--                    </div>--}}


{{--                    <!-- PayPal Form -->--}}
{{--                    <div id="paypal-form" x-show="activeTab === 'paypal'" x-transition>--}}
{{--                        <div class="flex justify-center items-center mb-4">--}}
{{--                            <img src="{{asset('images/paypal.png')}}" alt="PAYPAL" class="w-24">--}}
{{--                        </div>--}}
{{--                        <div class="space-y-6">--}}
{{--                            <div id="donate-button-container"--}}
{{--                                 class="flex justify-center items-center h-40 bg-gray-100 hover:bg-gray-200">--}}
{{--                                <div id="donate-button" class="p-4 border rounded border-gray-300 cursor-pointer"></div>--}}
{{--                                <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js"--}}
{{--                                        charset="UTF-8"></script>--}}
{{--                                <script>--}}
{{--                                    PayPal.Donation.Button({--}}
{{--                                        env: 'sandbox',--}}
{{--                                        hosted_button_id: 'YD2FH9CE4HBHC',--}}
{{--                                        image: {--}}
{{--                                            src: 'https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif',--}}
{{--                                            alt: 'Donate with PayPal button',--}}
{{--                                            title: 'PayPal - The safer, easier way to pay online!',--}}
{{--                                        },--}}
{{--                                        onComplete: function (params) {--}}
{{--                                            console.log("DonationComplete:" ,params);--}}
{{--                                            fetch('/paypal-complete',{--}}
{{--                                                method: 'post',--}}
{{--                                                headers: {--}}
{{--                                                    'Content-Type' : 'application/json',--}}
{{--                                                    'X-CSRF-TOKEN' : '{{csrf_token()}}',--}}
{{--                                                },--}}
{{--                                                body: JSON.stringify(params)--}}
{{--                                            });--}}
{{--                                        }--}}
{{--                                    }).render('#donate-button');--}}
{{--                                </script>--}}
{{--                            </div>--}}


{{--                            <p class="text-sm text-gray-600 text-center mt-6">--}}
{{--                                You will be redirected to PayPal to complete your donation securely.--}}
{{--                                You can use your PayPal account or credit/debit card.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div id="paystack-form" x-show="activeTab === 'paystack'" x-transition>
                        <div class="flex justify-center items-center mb-4">
                            <img src="https://cdn.brandfetch.io/idM5mrwtDs/theme/dark/logo.svg?c=1dxbfHSJFAPEGdCLU4o5B" alt="PAYSTACK" class="w-24">
                        </div>

                        <form action="{{ route('paystack.donate') }}" method="POST" class="space-y-4">
                            @csrf

                            <!-- Amount Section -->
                            <div x-data="{
                                            amount: '{{old('amount') ?? ''}}',
                                            predefinedAmounts: [100, 500, 1000, 2000, 5000, 10000],
                                            selectAmount(value) {
                                                this.amount = value;
                                            }
                                         }">

                                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Donation Amount
                                    (KES)</label>

                                <div class="mb-2 p-2 grid grid-cols-2 sm:grid-cols-3 gap-2 overflow-x-auto space-x-2">
                                    <template x-for="preset in predefinedAmounts" :key="preset">
                                        <button
                                            type="button"
                                            @click="selectAmount(preset)"
                                            class="px-3 py-1 text-gray-700 rounded-md border border-b hover:bg-gray-200 transition-colors whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-blue-500"
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
                                        class="w-full p-3 pl-12 border rounded-lg focus:outline-none focus:ring-2
                                        {{
                                                $errors->paystackValidation->has('amount')
                                                ? 'border-red-500 text-red-900 focus:ring placeholder-red-300 focus:border-red-500 focus:ring-red-300'
                                                : 'border-gray-300 focus:ring-2 focus:border-blue-500'
                                        }}
                                        "
                                        required
                                    >
                                </div>
                                @error('amount','paystackValidation')
                                <p class="text-red-600 text-xs mt-2">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Email (Required) -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{old('email')}}"
                                       required
                                       placeholder="your@email.com"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            @error('email','paystackValidation')
                            <p class="text-red-600 text-xs mt-2">{{$message}}</p>
                            @enderror


                            <!-- Optional Fields -->
                            <div>
                                <label for="donor_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name (Optional)</label>
                                <input type="text"
                                       id="donor_name"
                                       name="donor_name"
                                       value="{{old('donor_name')}}"
                                       placeholder="Your full name"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            @error('donor_name','paystackValidation')
                            <p class="text-red-600 text-xs mt-2">{{$message}}</p>
                            @enderror

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number (Optional)</label>
                                <input type="tel"
                                       id="phone"
                                       name="phone"
                                       value="{{old('phone')}}"
                                       placeholder="+254xxxxxxxxxx"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            @error('phone','paystackValidation')
                            <p class="text-red-600 text-xs mt-2">{{$message}}</p>
                            @enderror

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message (Optional)</label>
                                <textarea id="message"
                                          name="message"
                                          rows="3"
                                          placeholder="Leave a message..."
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    {{old('message')}}
                                </textarea>
                            </div>
                            @error('message','paystackValidation')
                            <p class="text-red-600 text-xs mt-2">{{$message}}</p>
                            @enderror

                            <!-- Donate Button -->
                            <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Donate with Paystack
                            </button>
                        </form>

                        <p class="text-sm text-gray-600 text-center mt-6">
                            You will be redirected to Paystack to complete your donation securely.
                            You can pay with your card, bank transfer, or mobile money.
                        </p>

                        <script>
                            function setAmount(amount) {
                                document.getElementById('amount').value = amount;
                            }
                        </script>
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
                            <iframe src="https://sandbox.nowpayments.io/embeds/donation-widget?api_key=V9YT99N-E98M7EQ-JWHG8DJ-EH8WA89&source=lk_donation&medium=referral" frameborder="0" scrolling="no" style="overflow-y: hidden;" width="354" height="680">
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
