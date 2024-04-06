@extends('layout.main')

@section('container')
    <section id="products-show" class="">
        <a href="/products/create"></a>
        <div class="top">
            <div class="single-pro-image">
                <img src="{{ asset('storage/' . $product->image1) }}" alt="" id="mainImg" />
                <div class="small-img-group">
                    @for ($i = 1; $i < 6; $i++)
                        @if ($product['image' . $i])
                            <div class="small-img-col">
                                <img src="{{ asset('storage/' . $product['image' . $i]) }}" alt=""
                                    class="small-img" />
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="single-pro-details">
                <h6>{{ $product->category->nama }}</h6>
                <h4>{{ $product->nama }}</h4>
                <h2>Rp. {{ $product->harga }}</h2>
                <form action="#" method="post">
                    @csrf
                    <input type="number" name="jumlah" id="jumlah" value="1">
                    @foreach ($product->variations as $variation)
                        @php
                            $first = true;
                        @endphp
                        <h4>{{ $variation->nama }}</h4>
                        <div class="variasi">
                            @foreach ($variation->stock_category->stocks as $stock)
                                @if ($first)
                                    <input type="radio" name="{{ $variation->slug }}" value="{{ $stock->id }}"
                                        id="{{ $variation->slug . $stock->id }}" checked>
                                    <label for="{{ $variation->slug . $stock->id }}">
                                        <img src="{{ asset('storage/' . $stock->image) }}" alt="">
                                        <p>{{ $stock->warna }}</p>
                                    </label>
                                    @php
                                        $first = false;
                                    @endphp
                                @else
                                    <input type="radio" name="{{ $variation->slug }}" value="{{ $stock->id }}"
                                        id="{{ $variation->slug . $stock->id }}">
                                    <label for="{{ $variation->slug . $stock->id }}">
                                        <img src="{{ asset('storage/' . $stock->image) }}" alt="">
                                        <p>{{ $stock->warna }}</p>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    @endforeach

                    <button type="submit"><i class='bx bx-cart'></i>Tambahkan ke keranjang</button>
                </form>
            </div>
        </div>

        <div class="bottom">
            <h4>Product Details</h4>
            <span>{!! $product->deskripsi !!}</span>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('body').addClass("create-products");

            $("#products-show .small-img").click(function() {
                var newSrc = $(this).attr("src");
                $("#mainImg").fadeOut(100, function() {
                    $(this).attr("src", newSrc).fadeIn(300);
                });
            });
        });
    </script>
@endsection
