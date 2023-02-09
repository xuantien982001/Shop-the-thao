<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ma_san_pham');
            $table->string('ten_san_pham');
            $table->string('slug_san_pham');
            $table->string('ma_danh_muc_id');
            $table->double('gia', 18, 0);
            $table->double('gia_khuyen_mai', 18, 0)->default(0);
            $table->integer('so_luong')->default(0);
            $table->longText('hinh_anh_chinh');
            $table->longText('hinh_anh_phu');
            $table->longText('chi_tiet');
            $table->integer('is_open')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('san_phams');
    }
};
