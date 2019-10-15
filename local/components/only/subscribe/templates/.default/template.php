<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="subscribe">
    <div class="subscribe__content container-fluid">
        <div class="row subscribe__row">
            <div class="subscribe__wrapper">
                <div class="col-8 subscribe__title-1">Хотите быть в&nbsp;курсе?</div>
                <div class="col-8">
                    <form class="subscribe-to-news container-fluid" action="/api/subscribe.php?method=toSubscribe"
                          method="GET">
                        <div class="subscribe-to-news__bg"></div>
                        <div class="row subscribe-to-news__row">
                            <div class="align-items-center subscribe-to-news__label subscribe-to-news__label_inner">
                                Подпишитесь на&nbsp;наши новости
                            </div>
                            <div class="subscribe-to-news__col-right">
                                <div class="align-items-center subscribe-to-news__textfield-wrapper subscribe-to-news__textfield-wrapper_inner">
                                    <div class="subscribe-to-news__animation-textfield-bg"></div>
                                    <div class="textfield textfield_lablel-right textfield_full-width subscribe-to-news__textfield">
                                        <input class="textfield__input" id="email" type="email" name="subscribe-email"
                                               required="required"/><label class="textfield__label" for="email">Ваш
                                            е-mail</label></div>
                                </div>
                                <div class="subscribe-to-news__button d-flex justify-content-stretch align-items-stretch subscribe-to-news__right">
                                    <div class="subscribe-to-news__button-wrapper align-items-center">
                                        <button class="link" type="submit">
                                            <svg class="link__icon subscribe-to-news__arrow">
                                                <use xlink:href="#arrow-right"></use>
                                            </svg>
                                            <svg class="link__icon subscribe-to-news__refresh">
                                                <use xlink:href="#refresh"></use>
                                            </svg>
                                            <span class="d-md-inline subscribe-to-news__button-text">Подписаться</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
