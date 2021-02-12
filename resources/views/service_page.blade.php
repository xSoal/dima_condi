@extends('front_layout')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/service_page.css')  }}">
    @include('slider')

    <div class="promotes">
        <div class="center">
            <h3 class="title">Большие скидки за обьем</h3>
        </div>

        <?php
        $promotes = [
            [
                "count" => "1",
                "text"  => "Профессиональное обслуживание, включая антибактериальную обработку кондиционера",
                "price" => 2000
            ],
            [
                "count" => "2-4",
                "text"  => "Профессиональное обслуживание, включая антибактериальную обработку кондиционера",
                "price" => 1800
            ],
            [
                "count" => "5-9",
                "text"  => "Профессиональное обслуживание, включая антибактериальную обработку кондиционера",
                "price" => 1600
            ],
            [
                "count" => "от 10",
                "text"  => "Профессиональное обслуживание, включая антибактериальную обработку кондиционера",
                "price" => 1400
            ]
        ];
        ?>

        <div class="promotes__blockCont">
            @foreach($promotes as $promo)
                <div class="promotes__block promoteBlock">
                    <div class="promoteBlock__header">{{ $promo["count"] }} ед.</div>
                    <div class="promoteBlock__text">{{ $promo["text"]  }}</div>
                    <div class="promoteBlock__footer">
                        <div class="promoteBlock__price">{{ $promo["price"]  }} грн.</div>
                        <div class="promoteBlock__priceInfo">за 1 кондиционер</div>
                        <div>
                            <button class="promoteBlock__orderButton orderButton">Заказать</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>


    <?php
        $show_features = true;
    ?>

    @if($show_features)
        @include('our_features')
    @endif


    <div class="article">
        <?php
            $page_title = "Обсжуживание";
        ?>

        <div class="">
            <div class="article__header">{{ $page_title }}</div>
        </div>

        <article>

        </article>

    </div>


@endsection
