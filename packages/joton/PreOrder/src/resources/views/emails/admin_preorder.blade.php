@component('mail::message')
# Hello, Admin

We are happy to inform you that you have a new pre-order!

## Contact Information

Name: {{ $data->name }}<br>
Email: {{ $data->email }}<br>
Phone: {{ $data->phone ?? null }}

## Order Details


<table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">ID</th>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Category</th>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Product</th>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Price</th>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Quantity</th>
            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Total</th>
        </tr>
    </thead>
    <tbody>
        @php
            $grandTotal = 0;
        @endphp
        @foreach ($data->details as $key => $item)
            @php
                $grandTotal += $item['total_price'];
            @endphp
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ ++$key }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['product']['category']['name'] }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['product']['name'] }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['unit_price'] }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['quantity'] }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['total_price'] }}</td>
            </tr>
        @endforeach
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px; text-align: right;" colspan="5"><strong>Total</strong>
            </td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $grandTotal }}</td>
        </tr>
    </tbody>
</table>

<br><br>
Thanks,<br>
Joton Sutradhar
@endcomponent
