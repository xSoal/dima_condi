@if ($features)
    <div class="features">
        <?php
//        $sliderRowData = [
//            [
//                "title" => "Оборудование",
//                "text" => "<ul> <li>Уникальная теххнология по очистке кондиционеров</li> <li>Ликвидация запахов</li> <li>Уничтожение микробов на 99%</li> </ul>",
//                "image_url" => "/images/sliderRow/our_features/1.png"
//            ],
//            [
//                "title" => "Оборудование",
//                "text" => "<ul> <li>Уникальная теххнология по очистке кондиционеров</li> <li>Ликвидация запахов</li> <li>Уничтожение микробов на 99%</li> </ul>",
//                "image_url" => "/images/sliderRow/our_features/1.png"
//            ],
//            [
//                "title" => "Оборудование",
//                "text" => "<ul> <li>Уникальная теххнология по очистке кондиционеров</li> <li>Ликвидация запахов</li> <li>Уничтожение микробов на 99%</li> </ul>",
//                "image_url" => "/images/sliderRow/our_features/1.png"
//            ],
//            [
//                "title" => "Оборудование",
//                "text" => "<ul> <li>Уникальная теххнология по очистке кондиционеров</li> <li>Ликвидация запахов</li> <li>Уничтожение микробов на 99%</li> </ul>",
//                "image_url" => "/images/sliderRow/our_features/1.png"
//            ]
//        ];


        $sliderRowData = $features;
        ?>
        <div class="features__sliderRow sliderRow">
            <div class="center">
                <h5 class="title">Наши приемущества</h5>
            </div>
            <div class="sliderRow__menuCont">
                @foreach($sliderRowData as $key => $data)
                    <div class="sliderRow__menu
                    {{ $key === 0 ? 'sliderRow__menu--active' : "" }}"
                         data-key="{{ $key }}"
                    >{{ $data["title"] }}</div>
                @endforeach
            </div>
            <div class="sliderRow__slideCont">
                @foreach($sliderRowData as $key => $data)
                    <div class="sliderRow__slide {{ $key === 0 ? 'sliderRow__slide--active' : '' }}"
                         data-slide-key="{{ $key }}">
                        <div class="sliderRow__slideImageCont">
                            <img src="{{ $data["image_url"]  }}" alt="{{$data["title"]}}" class="sliderRow__slideImage">
                        </div>
                        <div class="sliderRow__slideTextCont">
                            <div class="sliderRow__slideText"><?php echo $data["text"]; ?></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
