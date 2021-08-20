const slider = document.querySelector(`.slider__content`);

if (slider) {
    const sliderMenus = document.querySelectorAll(`.slider__menuButton`);
    const slides = document.querySelectorAll(`.slider__content .slide`);
    const slide__overflow = document.querySelector('.slide__overflow');

    setOverflowBG(sliderMenus[0].getAttribute('data-image-url'));

    Array.prototype.forEach.call(sliderMenus, (el, i) => {
        el.onclick = function () {
            disableSlides();
            disableSlideMenu();

            this.classList.add('slider__menuButton-active');
            slides[i].classList.add('slide-show');
            setOverflowBG(this.getAttribute('data-image-url'));
        }
    });


    function disableSlides() {
        Array.prototype.forEach.call(slides, el => {
            el.classList.remove('slide-show')
        })
    }

    function disableSlideMenu() {
        Array.prototype.forEach.call(sliderMenus, el => {
            el.classList.remove('slider__menuButton-active')
        })
    }

    function setOverflowBG(url) {
        slide__overflow.style.backgroundImage = `url(${url})`;
    }
}

const slidersFeatures = document.querySelectorAll('.sliderRow');

if (slidersFeatures[0]) {

    _for(slidersFeatures, initSlider);

    function initSlider(slider) {
        const sliderRow__menues = slider.querySelectorAll('.sliderRow__menu');
        const sliderRow__slides = slider.querySelectorAll('.sliderRow__slide');

        _for(sliderRow__menues, function (el) {
            el.onclick = function () {
                setActiveMenu(el.getAttribute('data-key'), sliderRow__menues);
                setActiveSlide(el.getAttribute('data-key'), sliderRow__slides);
            };
        });
    }

    function setActiveMenu(dataKey, sliderRow__menues) {
        _for(sliderRow__menues, function (el) {
            if (el.getAttribute('data-key') === dataKey) {
                el.classList.add('sliderRow__menu--active');
                return;
            }

            el.classList.remove('sliderRow__menu--active');
        });
    }

    function setActiveSlide(dataSlideKey, sliderRow__slides) {
        _for(sliderRow__slides, function (el) {
            if (el.getAttribute('data-slide-key') === dataSlideKey) {
                el.classList.add('sliderRow__slide--active');
                return;
            }

            el.classList.remove('sliderRow__slide--active');
        });
    }
}


const modalButtons = document.querySelectorAll('.modalTrigger');

if(modalButtons[0]){
    const modalOverflow = document.querySelector('.modalOverflow');
    const modals = document.querySelectorAll('.modal');
    const modal__forms = document.querySelectorAll('.modal__form');

    _for(modal__forms, (el) => {
        el.addEventListener('submit', function(e){
            e.preventDefault();
        })
    });

    modalOverflow.addEventListener('click', function (e) {
        if(e.target === modalOverflow){
            modalOverflow.classList.remove('show');
            _for(modals, el => {
                el.classList.remove('show');
            });
            document.querySelector('body').classList.remove('non-scroll');
        }
    });

    _for(modalButtons, function(el){
        el.addEventListener('click', function(){
            const modalTargetClass = el.getAttribute('data-modal');
            const modal = document.querySelector(`.${modalTargetClass}`);
            try {
                modal.classList.add('show');
                modalOverflow.classList.add('show');
                document.querySelector('body').classList.add('non-scroll');
            } catch (e) {

            }
        });
    });
}



function _for(array, fn) {
    Array.prototype.forEach.call(array, fn);
}

