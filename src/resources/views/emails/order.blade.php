<html>
<body>
From: {{ $user->name }} &lt;{{ $user->email }}&gt;

@foreach ($order->items as $item)
    <p>{{ $item->product->name }} {{ $item->topping ? '+ ' . $item->topping->name : ''  }} x {{ $item->quantity }} (&euro; {{ $item->price }})</p>
@endforeach
</body>
</html>

