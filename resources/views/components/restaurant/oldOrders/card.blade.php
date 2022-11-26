@props(['order'])

<div class="row mb-4">
    <div class="col col-lg-2 col-sm-auto col-xs-auto">
        <p>Delivery: {{ $order->delivery->name }}</p>
    </div>

    <div class="col col-lg-2 col-sm-auto col-xs-auto">
        <p class="text-break">{{ $order->order }}</p>
    </div>

    <div class="col col-lg-2 col-sm-auto col-xs-auto">
        <p>@usd($order->sum_order)</p>
    </div>
</div>
