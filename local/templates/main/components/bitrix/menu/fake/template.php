<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<div class="header header_absolute container-fluid d-none d-md-block">
    <div class="row">
        <div class="header__col col-2"><a class="header__logo-link" href="/">
                <svg class="header__logo">
                    <use xlink:href="#logo"></use>
                </svg>
            </a></div>
        <div class="header__col col-5 d-none d-md-flex">
            <div class="menu header__menu">
                <?foreach ($arResult as $arItem):?>
                    <a class="menu__item <?=($arItem['SELECTED'])? 'menu__item_active':''?>" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
                <?endforeach;?>
            </div>
        </div>
        <div class="header__col col-6 col-md-1 justify-content-end">
            <a class="header__phone d-md-none" href="tel:88002343344">
                <svg>
                    <use xlink:href="#phone"></use>
                </svg>
            </a>
            <div class="sandwich-button header__sandwich-button">
                <div class="sandwich-button__line sandwich-button__line_top"></div>
                <div class="sandwich-button__line sandwich-button__line_middle"></div>
                <div class="sandwich-button__line sandwich-button__line_bottom"></div>
            </div>
        </div>
    </div>
</div>
