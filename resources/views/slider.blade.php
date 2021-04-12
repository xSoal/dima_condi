<?php

use App\Http\Controllers\Controller as Controller;

//echo $slider_data;


$slider_data = $service->slider;

$slider_json_data = json_decode($slider_data->json_data);
$images_data = [];
foreach ($slider_json_data as $data) {
    $images_data[] = [
        "image_small" => $data->image_small,
        "image" => $data->image
    ];
}

//dd($slider_json_data);

?>

<div class="slider">
    <script type="application/json"
            id="slider_images_data"><?php echo json_encode($images_data, JSON_UNESCAPED_UNICODE); ?></script>
    <div class="slider__titleCont">
        <h1 class="slider__title title">{{ $slider_data->title  }}</h1>
    </div>

    <div class="slide__overflow "></div>

    <div class="slider__content">
        <div class="slider__menuCont">
            @foreach($slider_json_data as $key => $data)
                <button class="slider__menuButton
                    {{ $key === 0 ? 'slider__menuButton-active' : ''  }} "
                        data-image-url="{{$data->image}}"
                >
                    {{$data->title_left}}
                </button>
            @endforeach
            <div class="slider__menuBottom">

            </div>
        </div>


        @foreach( json_decode($slider_data->json_data) as $key => $data)

            <div class="slide {{ $key === 0 ? 'slide-show' : ''  }} " >
                <div class="slide__textHeader">
                    {{ $data->title_right  }}
                </div>
                <div class="slide__textCont">

                    <div class="slide__text">
                        <?php echo $data->text; ?>
                    </div>

                </div>
                <button class="slide__orderButton orderButton ">Заказать осблуживание</button>
                <div class="slide__bottom">
                    <div class="slide__bottomRow">
                        <div class="slide__bottomLastPrice">{{ $data->last_price }} грн</div>
                    </div>
                    <div class="slide__bottomRow">
                        <div class="slide__bottomPrice">{{ $data->price  }} грн *</div>
                        <div class="slide__bottomComment">
                            * -- Стоимость по акции за один кондиционер
                        </div>
                    </div>
                </div>
            </div>

        @endforeach


    </div>


</div>

