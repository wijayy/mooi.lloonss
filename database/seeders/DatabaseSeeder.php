<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Delivery;
use Illuminate\Support\Str;
use App\Models\StockCategory;
use App\Models\DeliveryOption;
use App\Models\ProductCategory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductVariation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $warna = ["pink", "merah", 'ijo', 'kuning', 'biru', 'hitam', 'putih', 'bening'];
        $pengiriman = ["gojek", 'grab', 'COD'];

        User::factory(10)->create();

        StockCategory::factory()->create([
            'nama' => 'Balon panjang',
            'slug' => 'balon-panjang',
        ]);
        StockCategory::factory()->create([
            'nama' => 'Balon bulat',
            'slug' => 'balon-bulat',
        ]);

        ProductCategory::factory()->create([
            'nama' => 'Bucket kecil',
            'slug' => 'bucket-kecil',
        ]);
        ProductCategory::factory()->create([
            'nama' => 'Bucket besar',
            'slug' => 'bucket-besar',
        ]);
        $i = 1;
        foreach ($warna as $war) {
            Stock::factory()->create([
                'warna' => "$war",
                'slug' => "$war",
                "jumlah" => 20,
                "image" => "color/$i.png",
                "stock_category_id" => 1
            ]);
            $i++;
        }
        $i = 1;
        foreach ($warna as $war) {
            Stock::factory()->create([
                'warna' => "$war",
                'slug' => "$war",
                "jumlah" => 20,
                "image" => "color/$i.png",
                "stock_category_id" => 2
            ]);
            $i++;
        }

        Product::factory(20)->create();

        ProductVariation::factory(80)->create();

        foreach ($pengiriman as $peng) {
            Delivery::factory()->create([
                "nama" => $peng,
                "slug" => Str::lower($peng),
            ]);
        }

        DeliveryOption::factory(30)->create();
    }
}
