    <div class="modalOverflow">

    </div>

    <div class="modal modal-getCall">
        <form class="modal__form" action="">
            @csrf
            <div class="modal__inner">
                <div class="modal__field">
                    <label>
                        <p>Ваше имя*</p>
                        <input type="text" required name="get_call__name">
                    </label>
                </div>
                <div class="modal__field">
                    <label>
                        <p>Телефон*</p>
                        <input type="text" required name="get_call__tel">
                    </label>
                </div>
                <div class="modal__buttonCont">
                    <button class="orderButton modal__buttonSubmit"> Заказать </button>
                </div>
            </div>
        </form>
    </div>



