<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slideDataFirst = [
            "home_page" => [
                "title" => "Обслуживание кондиционеров",
                "json_data" => [
                    [
                        "title_left" => "Настенный",
                        "title_right" => "Обслуживание настенных кондиционеров",
                        "text" => "
                             Для эффективной работы настенных кондиционеров им требуется <br>
                             регулярное обслуживание. Если пренебрегать этим сервисом, <br>
                             сплит-система в любой момент может выйти из строя. Поэтому, <br>
                             сэкономив на обслуживание единожды, вы рискуете потратить еще <br>
                             больше денег на покупку нового кондиционера. Не радует перспектива? <br>
                             <br>
                             Тогда воспользуйтесь услугой профессионального обслуживания <br>
                             настенных кондиционеров от компании Leon Group. Наши мастера <br>
                             оказывают комплексные услуги и осуществляют весь спектр работ, <br>
                             гарантируя безупречный сервис и высокий профессионализм. <br>
                             Обратившись в Leon Group, вы будете уверены, что ваша климатическая <br>
                         ",
                        "image_small" => "/images/slider/home_page/1_small.jpg",
                        "image" => "images/slider/home_page/1.jpg",
                        "last_price" => 3000,
                        "price" => 2500
                    ],
                    [
                        "title_left" => "Потолочный",
                        "title_right" => "Обслуживание напольно-потолочных кондиционеров",
                        "text" => "
                         Обслуживание напольно-потолочных кондиционеров – это комплексные <br>
                         мероприятия, включающие в себя чистку, дезинфекцию и <br>
                         обработку деталей, диагностику отдельных систем оборудования, <br>
                         замену и ремонт элементов.
                         Заказать профессиональное обслуживание напольно-потолочных <br>
                         кондиционеров вы сможете у специалистов компании Leon Group. <br>
                         Наша команда – это мастера с большим опытом работы и <br>
                         навыками обслуживания климатической техники любого типа. <br>
                         Высокая квалификация специалистов и использование современного <br>
                         оборудования и спецсредств позволяют нам выполнять весь спектр<br>
                         работ на наивысшем уровне!
                         ",
                        "image_small" => "/images/slider/home_page/2_small.jpg",
                        "image" => "images/slider/home_page/2.jpg",
                        "last_price" => 3000,
                        "price" => 2500
                    ],

                ],
            ],
        ];

        foreach ($slideDataFirst as $route_name => $slide_data){
            DB::table('sliders')->insert([
                'route_name' => $route_name,
                'title' => $slide_data["title"],
                'json_data' => json_encode( $slide_data["json_data"]  , JSON_UNESCAPED_UNICODE),
            ]);
        }



    }
}
