<!DOCTYPE html>
<html>

<head>
    <title>Laravel 11 Generate PDF Example - ItSolutionStuff.com</title>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>

    <header class="absolute inset-x-0 top-0 z-50 flex h-16 border-b border-gray-900/10">

        <!-- Mobile menu, show/hide based on menu open state. -->

    </header>

    <main>


        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div
                class="mx-auto grid max-w-2xl grid-cols-1 grid-rows-1 items-start gap-x-8 gap-y-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                <!-- Invoice -->
                <div
                    class="-mx-4 px-4 py-8 shadow-xs ring-1 ring-gray-900/5 sm:mx-0 sm:rounded-lg sm:px-8 sm:pb-14 lg:col-span-2 lg:row-span-2 lg:row-end-2 xl:px-16 xl:pt-16 xl:pb-20">
                    <h2 class="text-base font-semibold text-gray-900">Invoice</h2>
                    <dl class="mt-6 grid grid-cols-1 text-sm/6 sm:grid-cols-2">
                        <div class="sm:pr-4">
                            <dt class="inline text-gray-500">Issued on</dt>
                            <dd class="inline text-gray-700"><time datetime="2023-23-01">January 23, 2023</time></dd>
                        </div>
                        <div class="mt-2 sm:mt-0 sm:pl-4">
                            <dt class="inline text-gray-500">Due on</dt>
                            <dd class="inline text-gray-700"><time datetime="2023-31-01">January 31, 2023</time></dd>
                        </div>
                        <div class="mt-6 border-t border-gray-900/5 pt-6 sm:pr-4">
                            <dt class="font-semibold text-gray-900">From</dt>
                            <dd class="mt-2 text-gray-500"><span class="font-medium text-gray-900">Acme,
                                    Inc.</span><br>7363 Cynthia Pass<br>Toronto, ON N3Y 4H8</dd>
                        </div>
                        <div class="mt-8 sm:mt-6 sm:border-t sm:border-gray-900/5 sm:pt-6 sm:pl-4">
                            <dt class="font-semibold text-gray-900">To</dt>
                            <dd class="mt-2 text-gray-500"><span class="font-medium text-gray-900">Tuple,
                                    Inc</span><br>886 Walter Street<br>New York, NY 12345</dd>
                        </div>
                    </dl>
                    <table class="mt-16 w-full text-left text-sm/6 whitespace-nowrap">
                        <colgroup>
                            <col class="w-full">
                            <col>
                            <col>
                            <col>
                        </colgroup>
                        <thead class="border-b border-gray-200 text-gray-900">
                            <tr>
                                <th scope="col" class="px-0 py-3 font-semibold">Projects</th>
                                <th scope="col" class="hidden py-3 pr-0 pl-8 text-right font-semibold sm:table-cell">
                                    Hours</th>
                                <th scope="col" class="hidden py-3 pr-0 pl-8 text-right font-semibold sm:table-cell">
                                    Rate</th>
                                <th scope="col" class="py-3 pr-0 pl-8 text-right font-semibold">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100">
                                <td class="max-w-0 px-0 py-5 align-top">
                                    <div class="truncate font-medium text-gray-900">Logo redesign</div>
                                    <div class="truncate text-gray-500">New logo and digital asset playbook.</div>
                                </td>
                                <td
                                    class="hidden py-5 pr-0 pl-8 text-right align-top text-gray-700 tabular-nums sm:table-cell">
                                    20.0</td>
                                <td
                                    class="hidden py-5 pr-0 pl-8 text-right align-top text-gray-700 tabular-nums sm:table-cell">
                                    $100.00</td>
                                <td class="py-5 pr-0 pl-8 text-right align-top text-gray-700 tabular-nums">$2,000.00
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="max-w-0 px-0 py-5 align-top">
                                    <div class="truncate font-medium text-gray-900">Website redesign</div>
                                    <div class="truncate text-gray-500">Design and program new company website.</div>
                                </td>
                                <td
                                    class="hidden py-5 pr-0 pl-8 text-right align-top text-gray-700 tabular-nums sm:table-cell">
                                    52.0</td>
                                <td
                                    class="hidden py-5 pr-0 pl-8 text-right align-top text-gray-700 tabular-nums sm:table-cell">
                                    $100.00</td>
                                <td class="py-5 pr-0 pl-8 text-right align-top text-gray-700 tabular-nums">$5,200.00
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="max-w-0 px-0 py-5 align-top">
                                    <div class="truncate font-medium text-gray-900">Business cards</div>
                                    <div class="truncate text-gray-500">Design and production of 3.5&quot; x 2.0&quot;
                                        business cards.</div>
                                </td>
                                <td
                                    class="hidden py-5 pr-0 pl-8 text-right align-top text-gray-700 tabular-nums sm:table-cell">
                                    12.0</td>
                                <td
                                    class="hidden py-5 pr-0 pl-8 text-right align-top text-gray-700 tabular-nums sm:table-cell">
                                    $100.00</td>
                                <td class="py-5 pr-0 pl-8 text-right align-top text-gray-700 tabular-nums">$1,200.00
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="max-w-0 px-0 py-5 align-top">
                                    <div class="truncate font-medium text-gray-900">T-shirt design</div>
                                    <div class="truncate text-gray-500">Three t-shirt design concepts.</div>
                                </td>
                                <td
                                    class="hidden py-5 pr-0 pl-8 text-right align-top text-gray-700 tabular-nums sm:table-cell">
                                    4.0</td>
                                <td
                                    class="hidden py-5 pr-0 pl-8 text-right align-top text-gray-700 tabular-nums sm:table-cell">
                                    $100.00</td>
                                <td class="py-5 pr-0 pl-8 text-right align-top text-gray-700 tabular-nums">$400.00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="row" class="px-0 pt-6 pb-0 font-normal text-gray-700 sm:hidden">Subtotal
                                </th>
                                <th scope="row" colspan="3"
                                    class="hidden px-0 pt-6 pb-0 text-right font-normal text-gray-700 sm:table-cell">
                                    Subtotal</th>
                                <td class="pt-6 pr-0 pb-0 pl-8 text-right text-gray-900 tabular-nums">$8,800.00</td>
                            </tr>
                            <tr>
                                <th scope="row" class="pt-4 font-normal text-gray-700 sm:hidden">Tax</th>
                                <th scope="row" colspan="3"
                                    class="hidden pt-4 text-right font-normal text-gray-700 sm:table-cell">Tax</th>
                                <td class="pt-4 pr-0 pb-0 pl-8 text-right text-gray-900 tabular-nums">$1,760.00</td>
                            </tr>
                            <tr>
                                <th scope="row" class="pt-4 font-semibold text-gray-900 sm:hidden">Total</th>
                                <th scope="row" colspan="3"
                                    class="hidden pt-4 text-right font-semibold text-gray-900 sm:table-cell">Total</th>
                                <td class="pt-4 pr-0 pb-0 pl-8 text-right font-semibold text-gray-900 tabular-nums">
                                    $10,560.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>


            </div>
        </div>
    </main>


</body>

</html>
