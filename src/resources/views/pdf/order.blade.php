<html>
<body>
<h1>ORDER #{{ $order->id }}</h1>

@foreach ($order->items as $item)
    <p>{{ $item->product->name }} {{ $item->topping ? '+ ' . $item->topping->name : ''  }} x {{ $item->quantity }} (&euro; {{ $item->price }})</p>
@endforeach
</body>
</html>
