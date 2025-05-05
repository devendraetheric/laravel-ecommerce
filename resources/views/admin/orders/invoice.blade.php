<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $order->order_number }}</title>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ public_path('css/print.css') }}">


</head>

<body>
    <div class="page">
        <h1 class="text-center">INVOICE</h1>
        <table width="100%" class="table-bordered">
            <tr>
                <td width="50%">

                    {{-- <img src="{{ websiteLogo() }}" alt="{{ config('app.name') }}" height="50px;" width="150px;" /> --}}

                    <img src="{{ public_path('storage/' . $generalSetting->logo) }}" alt="{{ config('app.name') }}"
                        height="50px;" width="150px;" />
                </td>
                <td width="50%">
                    <b>Order Number :</b> {{ $order->order_number }} <br>
                    <b>Order Date :</b>
                    {{ $order->order_date->format(dateFormat()) }}
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                        <b>{{ $companySetting->name }}</b> <br>
                        {{ $companySetting->address }} , <br>
                        {{ $state }},{{ $country }}, <br>
                        Phone Number : {{ $companySetting->phone }}
                    </p>
                </td>
                <td>
                    <p>
                        <b>{{ $order->address?->contact_name }}</b> <br>
                        {{ $order->address?->address_line_1 }} , {{ $order->address?->address_line_2 }}
                        {{ $order->address?->city }}
                        <br>{{ $order->address?->state?->name }},
                        {{ $order->address?->country?->iso2 }} -
                        {{ $order->address?->zip_code }}<br>
                        Phone Number : {{ $order->address?->phone }}
                    </p>
                </td>
            </tr>
        </table>

        <table width="100%" style="line-height: 20px;" class="table-bordered">
            <thead style="font-weight: bold;">
                <tr>
                    <th width="10%" class="text-center">Sr No.</th>
                    <th width="60%" class="text-center">Product</th>
                    <th width="10%" class="text-center">Rate</th>
                    <th width="10%" class="text-center">QTY</th>
                    <th width="10%" class="text-right">Total</th>
                </tr>
            </thead>
            @foreach ($order->items as $key => $item)
                <tbody>
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td class="text-center">${{ $item->price }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right">${{ $item->total }}</td>
                    </tr>
                </tbody>
            @endforeach

            <tfoot class="tfoot-bordered">
                <tr>
                    <th colspan="2" rowspan="2" class="text-left">
                        <p style="margin-left: 10px;">{{ $order->notes }}</p>
                    </th>
                    <th colspan="2"><b>Subtotal</b></th>
                    <td class="text-right">${{ $order->sub_total }}</td>
                </tr>

                <tr>
                    <th colspan="2"><b>Grand Total</b></th>
                    <td class="text-right"><b>${{ $order->grand_total }}</b></td>
                </tr>
            </tfoot>
        </table>

    </div>

</body>

</html>
