<!-- footer area start -->
<footer class="bg-gradient-to-br from-accent-900 via-accent-800 to-accent-900 text-white relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-8">
        <div class="absolute top-20 left-20 w-40 h-40 border border-white/20 rounded-full"></div>
        <div class="absolute bottom-32 right-32 w-32 h-32 border border-white/20 rounded-full"></div>
        <div class="absolute top-1/2 left-1/3 w-24 h-24 border border-white/20 rounded-full"></div>
    </div>

    <div class="py-16 md:py-20 relative z-10">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-10">
                <div class="lg:col-span-4 col-span-1">
                    <div class="mb-6">
                        <a href="{{ route('home') }}" class="inline-block">
                            <img src="{{ getLogoURL() }}" alt="{{ setting('general.app_name') }}"
                                class="h-14 brightness-0 invert" loading="lazy" />
                        </a>
                    </div>
                    <p class="mb-6 text-accent-300 text-base leading-relaxed">Trusted OTC products delivered nationwide
                        with care
                        and convenience. <br>Your one-stop online store for all over-the-counter health essentials.</p>
                    <div class="flex gap-3">
                        @if (setting('social.facebook'))
                            <a href="{{ setting('social.facebook') }}" target="_blank"
                                class="p-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full text-white hover:bg-primary-600 hover:border-primary-600 transition-all duration-300 hover:scale-110">
                                <span class="sr-only">Facebook</span>
                                <i data-lucide="facebook" class="size-5"></i>
                            </a>
                        @endif
                        @if (setting('social.instagram'))
                            <a href="{{ setting('social.instagram') }}" target="_blank"
                                class="p-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full text-white hover:bg-primary-600 hover:border-primary-600 transition-all duration-300 hover:scale-110">
                                <span class="sr-only">Instagram</span>
                                <i data-lucide="instagram" class="size-5"></i>
                            </a>
                        @endif
                        @if (setting('social.twitter'))
                            <a href="{{ setting('social.twitter') }}" target="_blank"
                                class="p-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full text-white hover:bg-primary-600 hover:border-primary-600 transition-all duration-300 hover:scale-110">
                                <span class="sr-only">X</span>
                                <i data-lucide="twitter" class="size-5"></i>
                            </a>
                        @endif
                        @if (setting('social.youtube'))
                            <a href="{{ setting('social.youtube') }}" target="_blank"
                                class="p-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full text-white hover:bg-primary-600 hover:border-primary-600 transition-all duration-300 hover:scale-110">
                                <span class="sr-only">YouTube</span>
                                <i data-lucide="youtube" class="size-5"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-5 col-span-1 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <div>
                        <h4 class="text-white text-xl font-bold mb-6 flex items-center gap-2">
                            Powerhouse <br>Pharmacy
                        </h4>
                        <div class="space-y-5">
                            <div class="flex gap-4 items-start">
                                <div class="p-2 bg-primary-600/30 rounded-lg flex-shrink-0 shadow-inner">
                                    <i data-lucide="map-pin" class="size-5 text-primary-300"></i>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-white mb-1">Address</h5>
                                    <p class="text-accent-300 text-sm leading-relaxed">
                                        4740 W Mockingbird Ln #100B, Dallas, <br>TX
                                        75209,
                                        United States
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-4 items-start">
                                <div class="p-2 bg-primary-600/30 rounded-lg flex-shrink-0 shadow-inner">
                                    <i data-lucide="phone" class="size-5 text-primary-300"></i>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-white mb-1">Phone</h5>
                                    <div class="space-y-1">
                                        <a href="tel:+1214-350-2900"
                                            class="block text-accent-300 hover:text-primary-400 transition-colors duration-300">+1
                                            214-350-2900</a>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div>
                        <h4 class="text-white text-xl font-bold mb-6 flex items-center gap-2">
                            Texas Health Rx Pharmacy
                        </h4>
                        <div class="space-y-5">
                            <div class="flex gap-4 items-start">
                                <div class="p-2 bg-primary-600/30 rounded-lg flex-shrink-0 shadow-inner">
                                    <i data-lucide="map-pin" class="size-5 text-primary-300"></i>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-white mb-1">Address</h5>
                                    <p class="text-accent-300 text-sm leading-relaxed">
                                        12333 Bear Plaza Ste.<br> #100, Burleson, <br>TX
                                        76028,
                                        United States
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-4 items-start">
                                <div class="p-2 bg-primary-600/30 rounded-lg flex-shrink-0 shadow-inner">
                                    <i data-lucide="phone" class="size-5 text-primary-300"></i>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-white mb-1">Phone</h5>
                                    <div class="space-y-1">
                                        <a href="tel:+18177894099"
                                            class="block text-accent-300 hover:text-primary-400 transition-colors duration-300">+1
                                            817-789-4099</a>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- footer newsletter -->
                <div class="lg:col-span-3 col-span-1">
                    <h4 class="text-white text-xl font-bold mb-6 flex items-center gap-2">
                        <i data-lucide="mail" class="size-5 text-primary-400"></i>
                        Newsletter
                    </h4>
                    <p class="text-accent-300 mb-6 text-sm leading-relaxed">
                        Subscribe to get updates on new products and exclusive offers.
                    </p>
                    <form action="{{ route('subscribers.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="relative">
                            <input type="email" name="email" id="email"
                                class="w-full px-4 py-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder:text-accent-400 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/20 focus:bg-white/20 transition-all duration-300"
                                placeholder="Enter your email" required>
                        </div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                            <span>Subscribe</span>
                            <i data-lucide="send" class="size-4"></i>
                        </button>
                    </form>
                </div>
                <!-- footer newsletter end -->
            </div>
        </div>
    </div>
    <div class="border-t border-white/20 py-6 relative z-10">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-accent-400 text-center md:text-left">
                    &copy; {{ date('Y') }} {{ setting('general.app_name') }}. All rights reserved.
                    <span class="block md:inline mt-1 md:mt-0">
                        Developed by
                        <a href="https://ethericsolution.com/" target="_blank"
                            class="text-primary-400 hover:text-primary-300 transition-colors duration-300 font-semibold">
                            Etheric Solution
                        </a>
                    </span>
                </p>
                <div class="flex items-center gap-4">
                    <span class="text-accent-400 text-sm">We Accept:</span>
                    <div class="bg-white/15 backdrop-blur-sm rounded-lg p-2 border border-white/10">
                        <img src="{{ asset('assets/images/payments.png') }}" alt="Payment Methods"
                            class="h-6 opacity-80" loading="lazy" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->
