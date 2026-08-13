<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestoreLegacyDataSeeder extends Seeder
{
    /**
     * Restore data lama dari dump db_la_primera.sql ke database Supabase (Postgres).
     * Jalankan dengan: php artisan db:seed --class=RestoreLegacyDataSeeder
     */
    public function run(): void
    {
        DB::transaction(function () {
            $this->seedUsers();
            $this->seedCategories();
            $this->seedProducts();
            $this->seedProductCategories();
            $this->seedProductImages();
            $this->seedProductSizeVariants();
            $this->seedCarts();
            $this->seedCartItems();
            $this->seedOrders();
            $this->seedOrderItems();
        });

        // Reset sequence Postgres supaya ID berikutnya (auto-increment)
        // tidak bentrok dengan ID yang baru saja kita insert manual.
        $this->resetSequence('users');
        $this->resetSequence('categories');
        $this->resetSequence('products');
        $this->resetSequence('product_categories');
        $this->resetSequence('product_images');
        $this->resetSequence('product_size_variants');
        $this->resetSequence('carts');
        $this->resetSequence('cart_items');
        $this->resetSequence('orders');
        $this->resetSequence('order_items');

        $this->command->info('Restore data lama selesai.');
    }

    private function resetSequence(string $table): void
    {
        DB::statement("
            SELECT setval(
                pg_get_serial_sequence('{$table}', 'id'),
                COALESCE((SELECT MAX(id) FROM {$table}), 1)
            )
        ");
    }

    private function seedUsers(): void
    {
        DB::table('users')->insert([
            [
                'id' => 2, 'name' => 'user satu', 'email' => 'user1@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$FznJrUC/oJVWmtclctxrzOK/qZ.ZNEyjqoLVdlzi8l3UAN/VoT1p.',
                'phone' => null, 'birth_date' => null, 'gender' => null, 'avatar' => null,
                'role' => 'user', 'is_active' => true,
                'last_login_at' => '2025-08-11 20:44:05', 'remember_token' => null,
                'created_at' => '2025-07-02 23:29:58', 'updated_at' => '2025-08-11 20:44:05',
            ],
            [
                'id' => 3, 'name' => 'ArhamUser2', 'email' => 'user2@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$jDTU8c8ZCbCJNni7w4G4BuxNBlsn1evlKBVJwUCVzc8KtHN/gMwxi',
                'phone' => '085137113391', 'birth_date' => '2025-07-05', 'gender' => 'male',
                'avatar' => 'avatars/9KEazYtPsydN5IQ6XOzpbnH0NR74IDu2ROatmzYl.jpg',
                'role' => 'user', 'is_active' => true,
                'last_login_at' => '2025-07-14 22:32:43', 'remember_token' => null,
                'created_at' => '2025-07-02 23:48:55', 'updated_at' => '2025-07-14 22:32:43',
            ],
            [
                'id' => 4, 'name' => 'anak sholeh', 'email' => 'anaksholeh@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$rh0euPnREWauoDu501camuzlXw8Y5555.HvISGMI52ltnU.cFerqO',
                'phone' => '098765432154', 'birth_date' => null, 'gender' => null, 'avatar' => null,
                'role' => 'user', 'is_active' => true,
                'last_login_at' => null, 'remember_token' => null,
                'created_at' => '2025-07-03 00:03:23', 'updated_at' => '2025-07-03 00:03:23',
            ],
            [
                'id' => 6, 'name' => 'Admin Mutawali', 'email' => 'admin@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$y5n2sNWvGC9DwLsTcGvCCOSRaTwnzWj8YVGIkqN7AAPJGqubF.whq',
                'phone' => '085137113391', 'birth_date' => null, 'gender' => null, 'avatar' => null,
                'role' => 'admin', 'is_active' => true,
                'last_login_at' => '2025-09-04 04:20:10', 'remember_token' => null,
                'created_at' => '2025-07-10 04:41:58', 'updated_at' => '2025-09-04 04:20:10',
            ],
            [
                'id' => 7, 'name' => 'Gama Tes', 'email' => 'Gama@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$HokjJfBG8c3xexdD4NL1huwWIEurHcPNDojBeyFhLO3ky0I2vuicW',
                'phone' => '098765432123', 'birth_date' => null, 'gender' => null, 'avatar' => null,
                'role' => 'user', 'is_active' => true,
                'last_login_at' => '2025-08-07 00:48:22', 'remember_token' => null,
                'created_at' => '2025-07-17 17:26:06', 'updated_at' => '2025-08-07 00:48:22',
            ],
        ]);
    }

    private function seedCategories(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 1, 'name' => 'Hoodie', 'slug' => 'hoodie',
                'description' => 'Koleksi hoodie stylish dan nyaman untuk segala aktivitas.',
                'image' => null, 'icon' => null, 'parent_id' => null,
                'sort_order' => 0, 'is_active' => true,
                'meta_title' => null, 'meta_description' => null,
                'created_at' => '2025-07-06 01:37:41', 'updated_at' => '2025-07-06 01:37:41',
            ],
            [
                'id' => 2, 'name' => 'T-Shirt', 'slug' => 't-shirt',
                'description' => 'Kaos katun premium dengan berbagai desain unik dan modern.',
                'image' => null, 'icon' => null, 'parent_id' => null,
                'sort_order' => 0, 'is_active' => true,
                'meta_title' => null, 'meta_description' => null,
                'created_at' => '2025-07-06 01:37:41', 'updated_at' => '2025-07-06 01:37:41',
            ],
        ]);
    }

    private function seedProducts(): void
    {
        $base = [
            'compare_price' => null, 'cost_price' => null, 'min_stock_level' => 0,
            'track_stock' => true, 'is_active' => true, 'is_featured' => false,
            'is_digital' => false, 'weight' => null, 'dimensions' => null,
            'attributes' => null, 'meta_title' => null, 'meta_description' => null,
            'views_count' => 0, 'sales_count' => 0, 'rating_average' => 0, 'rating_count' => 0,
        ];

        DB::table('products')->insert([
            array_merge($base, [
                'id' => 13, 'name' => 'sayanar', 'slug' => 'synr',
                'description' => 'sayonara arigatou hua ha haha', 'short_description' => 'sayonara',
                'sku' => 'syn', 'price' => 45000.00, 'brand' => 'synra', 'colors' => 'Blue',
                'created_at' => '2025-08-28 05:20:50', 'updated_at' => '2025-08-28 05:20:50',
            ]),
            array_merge($base, [
                'id' => 14, 'name' => 'duyung', 'slug' => 'dy',
                'description' => 'indah permatasari putri duyung', 'short_description' => 'duyung indah',
                'sku' => 'dyng', 'price' => 120000.00, 'brand' => 'mnc', 'colors' => 'Pink',
                'created_at' => '2025-08-29 00:51:31', 'updated_at' => '2025-08-29 00:51:31',
            ]),
            array_merge($base, [
                'id' => 15, 'name' => 'Kaos HP', 'slug' => 'hpv',
                'description' => 'kaos enak dipakai premium', 'short_description' => 'kaos lekas',
                'sku' => 'vcts', 'price' => 230000.00, 'brand' => 'victus', 'colors' => 'BLACK',
                'created_at' => '2025-08-30 05:31:01', 'updated_at' => '2025-08-30 05:31:01',
            ]),
            array_merge($base, [
                'id' => 16, 'name' => 'xiaomi coooy', 'slug' => 'xmi',
                'description' => 'redmi note 12 hp jaman now enak dipake', 'short_description' => 'redmi note 12',
                'sku' => 'rdmi', 'price' => 1900000.00, 'brand' => 'mi', 'colors' => 'Blue',
                'created_at' => '2025-08-30 08:53:29', 'updated_at' => '2025-09-07 00:52:40',
            ]),
            array_merge($base, [
                'id' => 17, 'name' => 'HoodieFlava', 'slug' => 'hdflv',
                'description' => 'hoodie flava enak dipake', 'short_description' => 'hoodie',
                'sku' => 'flvahd', 'price' => 198000.00, 'brand' => 'Flava', 'colors' => 'Black',
                'created_at' => '2025-09-07 01:02:39', 'updated_at' => '2025-09-07 01:02:39',
            ]),
            array_merge($base, [
                'id' => 18, 'name' => 'Tambah lagi', 'slug' => 'tmb',
                'description' => 'tambah lagi oy', 'short_description' => 'tambah',
                'sku' => 'lg', 'price' => 230000.00, 'brand' => 'tmbh', 'colors' => 'Black',
                'created_at' => '2025-09-07 01:14:01', 'updated_at' => '2025-09-07 01:14:01',
            ]),
        ]);
    }

    private function seedProductCategories(): void
    {
        DB::table('product_categories')->insert([
            ['id' => 13, 'product_id' => 13, 'category_id' => 1, 'created_at' => null, 'updated_at' => null],
            ['id' => 14, 'product_id' => 14, 'category_id' => 1, 'created_at' => null, 'updated_at' => null],
            ['id' => 15, 'product_id' => 15, 'category_id' => 1, 'created_at' => null, 'updated_at' => null],
            ['id' => 16, 'product_id' => 16, 'category_id' => 1, 'created_at' => null, 'updated_at' => null],
            ['id' => 17, 'product_id' => 17, 'category_id' => 2, 'created_at' => null, 'updated_at' => null],
            ['id' => 18, 'product_id' => 18, 'category_id' => 1, 'created_at' => null, 'updated_at' => null],
        ]);
    }

    private function seedProductImages(): void
    {
        DB::table('product_images')->insert([
            [
                'id' => 9, 'product_id' => 13,
                'image_path' => 'products/GhA7gPgokzeH87WGp5X7oVKukYRxjimFQbkQkZAc.jpg',
                'alt_text' => 'sayanar Image 1', 'sort_order' => 0, 'is_primary' => true,
                'created_at' => '2025-08-28 05:20:50', 'updated_at' => '2025-08-28 05:20:50',
            ],
            [
                'id' => 10, 'product_id' => 14,
                'image_path' => 'products/SFMhJ5plYkXfF8iHuKwxJBTRWfnxoW16dDEdDFPl.jpg',
                'alt_text' => 'duyung Image 1', 'sort_order' => 0, 'is_primary' => true,
                'created_at' => '2025-08-29 00:51:31', 'updated_at' => '2025-08-29 00:51:31',
            ],
            [
                'id' => 11, 'product_id' => 15,
                'image_path' => 'products/tpgI0AnlJfszAjBHhYyLx4Wj1JdjlbFylI70QAZ8.jpg',
                'alt_text' => 'Kaos HP Image 1', 'sort_order' => 0, 'is_primary' => true,
                'created_at' => '2025-08-30 05:31:01', 'updated_at' => '2025-08-30 05:31:01',
            ],
            [
                'id' => 12, 'product_id' => 16,
                'image_path' => 'products/voWMywB5p56yBlwgB2Gn3eMGWJ2YJqn54xUdWadD.jpg',
                'alt_text' => 'xiaomi Image 1', 'sort_order' => 0, 'is_primary' => true,
                'created_at' => '2025-08-30 08:53:29', 'updated_at' => '2025-09-07 00:52:40',
            ],
            [
                'id' => 13, 'product_id' => 17,
                'image_path' => 'products/KHd1uAGhlt7OALgQUaVMroXltOQ6XyHQKI416Er0.png',
                'alt_text' => 'HoodieFlava Image 1', 'sort_order' => 0, 'is_primary' => true,
                'created_at' => '2025-09-07 01:02:39', 'updated_at' => '2025-09-07 01:16:30',
            ],
            [
                'id' => 14, 'product_id' => 18,
                'image_path' => 'products/LG6RKINxoJFIzAgal8o8xHCKRN1HYMHnUIFvzkcy.png',
                'alt_text' => 'Tambah lagi Image 1', 'sort_order' => 0, 'is_primary' => true,
                'created_at' => '2025-09-07 01:14:01', 'updated_at' => '2025-09-07 01:15:30',
            ],
        ]);
    }

    private function seedProductSizeVariants(): void
    {
        DB::table('product_size_variants')->insert([
            ['id' => 1, 'product_id' => 15, 'size' => 'M', 'stock_quantity' => 12, 'created_at' => '2025-08-30 05:31:01', 'updated_at' => '2025-09-04 04:35:39'],
            ['id' => 2, 'product_id' => 15, 'size' => 'L', 'stock_quantity' => 5, 'created_at' => '2025-08-30 05:31:01', 'updated_at' => '2025-09-05 23:43:55'],
            ['id' => 3, 'product_id' => 15, 'size' => 'S', 'stock_quantity' => 22, 'created_at' => '2025-08-30 05:31:01', 'updated_at' => '2025-09-06 01:14:59'],
            ['id' => 8, 'product_id' => 16, 'size' => 'L', 'stock_quantity' => 4, 'created_at' => '2025-09-07 00:52:40', 'updated_at' => '2025-09-07 00:52:40'],
            ['id' => 7, 'product_id' => 16, 'size' => 'M', 'stock_quantity' => 10, 'created_at' => '2025-09-07 00:52:40', 'updated_at' => '2025-09-07 00:52:40'],
            ['id' => 9, 'product_id' => 16, 'size' => 'S', 'stock_quantity' => 4, 'created_at' => '2025-09-07 00:52:40', 'updated_at' => '2025-09-07 00:52:40'],
            ['id' => 20, 'product_id' => 17, 'size' => 'L', 'stock_quantity' => 15, 'created_at' => '2025-09-07 01:16:30', 'updated_at' => '2025-09-07 01:16:30'],
            ['id' => 19, 'product_id' => 17, 'size' => 'M', 'stock_quantity' => 15, 'created_at' => '2025-09-07 01:16:30', 'updated_at' => '2025-09-07 01:16:30'],
            ['id' => 17, 'product_id' => 18, 'size' => 'L', 'stock_quantity' => 5, 'created_at' => '2025-09-07 01:15:30', 'updated_at' => '2025-09-07 01:15:30'],
            ['id' => 16, 'product_id' => 18, 'size' => 'M', 'stock_quantity' => 5, 'created_at' => '2025-09-07 01:15:30', 'updated_at' => '2025-09-07 01:15:30'],
            ['id' => 18, 'product_id' => 18, 'size' => 'S', 'stock_quantity' => 10, 'created_at' => '2025-09-07 01:15:30', 'updated_at' => '2025-09-07 01:15:30'],
            ['id' => 21, 'product_id' => 17, 'size' => 'S', 'stock_quantity' => 25, 'created_at' => '2025-09-07 01:16:30', 'updated_at' => '2025-09-07 01:16:30'],
        ]);
    }

    private function seedCarts(): void
    {
        DB::table('carts')->insert([
            ['id' => 1, 'user_id' => 3, 'session_id' => null, 'total_amount' => 0, 'total_items' => 0, 'total_qty' => 0, 'total_price' => 0, 'grand_total' => 0, 'expires_at' => null, 'created_at' => '2025-07-07 07:23:41', 'updated_at' => '2025-07-10 04:27:39'],
            ['id' => 3, 'user_id' => 6, 'session_id' => null, 'total_amount' => 460000, 'total_items' => 1, 'total_qty' => 2, 'total_price' => 460000, 'grand_total' => 460000, 'expires_at' => null, 'created_at' => '2025-07-10 04:59:57', 'updated_at' => '2025-09-06 02:29:07'],
            ['id' => 4, 'user_id' => 4, 'session_id' => null, 'total_amount' => 2393000, 'total_items' => 4, 'total_qty' => 13, 'total_price' => 2393000, 'grand_total' => 2393000, 'expires_at' => null, 'created_at' => '2025-07-19 19:21:35', 'updated_at' => '2025-07-19 21:54:00'],
            ['id' => 5, 'user_id' => 2, 'session_id' => null, 'total_amount' => 149000, 'total_items' => 1, 'total_qty' => 1, 'total_price' => 149000, 'grand_total' => 149000, 'expires_at' => null, 'created_at' => '2025-07-20 06:22:43', 'updated_at' => '2025-08-11 20:44:37'],
            ['id' => 6, 'user_id' => 7, 'session_id' => null, 'total_amount' => 57000, 'total_items' => 1, 'total_qty' => 1, 'total_price' => 57000, 'grand_total' => 57000, 'expires_at' => null, 'created_at' => '2025-08-05 19:32:28', 'updated_at' => '2025-08-10 22:37:52'],
        ]);
    }

    private function seedCartItems(): void
    {
        // CATATAN: cart_items id 29-32 & 61 mengacu ke product_id 3,4,5,6 yang
        // sudah TIDAK ADA lagi di tabel products (produk lama sudah terhapus
        // sebelum dump ini dibuat). Ini bawaan dari data asli, bukan error migrasi -
        // tidak ada FK constraint di tabel ini jadi tetap bisa masuk, tapi
        // tampilan keranjang untuk item itu kemungkinan akan kosong/error di frontend.
        DB::table('cart_items')->insert([
            ['id' => 29, 'cart_id' => 4, 'product_id' => 3, 'quantity' => 1, 'unit_price' => 249000, 'total_price' => 249000, 'product_options' => '[]', 'created_at' => '2025-07-19 19:22:54', 'updated_at' => '2025-07-19 19:22:54'],
            ['id' => 30, 'cart_id' => 4, 'product_id' => 4, 'quantity' => 4, 'unit_price' => 399000, 'total_price' => 1596000, 'product_options' => '[]', 'created_at' => '2025-07-19 20:02:13', 'updated_at' => '2025-07-19 21:51:42'],
            ['id' => 31, 'cart_id' => 4, 'product_id' => 6, 'quantity' => 7, 'unit_price' => 57000, 'total_price' => 399000, 'product_options' => '[]', 'created_at' => '2025-07-19 20:13:00', 'updated_at' => '2025-07-19 21:53:50'],
            ['id' => 32, 'cart_id' => 4, 'product_id' => 5, 'quantity' => 1, 'unit_price' => 149000, 'total_price' => 149000, 'product_options' => '[]', 'created_at' => '2025-07-19 21:54:00', 'updated_at' => '2025-07-19 21:54:00'],
            ['id' => 61, 'cart_id' => 6, 'product_id' => 6, 'quantity' => 1, 'unit_price' => 57000, 'total_price' => 57000, 'product_options' => '[]', 'created_at' => '2025-08-07 00:21:03', 'updated_at' => '2025-08-10 22:37:52'],
            ['id' => 62, 'cart_id' => 5, 'product_id' => 5, 'quantity' => 1, 'unit_price' => 149000, 'total_price' => 149000, 'product_options' => '[]', 'created_at' => '2025-08-11 20:44:37', 'updated_at' => '2025-08-11 20:44:37'],
            ['id' => 87, 'cart_id' => 3, 'product_id' => 15, 'quantity' => 2, 'unit_price' => 230000, 'total_price' => 460000, 'product_options' => '[{"name":"Ukuran","value":"M"}]', 'created_at' => '2025-09-06 02:28:56', 'updated_at' => '2025-09-06 02:29:07'],
        ]);
    }

    private function seedOrders(): void
    {
        $base = [
            'currency' => 'IDR', 'shipping_company' => null, 'shipping_address_line_2' => null,
            'shipping_country' => 'Indonesia', 'billing_company' => null, 'billing_address_line_2' => null,
            'billing_country' => 'Indonesia', 'notes' => null, 'tracking_number' => null,
            'shipped_at' => null, 'delivered_at' => null,
        ];

        DB::table('orders')->insert([
            array_merge($base, [
                'id' => 70, 'order_number' => 'ORD-XYOJQF0NSP', 'user_id' => 6, 'status' => 'cancelled',
                'payment_method' => 'midtrans', 'snap_token' => 'b30160cd-e0ae-4a0f-8a62-6096068580e8',
                'subtotal' => 460000, 'tax_amount' => 0, 'shipping_amount' => 25000, 'discount_amount' => 0, 'total_amount' => 485000,
                'shipping_first_name' => 'Admin', 'shipping_last_name' => 'Mutawali', 'shipping_address_line_1' => 'Tidar, Gasek',
                'shipping_city' => 'Kota Malang', 'shipping_state' => 'Jawa Timur', 'shipping_postal_code' => '65146', 'shipping_phone' => '085137113391',
                'billing_first_name' => 'Admin', 'billing_last_name' => 'Mutawali', 'billing_address_line_1' => 'Tidar, Gasek',
                'billing_city' => 'Kota Malang', 'billing_state' => 'Jawa Timur', 'billing_postal_code' => '65146', 'billing_phone' => '085137113391',
                'created_at' => '2025-09-02 17:19:49', 'updated_at' => '2025-09-05 23:43:55',
            ]),
            array_merge($base, [
                'id' => 71, 'order_number' => 'ORD-Q2UYJDQZP5', 'user_id' => 6, 'status' => 'pending',
                'payment_method' => 'midtrans', 'snap_token' => 'f24fe38d-d649-44a4-bbea-250dafa902fe',
                'subtotal' => 1900000, 'tax_amount' => 0, 'shipping_amount' => 25000, 'discount_amount' => 0, 'total_amount' => 1925000,
                'shipping_first_name' => 'Admin', 'shipping_last_name' => 'Mutawali', 'shipping_address_line_1' => 'Tidar, Gasek',
                'shipping_city' => 'Kota Malang', 'shipping_state' => 'Jawa Timur', 'shipping_postal_code' => '65146', 'shipping_phone' => '085137113391',
                'billing_first_name' => 'Admin', 'billing_last_name' => 'Mutawali', 'billing_address_line_1' => 'Tidar, Gasek',
                'billing_city' => 'Kota Malang', 'billing_state' => 'Jawa Timur', 'billing_postal_code' => '65146', 'billing_phone' => '085137113391',
                'created_at' => '2025-09-02 17:23:25', 'updated_at' => '2025-09-02 17:23:26',
            ]),
            array_merge($base, [
                'id' => 72, 'order_number' => 'ORD-DN8WWL4RTC', 'user_id' => 6, 'status' => 'pending',
                'payment_method' => 'midtrans', 'snap_token' => 'f03ac443-24a7-4b64-ad94-51b1c8ae3ded',
                'subtotal' => 230000, 'tax_amount' => 0, 'shipping_amount' => 25000, 'discount_amount' => 0, 'total_amount' => 255000,
                'shipping_first_name' => 'Admin', 'shipping_last_name' => 'Mutawali', 'shipping_address_line_1' => 'Tidar, Gasek',
                'shipping_city' => 'Kota Malang', 'shipping_state' => 'Jawa Timur', 'shipping_postal_code' => '65146', 'shipping_phone' => '085137113391',
                'billing_first_name' => 'Admin', 'billing_last_name' => 'Mutawali', 'billing_address_line_1' => 'Tidar, Gasek',
                'billing_city' => 'Kota Malang', 'billing_state' => 'Jawa Timur', 'billing_postal_code' => '65146', 'billing_phone' => '085137113391',
                'created_at' => '2025-09-03 08:42:06', 'updated_at' => '2025-09-03 08:42:07',
            ]),
            array_merge($base, [
                'id' => 73, 'order_number' => 'ORD-OJO3MUMZLZ', 'user_id' => 6, 'status' => 'pending',
                'payment_method' => 'midtrans', 'snap_token' => 'bd5373ed-21e0-4358-ad19-da4cb249d756',
                'subtotal' => 460000, 'tax_amount' => 0, 'shipping_amount' => 25000, 'discount_amount' => 0, 'total_amount' => 485000,
                'shipping_first_name' => 'Admin', 'shipping_last_name' => 'Mutawali', 'shipping_address_line_1' => 'kmklm[k',
                'shipping_city' => 'trhthrt', 'shipping_state' => 'DKI Jakarta', 'shipping_postal_code' => '54554', 'shipping_phone' => '085137113391',
                'billing_first_name' => 'Admin', 'billing_last_name' => 'Mutawali', 'billing_address_line_1' => 'kmklm[k',
                'billing_city' => 'trhthrt', 'billing_state' => 'DKI Jakarta', 'billing_postal_code' => '54554', 'billing_phone' => '085137113391',
                'created_at' => '2025-09-04 04:35:39', 'updated_at' => '2025-09-04 04:35:40',
            ]),
            array_merge($base, [
                'id' => 74, 'order_number' => 'ORD-ALOSKQNIIL', 'user_id' => 6, 'status' => 'pending',
                'payment_method' => 'midtrans', 'snap_token' => '3f2efcf1-9fb3-4da6-ad92-d35236c77a8e',
                'subtotal' => 460000, 'tax_amount' => 0, 'shipping_amount' => 61000, 'discount_amount' => 0, 'total_amount' => 521000,
                'shipping_first_name' => 'Admin', 'shipping_last_name' => 'Mutawali', 'shipping_address_line_1' => 'jalan sudewo',
                'shipping_city' => '', 'shipping_state' => '', 'shipping_postal_code' => '1239', 'shipping_phone' => '085137113391',
                'billing_first_name' => 'Admin', 'billing_last_name' => 'Mutawali', 'billing_address_line_1' => 'jalan sudewo',
                'billing_city' => '', 'billing_state' => '', 'billing_postal_code' => '1239', 'billing_phone' => '085137113391',
                'created_at' => '2025-09-06 01:14:59', 'updated_at' => '2025-09-06 01:15:00',
            ]),
        ]);
    }

    private function seedOrderItems(): void
    {
        DB::table('order_items')->insert([
            ['id' => 69, 'order_id' => 70, 'product_id' => 15, 'product_name' => 'Kaos HP', 'product_sku' => 'vcts', 'quantity' => 1, 'unit_price' => 230000, 'total_price' => 230000, 'product_options' => '{"Ukuran":"L"}', 'created_at' => '2025-09-02 17:19:49', 'updated_at' => '2025-09-02 17:19:49'],
            ['id' => 70, 'order_id' => 70, 'product_id' => 15, 'product_name' => 'Kaos HP', 'product_sku' => 'vcts', 'quantity' => 1, 'unit_price' => 230000, 'total_price' => 230000, 'product_options' => '{"Ukuran":"L"}', 'created_at' => '2025-09-02 17:19:49', 'updated_at' => '2025-09-02 17:19:49'],
            ['id' => 71, 'order_id' => 71, 'product_id' => 16, 'product_name' => 'xiaomi', 'product_sku' => 'rdmi', 'quantity' => 1, 'unit_price' => 1900000, 'total_price' => 1900000, 'product_options' => '{"Ukuran":"XL"}', 'created_at' => '2025-09-02 17:23:25', 'updated_at' => '2025-09-02 17:23:25'],
            ['id' => 72, 'order_id' => 72, 'product_id' => 15, 'product_name' => 'Kaos HP', 'product_sku' => 'vcts', 'quantity' => 1, 'unit_price' => 230000, 'total_price' => 230000, 'product_options' => '{"Ukuran":"M"}', 'created_at' => '2025-09-03 08:42:06', 'updated_at' => '2025-09-03 08:42:06'],
            ['id' => 73, 'order_id' => 73, 'product_id' => 15, 'product_name' => 'Kaos HP', 'product_sku' => 'vcts', 'quantity' => 1, 'unit_price' => 230000, 'total_price' => 230000, 'product_options' => '{"Ukuran":"M"}', 'created_at' => '2025-09-04 04:35:39', 'updated_at' => '2025-09-04 04:35:39'],
            ['id' => 74, 'order_id' => 73, 'product_id' => 15, 'product_name' => 'Kaos HP', 'product_sku' => 'vcts', 'quantity' => 1, 'unit_price' => 230000, 'total_price' => 230000, 'product_options' => '{"Ukuran":"XL"}', 'created_at' => '2025-09-04 04:35:39', 'updated_at' => '2025-09-04 04:35:39'],
            ['id' => 75, 'order_id' => 74, 'product_id' => 15, 'product_name' => 'Kaos HP', 'product_sku' => 'vcts', 'quantity' => 2, 'unit_price' => 230000, 'total_price' => 460000, 'product_options' => '{"Ukuran":"XL"}', 'created_at' => '2025-09-06 01:14:59', 'updated_at' => '2025-09-06 01:14:59'],
        ]);
    }
}