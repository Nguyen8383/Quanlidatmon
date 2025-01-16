<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Seeder cho bảng users
        foreach (range(1, 10) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Dùng password mặc định
                'role' => $faker->randomElement(['customer', 'employee', 'admin']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seeder cho bảng categories
        foreach (range(1, 5) as $index) {
            DB::table('categories')->insert([
                'name' => $faker->word,
                'description' => $faker->text,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seeder cho bảng foods
        $categories = DB::table('categories')->pluck('id');
        foreach (range(1, 20) as $index) {
            DB::table('foods')->insert([
                'name' => $faker->word,
                'description' => $faker->text,
                'price' => $faker->randomFloat(2, 10, 100),
                'category_id' => $faker->randomElement($categories),
                'image' => $faker->imageUrl(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seeder cho bảng customers
        $users = DB::table('users')->where('role', 'customer')->pluck('id');
        foreach ($users as $userId) {
            DB::table('customers')->insert([
                'user_id' => $userId,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seeder cho bảng employees
        $users = DB::table('users')->where('role', 'employee')->pluck('id');
        foreach ($users as $userId) {
            DB::table('employees')->insert([
                'user_id' => $userId,
                'position' => $faker->jobTitle,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seeder cho bảng discounts
        foreach (range(1, 5) as $index) {
            DB::table('discounts')->insert([
                'code' => $faker->word,
                'percentage' => $faker->randomFloat(2, 5, 30),
                'start_date' => Carbon::today()->toDateString(),
                'end_date' => Carbon::today()->addDays(30)->toDateString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seeder cho bảng orders
        $customers = DB::table('customers')->pluck('id');
        $employees = DB::table('employees')->pluck('id');
        $discounts = DB::table('discounts')->pluck('id');
        foreach (range(1, 15) as $index) {
            DB::table('orders')->insert([
                'customer_id' => $faker->randomElement($customers),
                'employee_id' => $faker->randomElement($employees),
                'total_price' => $faker->randomFloat(2, 50, 200),
                'discount_id' => $faker->randomElement($discounts),
                'status' => $faker->randomElement(['pending', 'processed', 'shipped', 'completed', 'cancelled']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seeder cho bảng order_details
        $orders = DB::table('orders')->pluck('id');
        $foods = DB::table('foods')->pluck('id');
        foreach (range(1, 50) as $index) {
            DB::table('order_details')->insert([
                'order_id' => $faker->randomElement($orders),
                'food_id' => $faker->randomElement($foods),
                'quantity' => $faker->numberBetween(1, 5),
                'price' => $faker->randomFloat(2, 10, 100),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seeder cho bảng carts
        foreach ($customers as $customerId) {
            DB::table('carts')->insert([
                'customer_id' => $customerId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seeder cho bảng cart_details
        $carts = DB::table('carts')->pluck('id');
        foreach (range(1, 100) as $index) {
            DB::table('cart_details')->insert([
                'cart_id' => $faker->randomElement($carts),
                'food_id' => $faker->randomElement($foods),
                'quantity' => $faker->numberBetween(1, 5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seeder cho bảng invoices
        $orders = DB::table('orders')->pluck('id');
        foreach ($orders as $orderId) {
            DB::table('invoices')->insert([
                'order_id' => $orderId,
                'total_price' => $faker->randomFloat(2, 50, 200),
                'payment_method' => $faker->randomElement(['cash', 'card', 'online']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seeder cho bảng payment_methods
        foreach (range(1, 3) as $index) {
            DB::table('payment_methods')->insert([
                'name' => $faker->word,
                'description' => $faker->text,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seeder cho bảng order_statuses
        foreach (range(1, 5) as $index) {
            DB::table('order_statuses')->insert([
                'name' => $faker->word,
                'description' => $faker->text,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seeder cho bảng shipping_addresses
        foreach ($customers as $customerId) {
            DB::table('shipping_addresses')->insert([
                'customer_id' => $customerId,
                'address' => $faker->address,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
