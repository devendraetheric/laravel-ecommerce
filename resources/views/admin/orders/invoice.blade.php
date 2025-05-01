@inject('settings', 'App\Settings\GeneralSetting')
@inject('companySettings', 'App\Settings\CompanySetting')
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

    <h1 style="text-align: center;">INVOICE</h1>

    <table width="100%">
        <tr>
            <td width="50%">
                <img src="{{ public_path('storage/' . $settings->logo) }}" alt="{{ config('app.name') }}" height="50px;"
                    width="150px;" />
            </td>
            <td width="50%">
                <b style="margin-left: 10px;">Order Number :</b> {{ $order->order_number }} <br>
                <b style="margin-left: 10px;">Order Date :</b> {{ $order->order_date->format($settings->date_format) }}
            </td>
        </tr>
        <tr>
            <td>
                <p style="margin-left: 10px;">
                    <b>{{ $companySettings->name }}</b> <br>
                    {{ $companySettings->address }} , <br>
                    {{ $companySettings->state }},{{ $companySettings->country }}, <br>
                    Phone Number : {{ $companySettings->phone }}
                </p>
            </td>
            <td>
                <p style="margin-left: 10px;">
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

    <table width="100%" style="line-height: 35px;">
        <thead style="font-weight: bold;">
            <tr>
                <td width="10%" style="text-align: center;">Sr No.</td>
                <td width="60%" style="text-align: center;">Product</td>
                <td width="10%" style="text-align: center;">Rate</td>
                <td width="10%" style="text-align: center;">QTY</td>
                <td width="10%" style="text-align: right;">Total</td>
            </tr>
        </thead>
        @foreach ($order->items as $key => $item)
            <tbody>
                <tr>
                    <td style="text-align: center">{{ $key + 1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td style="text-align: center">{{ $item->price }}</td>
                    <td style="text-align: center">{{ $item->quantity }}</td>
                    <td style="text-align: right">{{ $item->total }}</td>
                </tr>
            </tbody>
        @endforeach


        <tfoot>
            <tr>
                <th colspan="2" rowspan="2" style="text-align: left;">
                    <p style="margin-left: 10px;">{{ $order->notes }}</p>
                </th>
                <th colspan="2"><b>Subtotal</b></th>
                <td style="text-align: right">{{ $order->sub_total }}</td>
            </tr>

            <tr>
                <th colspan="2"><b>Grand Total</b></th>
                <td style="text-align: right">{{ $order->grand_total }}</td>
            </tr>
        </tfoot>
    </table>



</body>

</html>
