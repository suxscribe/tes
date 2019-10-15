<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form class="subscribe-to-news subscribe-to-news_offset container-fluid container-fluid_fix-right"
      action="/api/subscribe.php?method=toSubscribe" method="GET">
    <div class="subscribe-to-news__bg"></div>
    <div class="row subscribe-to-news__row">
        <div class="align-items-center subscribe-to-news__label col-xxl-2 offset-md-1 col-8 col-md-7 col-xl-2-half-only">
            Подпишитесь на&nbsp;наши новости
        </div>
        <div class="align-items-center subscribe-to-news__textfield-wrapper offset-md-1 col-6 col-md-5 col-xl-3 offset-xl-0 col-xxl-3">
            <div class="subscribe-to-news__animation-textfield-bg"></div>
            <div class="textfield textfield_lablel-right textfield_full-width subscribe-to-news__textfield">
                <input class="textfield__input" id="email" name="subscribe-email" type="email" required="required"/><label
                    class="textfield__label" for="email">Ваш е-mail</label></div>
        </div>
        <div class="subscribe-to-news__button d-flex justify-content-stretch align-items-stretch col-2 col-md-2 col-xxl-1 col-xl-1-half-only">
            <div class="subscribe-to-news__button-wrapper align-items-center">
                <button class="link" type="submit">
                    <svg class="link__icon subscribe-to-news__arrow">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                    <svg class="link__icon subscribe-to-news__refresh">
                        <use xlink:href="#refresh"></use>
                    </svg>
                    <span class="d-md-inline subscribe-to-news__button-text d-none">Подписаться</span>
                </button>
            </div>
        </div>
    </div>
</form>
