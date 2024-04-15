@extends('layout.main')

@section('container')
    <x-section>
        {{-- <a href="/products/create"></a> --}}
        <div class="flex w-full gap-4 pt-32" x-data="{ selectedImage: '{{ asset('storage/' . $product->image1) }} ' }">
            <div class="w-2/5 ">
                <img :src="selectedImage" alt="" id="" class="w-full h-fit " x-transition.duration.500ms />
                <div class="flex w-full gap-2 mt-2 h-fit">
                    @for ($i = 1; $i < 6; $i++)
                        @if ($product['image' . $i])
                            <div class="w-1/5">
                                <img src="{{ asset('storage/' . $product['image' . $i]) }}" alt=""
                                    class="w-full h-fit" x-on:click="selectedImage=$event.target.src" />
                            </div>
                        @endif
                    @endfor
                </div>

            </div>
            <div class="w-3/5 p-3 bg-white single-pro-details">
                <a href="/products?category={{ $product->category->slug }}" class=" text-md">{{ $product->category->nama }}
                </a>
                <h4 class="text-lg ">{{ $product->nama }}</h4>
                <h2 class="mt-2 text-2xl font-comfortaa text-sky-500">Rp. {{ $product->harga }}</h2>
                <form action="/products" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="number" name="jumlah" id="jumlah" value="1" min="1"
                        class="w-10 h-10 pl-1 text-lg border font-comfortaa border-sky-500">
                    @foreach ($product->variations as $variation)
                        <h4 class="pt-3">{{ $variation->nama }}</h4>
                        <div class="flex flex-wrap gap-3 pb-3">
                            @foreach ($variation->stock_category->stocks as $stock)
                                <label for="{{ $variation->slug . $stock->id }}"
                                    class="flex gap-1 has-[:checked]:border-2 rounded-md border-sky-500 px-2 py-1">
                                    <input type="radio" name="{{ $variation->slug }}" value="{{ $stock->id }}"
                                        id="{{ $variation->slug . $stock->id }}" class="hidden"
                                        @if ($loop->iteration == 1) checked @endif>
                                    <img src="{{ asset('storage/' . $stock->image) }}" alt=""
                                        class="border size-6 border-stone-950"
                                        style="border-radius: 0.7rem 1rem 1rem 0.7rem">
                                    <p>{{ $stock->warna }}</p>
                                </label>
                            @endforeach
                        </div>
                    @endforeach

                    <button type="submit" class="px-4 py-2 rounded-lg bg-sky-400 font-comfortaa"><i
                            class='bx bx-cart'></i>Tambahkan ke keranjang</button>
                </form>
            </div>
        </div>

        <div class="flex w-full gap-2 mt-3 ">
            <div class="w-9/12 p-2 bg-white rounded-l-xl">
                <h4 class="font-comfortaa">Product Details</h4>
                <div class="indent-3">{!! $product->deskripsi !!}</div>
            </div>
            <div class="grid w-3/12 grid-cols-1 gap-4 p-2 bg-white rounded-r-xl">
                <h2 class="text-lg text-center font-comfortaa">Recomendation</h2>
                @foreach ($products as $product)
                    <a class=" rounded-lg transition-all duration-300 hover:scale-[1.02] border"
                        href="/products/{{ $product->slug }}">
                        <img src="{{ asset('storage/' . $product->image1) }}" alt="" class="w-full rounded-lg" />
                        <div class="des">
                            <h5 class="p-4 text-xl ">{{ $product->nama }}</h5>
                            <h4 class="px-4 pb-2 text-lg text-sky-500">{{ $product->harga }}</h4>
                            <div class="flex flex-wrap gap-1 px-4 pb-2 align-middle">
                                @foreach ($product->variations as $variation)
                                    <img class="rounded-full size-4"
                                        src="{{ asset('storage/color/' . $loop->iteration % 10 . '.png') }}"
                                        alt="">
                                @endforeach
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </x-section>
@endsection
