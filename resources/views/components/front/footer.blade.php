<!-- footer area start -->
<footer>
    <div class="footer-top xl:pt-20 xl:pb-[60px] py-6 sm:py-8 md:py-12 shadow-[inset_0px_1px_0px_#E1E3E6]">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class=" flex flex-wrap gap-y-6 justify-between">
                <div class="footer-widget max-w-[350px]">
                    <div class="lg:mb-6 mb-4">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('otc-logo.png') }}" alt="{{ config('app.name') }}" class="h-12" />
                        </a>
                    </div>
                    <p class="lg:mb-6 mb-4 text-gray-black text-base">Vivamus tristique odio sit amet velit
                        semper, eu posuere turpis interdum. Cras egestas purus </p>

                </div>

                <div class="footer-widget">
                    <h2 class="text-gray-500 text-sm leading-tight font-display font-medium uppercase mb-5">
                        Category</h2>
                    <ul class="flex flex-col gap-3">
                        <li>
                            <a href="#"
                                class="text-gray-black text-base leading-tight hover:text-primary-600 transition-all duration-500 inline-block pb-1 ease-in-out">Sofa</a>
                        </li>
                        <li>
                            <a href="#"
                                class="text-gray-black text-base leading-tight hover:text-primary-600 transition-all duration-500 inline-block pb-1">Armchair</a>
                        </li>
                        <li>
                            <a href="#"
                                class="text-gray-black text-base leading-tight hover:text-primary-600 transition-all duration-500 inline-block pb-1">Wing
                                Chair</a>
                        </li>
                        <li>
                            <a href="#"
                                class="text-gray-black text-base leading-tight hover:text-primary-600 transition-all duration-500 inline-block pb-1">Desk
                                Chair</a>
                        </li>
                        <li>
                            <a href="#"
                                class="text-gray-black text-base leading-tight hover:text-primary-600 transition-all duration-500 inline-block pb-1">wooden
                                Chair</a>
                        </li>
                        <li>
                            <a href="#"
                                class="text-gray-black text-base leading-tight hover:text-primary-600 transition-all duration-500 inline-block pb-1">Park
                                Bench</a>
                        </li>
                    </ul>
                </div>

                <div class="footer-widget">
                    <h2 class="text-gray-500 text-sm leading-tight font-display font-medium uppercase mb-5">
                        Support</h2>
                    <ul class="flex flex-col gap-3">
                        <li>
                            <a href="#"
                                class="text-gray-black text-base leading-tight hover:text-primary-600 transition-all duration-500 inline-block pb-1">Help
                                & Support</a>
                        </li>
                        <li>
                            <a href="#"
                                class="text-gray-black text-base leading-tight hover:text-primary-600 transition-all duration-500 inline-block pb-1">Tearms
                                & Conditions</a>
                        </li>
                        <li>
                            <a href="#"
                                class="text-gray-black text-base leading-tight hover:text-primary-600 transition-all duration-500  inline-block pb-1">Privacy
                                Policy</a>
                        </li>
                        <li>
                            <a href="#"
                                class="text-gray-black text-base leading-tight hover:text-primary-600 transition-all duration-500 inline-block pb-1">Help</a>
                        </li>
                    </ul>
                </div>

                <!-- footer newsletter -->
                <div class="footer-widget w-[424px]">
                    <h2 class="text-gray-500 text-sm leading-tight font-display font-medium uppercase mb-5">
                        Newsletter</h2>
                    <form action="" class="flex flex-wrap xl:flex-nowrap gap-3">
                        <input type="text" name="" id=""
                            class="bg-white block max-w-64 w-full px-5 py-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-600 transition duration-300 ease-in-out border border-gray-200"
                            placeholder="Your email">
                        <button type="submit" class="btn-primary">Subscribe</button>
                    </form>
                    <p class="py-3 text-gray-black opacity-60">Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Nullam tincidunt erat enim.</p>
                </div>
                <!-- footer newsletter end -->
            </div>
        </div>
    </div>
    <div class="footer-bottom border-t border-gray-100 py-6">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex flex-wrap sm:justify-between sm:flex-nowrap justify-center items-center gap-y-6">
                <p class="text-center text-gray-500">@ {{ date('Y') }} - {{ config('app.name') }} - Designed &
                    Develop by
                    <a href="https://ethericsolution.com/" target="_blank">
                        <b>Etheric Solution</b></a>
                </p>
                <div class="inline-flex justify-center h-6">
                    <img src="{{ asset('assets/images/all-img/payments.png') }}" alt="Payment Method" />
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->
