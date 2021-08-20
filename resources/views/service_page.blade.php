@extends('front_layout')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/service_page.css')  }}">
    @include('slider')


    @if($service->serviceBlock)
    <div class="promotes">
        <div class="center">
            <h3 class="title">{{ $service->serviceBlock->title  }}</h3>
        </div>

        <?php
        $promotes = $service->serviceBlock->serviceBlock__Block;
        ?>

        <div class="promotes__blockCont">
            @foreach($promotes as $promo)
                <div class="promotes__block promoteBlock">
                    <div class="promoteBlock__header">{{ $promo["header_text"] }}</div>
                    <div class="promoteBlock__text"><?php echo $promo["text"];  ?></div>
                    <div class="promoteBlock__footer">
                        <div class="promoteBlock__price">{{ $promo["price"]  }} грн.</div>
                        <div class="promoteBlock__priceInfo">{{ $promo["price_info"]  }} грн.</div>
                        <div>
                            <button class="promoteBlock__orderButton orderButton">Заказать</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    @endif

    <?php
        $show_features = true;
    ?>

    @if($show_features)
        @include('our_features')
    @endif


    <section class="article">
        <div class="">
            <div class="article__header">{{ $service->category_name }}</div>
        </div>

        <article>
            <?php echo $service->text; ?>
        </article>
    </section>

    @if($service->ServiceFaqUnswers && count($service->ServiceFaqUnswers))
    <section class="over faq">
        <div class="faq__header header__text">Выберите интересующий вопрос</div>

        <div class="sliderRow faqCont">
            <div class="sliderRow__menuCont">
                @foreach($service->ServiceFaqUnswers as $key => $data)
                    <div class="sliderRow__menu
                    {{ $key === 0 ? 'sliderRow__menu--active' : "" }}"
                         data-key="{{ $key }}"
                    >{{ $data["title"] }}</div>
                @endforeach
            </div>
            <div class="sliderRow__slideCont">
                @foreach($service->ServiceFaqUnswers as $key => $data)
                    <div class="sliderRow__slide {{ $key === 0 ? 'sliderRow__slide--active' : '' }}"
                         data-slide-key="{{ $key }}">
                        <div class="sliderRow__slideTextCont">
                            <div class="sliderRow__slideText"><?php echo $data["text"]; ?></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if(isset($service->serviceTables))
        <section class="over table__cont        ">
            <div class="table__header header__text">Прайс лист</div>
            <div class="sliderRow faqCont">
                <div class="sliderRow__menuCont">
                    @foreach($service->serviceTables as $key => $data)
                        <div class="sliderRow__menu
                    {{ $key === 0 ? 'sliderRow__menu--active' : "" }}"
                             data-key="{{ $key }}"
                        >{{ $data["title"] }}</div>
                    @endforeach
                </div>

                <div class="sliderRow__slideCont">
                    @foreach($service->serviceTables as $key => $table)
                        <div class="sliderRow__slide {{ $key === 0 ? 'sliderRow__slide--active' : '' }}"
                             data-slide-key="{{ $key }}">
                            <table class="table">
                                <?php
                                    $rowData = json_decode($table->data, true);
                                ?>
                                @foreach($rowData["rows"] as $row)
                                    <tr>

                                        <br>
                                            <br>
                                        @foreach($row as $td)
                                            <td colspan="{{ isset($td["colspan"]) ? $td["colspan"] : 1 }}">
                                                {{$td["text"]}}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


@endsection

