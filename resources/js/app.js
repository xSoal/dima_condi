


const slider = document.querySelector(`.slider__content`);

if( slider ){
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


