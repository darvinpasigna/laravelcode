<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create("customers", function (Blueprint $table) {
        $table->id(); 
        $table->integer("custom_id")->unique();
        $table->string("fname");
        $table->string("lname");
        $table->string("contact");
        $table->string("email")->unique();
        $table->string("password");
        $table->string("address");
        $table->string("city");
        $table->string("province");
        $table->string("zipcode");
        $table->string("image")->nullable();
        $table->timestamps();  // Automatically creates 'created_at' and 'updated_at' columns

    });

    Schema::create("products", function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger("customer_id")->nullable();
        $table->string("prod_category");
        $table->string("prod_name");
        $table->string("price");
        $table->string("desc");
        $table->string("stock");
        $table->text("main_img");
        $table->text("img1");
        $table->text("img2");
        $table->text("img3");
        $table->timestamps();

        // Define the foreign key relationship
        $table->foreign("customer_id")->references("id")->on("customers")->onDelete("set null");
    });

    Schema::create('cart_items', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('customer_id')->nullable();
        $table->string('prod_name');
        $table->string("desc");
        $table->string('price_per_item');
        $table->text('main_img');
        $table->timestamps();

        // Define the foreign key relationship
        $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
    });

    
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('customer_id')->nullable();
        $table->string('prod_name');
        $table->string("desc");
        $table->string('quantity');
        $table->string('price_per_item');
        $table->string('total_price');
        $table->string("mode_of_payment");
        $table->text('main_img');
        $table->timestamps();

        // Define the foreign key relationship
        $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
    });

        //
        Schema::create('shipment_tbl', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('customer_id')->nullable();
        $table->string('prod_name');
        $table->string("desc");
        $table->string('quantity');
        $table->string('price');
        $table->string('status');
        $table->string('delivery_date');
        $table->string('total_price');
        $table->text('main_img');
        $table->timestamps();

        // Define the foreign key relationship
        $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_tbl');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('products');
        Schema::dropIfExists('customers');
    }
};
