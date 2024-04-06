@extends('layout.main')

@section('container')
    <section id="product-index">
        <h2 class="title">{{ $title }}</h2>
        <div class="box">
            @foreach ($products as $product)
                <a class="cell" href="/products/{{ $product->slug }}">
                    <img src="{{ asset('storage/' . $product->image1) }}" alt="" />
                    <div class="des">
                        <span>{{ $product->category->nama }}</span>
                        <h5>{{ $product->nama }}</h5>
                        <h4>{{ $product->harga }}</h4>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="user" value="" />
                        <input type="hidden" name="product" value="" />
                        <button type="submit"><i class="bx bx-cart-alt cart"></i></button>
                    </form>
                </a>
            @endforeach
        </div>
        <div class="page">
            {{ $products->links() }}
        </div>
    </section>
@endsection
