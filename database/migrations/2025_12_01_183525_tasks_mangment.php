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
        Schema::create("Cities", function (Blueprint $table){
            $table->bigIncrements("cityId");
            $table->string("cityName");
            $table->decimal("deliveryFees");
            $table->timestamps();
        });

        Schema::create("Address" , function (Blueprint $table){
            $table->bigIncrements("addressId");
            $table->string("street");
            $table->unsignedBigInteger("cityId");
            $table->timestamps();   

            $table->foreign("cityId")->references("cityId")->on("Cities");
        });

        Schema::create("Users", function (Blueprint $table) {
            $table->bigIncrements("UserId");
            $table->string("FullName");
            $table->string("Email");
            $table->string("Phone");
            $table->string("Role");
            $table->string("Password");
            $table->unsignedBigInteger("cityId")->nullable();
            $table->unsignedBigInteger("addressId")->nullable();
            $table->string("street")->nullable();
            $table->timestamps();

            $table->foreign("cityId")->references("cityId")->on("Cities");
            $table->foreign("addressId")->references("addressId")->on("Address");
        });

        Schema::create("Categories" , function (Blueprint $table){
            $table->bigIncrements("CategoryId");
            $table->string("CategoryName");
            $table->timestamps();   
        });

        Schema::create("ChildCategories" , function (Blueprint $table){
            $table->bigIncrements("CategoryId");
            $table->unsignedBigInteger("ParentCategoryId");
            $table->string("CategoryName");
            $table->timestamps();   

            $table->foreign("ParentCategoryId")->references("CategoryId")->on("Categories");
        });

        Schema::create("Item" , function(Blueprint $table){
            $table->bigIncrements("ItemId");
            $table->string("ItemName");
            $table->text("ItemDescription");
            $table->decimal("ItemPrice");
            $table->string("ItemColor");
            $table->unsignedBigInteger("CategoryId");
            $table->unsignedBigInteger("ChildCategoryId")->nullable();
            $table->timestamps();   

            $table->foreign("CategoryId")->references("CategoryId")->on("Categories");
            $table->foreign("ChildCategoryId")->references("CategoryId")->on("ChildCategories");
        });
        
        Schema::create("ItemInformation" , function(Blueprint $table){
            $table->bigIncrements("InfoId");
            $table->unsignedBigInteger("ItemId");
            $table->integer("Size");
            $table->integer("Quantity");
            $table->timestamps();   

            $table->foreign("ItemId")->references("ItemId")->on("Item");
        });

        Schema::create("ItemPhotos" , function (Blueprint $table){
            $table->bigIncrements("PhotoId");
            $table->unsignedBigInteger( "ItemId");
            $table->string("PhotoUrl");
            $table->timestamps();   

            $table->foreign("ItemId")->references(columns: "ItemId")->on("Item");
        });

        Schema::create("Order", function (Blueprint $table){
            $table->bigIncrements("OrderId");
            $table->unsignedBigInteger("UserId")->nullable();
            $table->unsignedBigInteger("ItemId");
            $table->string("FullName",100)->nullable();
            $table->string("Phone",15)->nullable();
            $table->string("Email",100)->nullable();
            $table->unsignedBigInteger("cityId")->nullable();
            $table->unsignedBigInteger("addressId")->nullable();
            $table->string("street")->nullable();
            $table->dateTime("OrderDate");
            $table->decimal("PriceDelevery");
            $table->decimal("ProductPrice", 10, 2);
            $table->decimal("TotalAmount", 10, 2);
            $table->string("Status");
            $table->string("Note")->nullable();
            $table->timestamps();

            $table->foreign("UserId")->references("UserId")->on("Users");
            $table->foreign("ItemId")->references("ItemId")->on("Item");
            $table->foreign("cityId")->references("cityId")->on("Cities");
            $table->foreign("addressId")->references("addressId")->on("Address");
        });

        Schema::create("OrderList", function (Blueprint $table) {
            $table->bigIncrements("OrderListId");
            $table->unsignedBigInteger("OrderId");
            $table->unsignedBigInteger("ItemId");
            $table->integer("Quantity");
            $table->decimal("ItemPrice", 10, 2);
            $table->integer("Size");
            $table->timestamps();
    
            $table->foreign("OrderId")->references("OrderId")->on("Order");
            $table->foreign("ItemId")->references("ItemId")->on("Item");
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
