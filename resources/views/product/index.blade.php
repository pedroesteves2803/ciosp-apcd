@foreach ($products as $product)

    @php
        $cartItemIndexFound = $cart->items()->search(function (\Ciosp\Sales\Domain\Entities\CartItem $cartItem) use ($product) {
            return $cartItem->product->id === $product->id;
        });
    @endphp

        @if ($cartItemIndexFound === false)
            <b>{{ $product->name }}</b> : <a href="{{ route('cart.add', ['id' => $product->id]) }}">Adicionar</a>
            <br>
        @else
            <b>{{ $product->name }}</b> : <a href="{{ route('cart.delete', ['id' => $product->id]) }}">Remover</a>
            <br>
        @endif


@endforeach




@if(session('errors'))

    @foreach (session('errors') as $error)
        <p>{{ $error['message'] }}</p>
    @endforeach

@endif


@if(session('message'))
    <p>{{ session('message') }}</p>
@endif
