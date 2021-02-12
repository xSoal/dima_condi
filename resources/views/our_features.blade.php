

<div class="features">

    <?php
        $sliderRowData = [
            "title" => "Наши приемущества",
            "data" => [
                [
                    "title" => "Оборудование",
                    "textTitle" => "Профессиональное оборудование",
                    "textHtml" => "<ul> <li>Уникальная теххнология по очистке кондиционеров</li> <li>Ликвидация запахов</li> <li>Уничтожение микробов на 99%</li> </ul>",
                    "image" => "/images/sliderRow/our_features/1.png"
                ],
                [
                    "title" => "Оборудование",
                    "textTitle" => "Профессиональное оборудование 2",
                    "textHtml" => "<ul> <li>Уникальная теххнология по очистке кондиционеров</li> <li>Ликвидация запахов</li> <li>Уничтожение микробов на 99%</li> </ul>",
                    "image" => "/images/sliderRow/our_features/1.png"
                ],
                [
                    "title" => "Оборудование",
                    "textTitle" => "Профессиональное оборудование 3",
                    "textHtml" => "<ul> <li>Уникальная теххнология по очистке кондиционеров</li> <li>Ликвидация запахов</li> <li>Уничтожение микробов на 99%</li> </ul>",
                    "image" => "/images/sliderRow/our_features/1.png"
                ],
                [
                    "title" => "Оборудование",
                    "textTitle" => "Профессиональное оборудование 4",
                    "textHtml" => "<ul> <li>Уникальная теххнология по очистке кондиционеров</li> <li>Ликвидация запахов</li> <li>Уничтожение микробов на 99%</li> </ul>",
                    "image" => "/images/sliderRow/our_features/1.png"
                ]
            ]
        ];
    ?>
    <div class="features__sliderRow sliderRow">
        <div class="center">
            <h5 class="title">{{ $sliderRowData["title"]  }}</h5>
        </div>
        <div class="sliderRow__menuCont">
            @foreach($sliderRowData["data"] as $key => $data)
                <div class="sliderRow__menu
                    {{ $key === 0 ? 'sliderRow__menu--active' : "" }}"
                    data-key="{{ $key }}"
                >{{ $data["title"] }}</div>
            @endforeach
        </div>
        <div class="sliderRow__slideCont">
            @foreach($sliderRowData["data"] as $key => $data)
                <div class="sliderRow__slide {{ $key === 0 ? 'sliderRow__slide--active' : '' }}" data-slide-key="{{ $key }}">
                    <div class="sliderRow__slideImageCont">
                        <img src="{{ $data["image"]  }}" alt="{{$data["title"]}}" class="sliderRow__slideImage">
                    </div>
                    <div class="sliderRow__slideTextCont">
                        <div class="sliderRow__slideTextTitle">{{ $data["textTitle"]  }}</div>
                        <div class="sliderRow__slideText"><?php echo $data["textHtml"]; ?></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
