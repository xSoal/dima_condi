<header class="header">

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
                    <img src="{{ asset('images/logo_new.png')  }}" alt="Logotype">
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
                                <li>
                                    <span>Сервис бытовых кондиционеров</span>
                                    <ul>
                                        <li><a href="#">Чистка кондиционеров</a></li>
                                        <li><a href="#">Ремонт кондиционеров</a></li>
                                        <li><a href="#">Установка кондиционеров</a></li>
                                        <li><a href="#">Заправка кондиционеров</a></li>
                                        <li><a href="#">Профилактика кондиционеров</a></li>
                                        <li><a href="#">Диагностика кондиционеров</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <span>Сервис систем кондиционирования</span>
                                    <ul>
                                        <li><a href="#">Услуги по системам кондиционирования</a></li>
                                        <li><a href="#">Услуги по чиллерам</a></li>
                                        <li><a href="#">Услуги по фанкойлам</a></li>
                                        <li><a href="#">Услуги по VRF-VRV системам</a></li>
                                        <li><a href="#">Услуги по прецизионным кондиционерам</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <span>Сервис вентиляционных систем</span>
                                    <ul>
                                        <li><a href="#">Услуги по вентиляции</a></li>
                                        <li><a href="#">Монтаж вентиляции</a></li>
                                        <li><a href="#">Услуги по приточно вытяжным установкам</a></li>
                                    </ul>
                                </li>
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
                    <button class="orderButton modalTrigger" data-modal="getCall">
                        Заказать звонок
                    </button>
                </div>
            </div>
        </div>


    </div>

</header>
