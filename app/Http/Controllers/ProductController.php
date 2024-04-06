<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Models\StockCategory;
use App\Models\DeliveryOption;
use App\Models\ProductCategory;
use App\Models\ProductVariation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Product::latest()->get();
        $title = '';
        if (request("category")) {
            $category = ProductCategory::firstWhere("slug", request("category"));
            $title = "in $category->nama";
        }
        return view("products.index", [
            "title" => "All Products $title",
            "products" => Product::latest()->search(request("search"))
                ->category(request("category"))->paginate(12)->withQueryString(),
            "categories" => ProductCategory::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $temp = Product::make([
            "nama" => '',
            'slug' => '',
            "harga" => '',
            "deskripsi" => '',
            "image1" => "",
            "image2" => "",
            "image3" => "",
            "image4" => "",
            "image5" => "",
            "product_category_id" => '',
            "variations" => [
                [
                    "nama" => "",
                    "slug" => "",
                    "stock_category_id" => '',
                    "jumlah" => '',
                    "product_id" => '',
                ]
            ]
        ]);
        return view("products.create", [
            "product" => $temp,
            'title' => "Create New Products",
            'sts' => true,
            'action' => "/products",
            "button" => 'Create Products',
            "categories" => ProductCategory::all(),
            'stockCategories' => StockCategory::all(),
            'deliveries' => Delivery::all(),
            "variationsId" => [],
            "deliveriesId" => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validateProduct = $request->validate([
            // 'id' => 'required',
            'nama' => 'required|max:255',
            'slug' => 'required|unique:products',
            'deskripsi' => 'required',
            'image1' => 'required|image|file|max:2048',
            'image2' => 'required|image|file|max:2048',
            'image3' => 'required|image|file|max:2048',
            'image4' => 'required|image|file|max:2048',
            'image5' => 'required|image|file|max:2048',
            'variations' => 'required|array',
            'variations.*.nama' => 'required|max:20',
            'variations.*.jumlah' => 'required|max:2',
            'variations.*.category' => 'required',
            'deliveries' => 'array',
            'deliveries.*.delivery_id' => 'required',
        ]);

        // $validateVariations = $request->validate([
        // ]);

        // $validateDelivery = $request->validate([

        // ]);

        for ($i = 1; $i < 6; $i++) {
            if ($request->file("image$i")) {
                $validateProduct["image$i"] = $request->file("image$i")->store('product');
            }
        }

        Product::create($validateProduct);
        // foreach ($validateVariations as $variations) {
        //     $variations['product_id'] = $validateProduct['id'];
        //     ProductVariation::create($variations);
        // }
        // foreach ($validateDelivery as $deliveries) {
        //     $deliveries['product_id'] = $validateProduct['id'];
        //     DeliveryOption::create($deliveries);
        // }

        return redirect("/products")->with("success", "New Post Added");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // return $product;
        return view("products.show", [
            "product" => $product,
            "title" => $product->nama,
            "categories" => ProductCategory::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $delivery_id = [];
        $stock_category_id = [];
        foreach ($product->variations as $item) {
            $stock_category_id[] = $item->stock_category_id;
        }
        foreach ($product->deliveries as $item) {
            $delivery_id[] = $item->delivery_id;
        }
        // return $product->variations;
        return view("products.create", [
            "product" => $product,
            'title' => "Edit $product->nama",
            'sts' => false,
            'action' => "/products/$product->slug/",
            "button" => 'Create Products',
            "categories" => ProductCategory::all(),
            'stockCategories' => StockCategory::all(),
            'deliveries' => Delivery::all(),
            "variationsId" => $stock_category_id,
            "deliveriesId" => $delivery_id

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        for ($i = 1; $i < 6; $i++) {
            if ($product["image$i"]) {
                Storage::delete($product["image$i"]);
            }
        }

        // Misalnya, Anda ingin menghapus record dengan nama "John"
        $variations = ProductVariation::where('product_id', $product->id);
        // Jika record ditemukan, hapus record tersebut
        if ($variations) {
            $variations->delete();
        }

        // Misalnya, Anda ingin menghapus record dengan nama "John"
        $deliveries = DeliveryOption::where('product_id', $product->id);
        // Jika record ditemukan, hapus record tersebut
        if ($deliveries) {
            $deliveries->delete();
        }

        Product::destroy($product->id);

        return redirect("/products")->with("success", "Posts Deleted");
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->title);
        return response()->json(["slug" => $slug]);
    }
}
