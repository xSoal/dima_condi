<header class="header">

    @php
        $header_data =  App\Http\Controllers\PageController::getHeader();
    @endphp



    <div class="header__row header__row--first">
        <div class="contactHeader">
            <div class="contactHeader__icon">
                <i class="material-icons">email</i>
            </div>
            <div class="contactHeader__text">
                <a href="mailto:qwe@qwe.qwe">
                    qwe@qwe.qwe
                </a>
            </div>
        </div>

        <div class="contactHeader">
            <div class="contactHeader__icon">
                <i class="material-icons">phone</i>
            </div>
            <div class="contactHeader__text">
                <a href="tel:380931231212">380931231212</a>
            </div>
        </div>

    </div>


    <div class="header__row header__row--second">
        <div class="headerNav">
            <div class="headerNav__left">

                <div class="headerNav__logo">
                    <a href="/">
                        <img src="{{ asset('images/logo_new.png')  }}" alt="Logotype">
                    </a>
                </div>

                <nav class="">
                    <ul class="headerNav__menu menu">
                        <li class="menu__first">
                            <span>Компания</span>
                            <ul class="menu__firstUl">
                                <li><a href="#">О компании</a></li>
                            </ul>
                        </li>
                        <li class="menu__first">
                            <span>Услуги</span>
                            <ul class="menu__firstUl menu__firstUl--withSub">
                            @foreach($header_data as $serviceCategory)
                                <li>
                                    <span>{{$serviceCategory->category_name}}</span>
                                    <ul>
                                        @foreach($serviceCategory->services as $service)
                                            <li><a href="/{{$service->slug}}">{{$service->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            </ul>

                        </li>
                        <li class="menu__first">
                            <span>Стоимость</span>
                            <ul class="menu__firstUl">
                                <li><a href="#">Цены на услуги</a></li>
                                <li><a href="#">Оплата</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="headerNav__right">
                <div>
                    <button class="orderButton modalTrigger" data-modal="modal-getCall">
                        Заказать звонок
                    </button>
                </div>
            </div>
        </div>


    </div>

</header>
