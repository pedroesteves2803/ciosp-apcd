@foreach ($products as $product)
    <b>{{ $product->name }}</b> : <a href="{{ route('cart.add', ['id' => $product->id]) }}">Adicionar</a>
    <br>
@endforeach


@if(session('message'))
    <p>{{ session('message') }}</p>
@endif
