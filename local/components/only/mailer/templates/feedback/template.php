<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<div class="feedback collapsed" data-toggle="collapse" data-target="#form-feedback">
    <div class="feedback__content container-fluid">
        <div class="row feedback__row">
            <div class="feedback__wrapper">
                <div class="col-8 feedback__title-1">Хотите связаться с нами?</div>
                <div class="col-8">
                    <div class="form-feedback">
                        <div class="row">
                            <div class="col-8 form-feedback__title-1 collapsed">
                                <div class="form-feedback__show">Закрыть форму</div>
                                <div class="form-feedback__hide">Открыть форму</div>
                            </div>
                            <form class="col-8 form-feedback__content collapse" id="form-feedback" action="/api/feedback.php" method="POST">
                                <div class="row form-feedback__row">
                                    <div class="d-flex flex-column justify-content-end form-feedback__name">
                                        <div class="textfield textfield_lablel-right textfield_full-width textfield_name">
                                            <input class="textfield__input" id="name" type="text" name="feedback-name" required="required"/>
                                            <label class="textfield__label" for="name">Ваше имя</label></div>
                                    </div>
                                    <div class="form-feedback__text-1">
                                        <a class="form-feedback__phone" href="tel:88002343344">
                                            8 (800) 234-33-44</a>
                                        <span>Единый многоканальный номер, звонок по России бесплатный.</span>
                                    </div>
                                </div>
                                <div class="row form-feedback__row">
                                    <div class="d-flex flex-column justify-content-between">
                                        <div class="textfield textfield_lablel-right textfield_full-width textfield_email">
                                            <input class="textfield__input" id="email" type="email" name="feedback-email"
                                                   required="required"/>
                                            <label class="textfield__label" for="email">E-mail</label>
                                        </div>
                                        <div class="textfield textfield_lablel-right textfield_full-width textfield_company">
                                            <input class="textfield__input" id="company" type="text" name="feedback-company" required="required"/>
                                            <label class="textfield__label" for="company">Название компании</label>
                                        </div>
                                        <div class="textfield textfield_lablel-right textfield_full-width textfield_phone">
                                            <input class="textfield__input" id="tel" type="tel" name="feedback-phone" required="required"/>
                                            <label class="textfield__label" for="tel">Контактный номер</label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="textfield textfield_lablel-right textfield_full-width textfield_textarea">
                                            <textarea class="textfield__input" id="text" name="feedback-comment" required="required"></textarea>
                                            <label class="textfield__label" for="text">Сообщение</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div></div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-8 col-md-5">
                                                <?if ($arParams['USE_CAPTCHA']):?>
                                                    <?=$arResult['CAPTCHA_HTML']?>
                                                <?endif;?>
                                            </div>
                                            <div class="col-8 col-md-3 d-flex align-items-center justify-content-end">
                                                <button class="link form-feedback__button js-submit-button" type="submit" disabled>
                                                    <svg class="link__icon form-feedback__refresh"><use xlink:href="#refresh"></use></svg>
                                                    <span class="d-md-inline form-feedback__button-text">Отправить запрос</span>
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
    </div>
</div>
