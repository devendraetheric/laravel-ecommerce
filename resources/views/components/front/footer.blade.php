<!-- footer area start -->
<footer class="bg-white">
    <div class="xl:py-20 py-6 sm:py-8 md:py-12 border-t border-gray-200">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                <div class="lg:col-span-2 col-span-1">
                    <div class="lg:mb-6 mb-4">
                        <a href="{{ route('home') }}" class="inline-block">
                            <img src="{{ getLogoURL() }}" alt="{{ setting('general.app_name') }}" class="h-20"
                                loading="lazy" />
                        </a>
                    </div>
                    <p class="lg:mb-6 mb-4 text-gray-600 text-base/relaxed">Trusted OTC products delivered nationwide
                        with care
                        and convenience. <br>Your one-stop online store for all over-the-counter health essentials.</p>
                    <div class="flex gap-x-6">
                        @if (setting('social.facebook'))
                            <a href="{{ setting('social.facebook') }}" class="text-gray-600 hover:text-gray-800">
                                <span class="sr-only">Facebook</span>
                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                        @if (setting('social.instagram'))
                            <a href="{{ setting('social.instagram') }}" class="text-gray-600 hover:text-gray-800">
                                <span class="sr-only">Instagram</span>
                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                        @if (setting('social.twitter'))
                            <a href="{{ setting('social.twitter') }}" class="text-gray-600 hover:text-gray-800">
                                <span class="sr-only">X</span>
                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M13.6823 10.6218L20.2391 3H18.6854L12.9921 9.61788L8.44486 3H3.2002L10.0765 13.0074L3.2002 21H4.75404L10.7663 14.0113L15.5685 21H20.8131L13.6819 10.6218H13.6823ZM11.5541 13.0956L10.8574 12.0991L5.31391 4.16971H7.70053L12.1742 10.5689L12.8709 11.5655L18.6861 19.8835H16.2995L11.5541 13.096V13.0956Z" />
                                </svg>
                            </a>
                        @endif
                        @if (setting('social.youtube'))
                            <a href="{{ setting('social.youtube') }}" class="text-gray-600 hover:text-gray-800">
                                <span class="sr-only">YouTube</span>
                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-2 col-span-1 grid grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-gray-700 text-2xl font-semibold mb-6">
                            Powerhouse <br>Pharmacy</h4>
                        <dl class="flex flex-wrap space-y-4">
                            <div class="flex w-full flex-none gap-x-4 items-center">
                                <dt class="flex-none">
                                    <span class="sr-only">Address</span>
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-6 text-primary-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </dt>
                                <dd class="text-gray-600 text-base/relaxed">4740 W Mockingbird Ln #100B, Dallas, <br>TX
                                    75209,
                                    <br>United States
                                </dd>
                            </div>

                            <div class="flex w-full flex-none gap-x-4 items-center">
                                <dt class="flex-none">
                                    <span class="sr-only">Phone</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 text-primary-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 3.75v4.5m0-4.5h-4.5m4.5 0-6 6m3 12c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
                                    </svg>
                                </dt>
                                <dd>
                                    <a href="tel:+12143502900" class="text-primary-600 hover:text-primary-700">+1
                                        214-350-2900</a>
                                </dd>
                            </div>
                        </dl>
                    </div>
                    <div>
                        <h4 class="text-gray-700 text-2xl font-semibold mb-6">
                            Texas Health Rx Pharmacy</h4>
                        <dl class="flex flex-wrap space-y-4">
                            <div class="flex w-full flex-none gap-x-4 items-center">
                                <dt class="flex-none">
                                    <span class="sr-only">Address</span>
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-6 text-primary-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </dt>
                                <dd class="text-gray-600 text-base/relaxed">12333 Bear Plaza Ste. #100, Burleson,
                                    <br>TX
                                    76028, <br>United States
                                </dd>
                            </div>

                            <div class="flex w-full flex-none gap-x-4 items-center">
                                <dt class="flex-none">
                                    <span class="sr-only">Phone</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 text-primary-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 3.75v4.5m0-4.5h-4.5m4.5 0-6 6m3 12c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
                                    </svg>
                                </dt>
                                <dd>
                                    <a href="tel:+18177894099" class="text-primary-600 hover:text-primary-700">
                                        +1 817-789-4099</a>
                                </dd>
                            </div>
                        </dl>
                    </div>

                </div>

                <!-- footer newsletter -->
                <div class="col-span-1">
                    <h4 class="text-gray-700 text-2xl font-semibold mb-6">
                        Newsletter</h4>
                    <form action="" method="POST" class="space-y-4">
                        <input type="text" name="email" class="form-control" placeholder="Your email">
                        <button type="submit" class="btn-primary">Subscribe</button>
                    </form>
                </div>
                <!-- footer newsletter end -->
            </div>
        </div>
    </div>
    <div class="footer-bottom border-t border-gray-100 py-6">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex flex-wrap sm:justify-between sm:flex-nowrap justify-center items-center gap-y-6">
                <p class="text-center text-gray-500">
                    &copy; {{ date('Y') }} - {{ setting('general.app_name') }} - Designed & Developed by
                    <a href="https://ethericsolution.com/" target="_blank">
                        <b>Etheric Solution</b></a>
                </p>
                <div class="inline-flex justify-center h-6">
                    <img src="{{ asset('assets/images/payments.png') }}" alt="Payment Method" loading="lazy" />
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->
