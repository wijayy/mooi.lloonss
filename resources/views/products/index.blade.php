@extends('layout.main')

@section('container')
    <x-thin-header>All Products</x-thin-header>
    <x-section id="product-index" class="">
        {{-- <h2 class="">{{ $title }}</h2> --}}
        <div class="grid grid-cols-2 gap-4 mt-12 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($products as $product)
                <a class=" rounded-lg transition-all duration-300 hover:scale-[1.02] border"
                    href="/products/{{ $product->slug }}">
                    <img src="{{ asset('storage/' . $product->image1) }}" alt="" class="w-full rounded-lg" />
                    <div class="des">
                        <h5 class="p-4 text-xl ">{{ $product->nama }}</h5>
                        <h4 class="px-4 pb-2 text-lg text-sky-500">{{ $product->harga }}</h4>
                        <div class="flex flex-wrap gap-1 px-4 pb-2">
                            @foreach ($product->variations as $variation)
                                <img class="rounded-full size-4"
                                    src="{{ asset('storage/color/' . $loop->iteration % 10 . '.png') }}" alt="">
                            @endforeach
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="flex justify-center pt-8 ">
            {{ $products->links() }}
        </div>
    </x-section>
@endsection
