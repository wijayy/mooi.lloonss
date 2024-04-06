@extends('layout.main')

@section('head')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
@endsection

@section('container')
    <section id="products-create">
        <h3 class="title">{{ $title }}</h3>
        <form action="{{ $action }}" method="post" enctype="multipart/form-data">
            @if (!$sts)
                @method('patch')
            @endif
            @csrf
            {{-- <input type="hidden" name="id" value="{{ $product->id }}"> --}}
            <div class="input-img ">
                @for ($i = 1; $i < 6; $i++)
                    <div class="input-image">
                        <img src="{{ asset('storage/' . $product['image' . $i]) }}" alt="image {{ $i }}"
                            class="img-preview">
                        <input type="file" name="image{{ $i }}" id="image{{ $i }}"
                            class="inputImage">
                        <label for="image{{ $i }}" class="image">Image {{ $i }}</label>
                        @error('image{{ $i }}')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endfor
            </div>
            <div class="input-box">
                <div class="input">
                    <label for="nama">Nama</label>
                    <input required type="text" name="nama" id="nama" value="{{ old('nama', $product->nama) }}">
                </div>
                @error('nama')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="input-box">
                <div class="input">
                    <label for="slug">Slug</label>
                    <input required type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}"
                        readonly>
                </div>
                @error('slug')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="input-box variations">
                <div class="add">
                    <i class="bx bx-plus"></i> Tambah Variasi
                </div>
                @foreach ($product->variations as $variation)
                    {{-- @for ($i = 0; $i < 2; $i++) --}}
                    <div class="variation">
                        <div class="nama input">
                            <label for="nama{{ $loop->index }}">Nama Variasi</label>
                            <input required type="text" name="variations[{{ $variation }}][nama]"
                                value="{{ $variation->nama }}" id="nama{{ $loop->index }}">
                            @error('variations[{{ $variation }}][nama]')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- </div> --}}

                        <div class="jumlah input">
                            <label for="jumlah{{ $loop->index }}">Jumlah Variasi</label>
                            <input required type="number" name="variations[{{ $variation }}][jumlah]"
                                id="jumlah{{ $loop->index }}" value="{{ $variation->jumlah }}">
                            @error('variations[{{ $variation }}][jumlah]')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="categories">
                            <div class="title">Kategori Stok :</div>
                            @foreach ($stockCategories as $category)
                                <input type="radio" name="variations[{{ $variation }}][category]"
                                    id="category{{ $loop->parent->index }}{{ $loop->iteration }}"
                                    value="{{ $category->id }}" required @if ($category->id == $variation->stock_category_id) checked @endif>
                                <label
                                    for="category{{ $loop->parent->index }}{{ $loop->iteration }}">{{ $category->nama }}</label>
                                @error('variations[{{ $variation }}][category]')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @endforeach
                        </div>
                        <div class="delete"><i class="bx bx-trash"></i></div>
                    </div>
                @endforeach
            </div>


            <div class="input-box">
                <div class="categories">
                    <div class="title">Delivery options :</div>
                    @foreach ($deliveries as $delivery)
                        <input type="checkbox" name="delivery[{{ $loop->index }}][delivery_id]"
                            id="delivery{{ $delivery->id }}" value="{{ $delivery->id }}"
                            @if (in_array($delivery->id, $deliveriesId)) checked @endif>
                        <label for="delivery{{ $delivery->id }}">{{ $delivery->nama }}</label>
                        @error('delivery[{{ $loop->index }}][delivery_id]')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror
                    @endforeach
                </div>
            </div>
            <div class="input-box">
                <div class="input">
                    <label for="deskripsi">Deskripsi</label>
                    <input id="deskripsi" type="hidden" name="deskripsi"
                        value="{{ old('deskripsi', $product->deskripsi) }}">
                </div>
                @error('body')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror
                <trix-editor input="deskripsi"></trix-editor>
            </div>
            <button type="submit">{{ $button }}</button>
        </form>
    </section>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('script')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script>
        $(document).ready(function() {
            $('body').addClass("create-products");
            // $('body').on('change', "#nama", slug("products-slug"));
            document.querySelector('#nama').onchage = slug("products-slug");
            var count = 1;
            check();
            var counts = $('.variation').length;

            function check() {
                count = $('.variation').length;
                console.log(count);
                if (count === 1) {
                    $('.delete').fadeOut(300);
                } else if (count > 1) {
                    $('.delete').fadeIn(300);
                }
            }

            // Tambahkan elemen saat tombol "Add" diklik
            $('form').on('click', '.add', function() {

                var newElement = `
                <div class="variation">
                        <div class="nama input">
                            <label for="nama${counts}">Nama Variasi</label>
                            <input required type="text" name="variations[${counts}][nama]"
                                 id="nama${counts}">
                            @error('variations[${counts}][nama]')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- </div> --}}

                        <div class="jumlah input">
                            <label for="jumlah${counts}">Jumlah Variasi</label>
                            <input required type="number" name="variations[${counts}][jumlah]"
                                id="jumlah${counts}" >
                            @error('variations[${counts}][jumlah]')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="categories">
                            <div class="title">Kategori Stok :</div>
                            @foreach ($stockCategories as $category)
                                <input type="radio" name="variations[${counts}][category]"
                                    id="category${counts}{{ $loop->iteration }}"
                                    value="{{ $category->id }}" required>
                                <label
                                    for="category${counts}{{ $loop->iteration }}">{{ $category->nama }}</label>
                                @error('variations[${counts}][category]')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @endforeach
                        </div>
                        <div class="delete"><i class="bx bx-trash"></i></div>
                    </div>
                `;
                // newElement.hide();
                $('.variations').append(newElement);
                // newElement.fadeIn(300);
                check();
                counts++;
            });

            // Hapus elemen saat tombol "Delete" diklik
            $('form').on('click', '.delete', function() {
                $(this).parent('.variation').remove();
                check();
            });

            $('.inputImage').change(function() {
                var input = $(this);
                var img = input.siblings('.img-preview');
                var label = input.siblings('label');

                if (input.val()) {
                    img.addClass('show');
                    label.addClass('hide');
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        img.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input[0].files[0]);
                } else {
                    img.removeClass('show');
                    label.removeClass('hide');
                    img.attr('src', '');
                }
            });
        });
    </script>
@endsection
