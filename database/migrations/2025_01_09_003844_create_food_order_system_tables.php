<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodOrderSystemTables extends Migration
{
    public function up()
    {
        // Tạo bảng users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['customer', 'employee', 'admin'])->default('customer');
            $table->timestamps();
        });

        // Tạo bảng categories (Danh mục)
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Tạo bảng foods (Món ăn)
        Schema::create('foods', function (Blueprint $table) {
            $table->id(); // Đây là kiểu `unsignedBigInteger` mặc định trong Laravel
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('image')->nullable();
            $table->timestamps();
        });
        

        // Tạo bảng customers (Khách hàng)
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('phone');
            $table->text('address');
            $table->timestamps();
        });

        // Tạo bảng employees (Nhân viên)
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('position');
            $table->timestamps();
        });

         // Tạo bảng discounts (Giảm giá)
         Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('percentage', 5, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        }); 
        // Tạo bảng orders (Đơn hàng)
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('total_price', 10, 2);
            $table->foreignId('discount_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('status', ['pending', 'processed', 'shipped', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });

        // Tạo bảng order_details (Chi tiết đơn hàng)
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade'); // Sửa lại cột này
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        // Tạo bảng carts (Giỏ hàng)
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Tạo bảng cart_details (Chi tiết giỏ hàng)
        Schema::create('cart_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade'); // Đảm bảo tên bảng 'foods' đúng
            $table->integer('quantity');
            $table->timestamps();
        });
        

        // Tạo bảng invoices (Hóa đơn)
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 10, 2);
            $table->enum('payment_method', ['cash', 'card', 'online'])->default('cash');
            $table->timestamps();
        });

       

        // Tạo bảng payment_methods (Phương thức thanh toán)
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Tạo bảng order_statuses (Trạng thái đơn hàng)
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Tạo bảng shipping_addresses (Địa chỉ giao hàng)
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->text('address');
            $table->timestamps();
        });
    }

    public function down()
    {
        // Xóa bảng theo thứ tự để không gây lỗi khóa ngoại
        Schema::dropIfExists('shipping_addresses');
        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('discounts');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('cart_details');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('foods');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('users');
    }
}
