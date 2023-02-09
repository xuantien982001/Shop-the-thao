<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaiVietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bai_viets')->delete();
        DB::table('bai_viets')->truncate();
        DB::table('bai_viets')->insert([
            ['tieu_de'=> 'Bộ đệm Lunarlon của Nike nổi tiếng trong làng thể thao',
            'chuyenmuc_id'=>1,
            'noi_dung' => 'Nếu như bạn là một fan hâm mộ lâu năm của bộ môn Futsal thì có lẽ sẽ không thể không biết đến đôi giày Nike Lunar Gato huyền thoại. Đôi Lunar Gato được rất nhiều cầu thủ Futsal chuyên nghiệp lựa chọn bởi sự êm ái của bộ đệm đế Lunarlon huyền thoại. Lunarlon được đánh giá là bộ đệm êm ái và nhẹ nhất vào những năm nó vừa mới ra mắt.',
            'hinh_anh' => 'https://shopgiaythethaogiare.com/wp-content/uploads/2019/03/cong-nghe-lunarlon-voi-nhung-phan-ung-tuyet-voi-3-818x400.jpg',
            'admin_id' => 1,
            ],




        ]);
    }
}
