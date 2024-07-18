@component('mail::message')
<p>Dear <b>{{ $order->first_name }} {{ $order->last_name }},</b></p>
<p>Thank you for your recent purchase with <strong>E-Commerce_VC</strong>. We are pleased to confirm your order and have attached the invoice for your records.</p>
<h3>Order Details:</h3>
<ul>
    <li>Order Number: {{ $order->order_number }}</li>
    <li>Date of Purchase: {{ date('d-m-Y', strtotime($order->created_at)) }}</li>
    <li>Shipping Address: {{ $order->address_two }}, {{ $order->address_one }} </li>
</ul>

<table>
    <thead>
    <tr>
        <th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left">Item</th>
        <th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left">Quantity</th>
        <th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left">Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->getItem as $item)
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd">
                {{ $item->getProduct->title }}
                <br>
                Color: {{ $item->color_name }}
                @if(!empty($item->size_name))
                    <br>
                    Size {{ $item->size_name }}: ${{ number_format($item->size_amount, 2) }}
                @endif
            </td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; text-align: center">{{ $item->quantity }}</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd">${{ number_format($item->price, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<p>{{ $order->getShipping->name }}: <b>${{ number_format($order->shipping_amount, 2) }}</b></p>
@if(!empty($order->discount_code))
    <p>Discount: <b>${{ number_format($order->discount_amount, 2) }}</b></p>
@endif
<p>Total Amount: <b>${{ number_format($order->total_amount, 2) }}</b></p>
<p style="text-transform: capitalize">Payment Method: <b>{{ $order->payment_method }}</b></p>

<p>Thank you for choosing <strong>E-Commerce_VC</strong>. We appreciate your business.</p>
Thanks,<br>
{{ config('app.name') }}.
@endcomponent
