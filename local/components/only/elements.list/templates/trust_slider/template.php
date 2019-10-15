<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponent $component */
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
?>
<div class="trust-slider">
    <div class="gallery-navigation gallery-navigation_trust-slider">
        <div class="gallery-navigation__arrow gallery-navigation__arrow_prev">
            <div class="gallery-navigation__arrow-wrapper">
                <svg>
                    <use xlink:href="#arrow-left"></use>
                </svg>
            </div>
        </div>
        <div class="gallery-navigation__arrow gallery-navigation__arrow_next">
            <div class="gallery-navigation__arrow-wrapper">
                <svg>
                    <use xlink:href="#arrow-right"></use>
                </svg>
            </div>
        </div>
    </div>
    <div class="mobile-slider-navigation mobile-slider-navigation_trust-slider">
        <div class="d-flex align-items-center mobile-slider-navigation__bar">
            <div class="mobile-slider-navigation__current">01</div>
            <div class="mobile-slider-navigation__progress"></div>
            <div class="mobile-slider-navigation__total"><?printf('%02d', count($arResult['ITEMS']))?></div>
        </div>
        <div class="d-flex d-md-none">
            <div class="mobile-slider-navigation__prev">
                <svg class="mobile-slider-navigation__arrow-svg">
                    <use xlink:href="#arrow-left-short"></use>
                </svg>
            </div>
            <div class="mobile-slider-navigation__next">
                <svg class="mobile-slider-navigation__arrow-svg">
                    <use xlink:href="#arrow-right-short"></use>
                </svg>
            </div>
        </div>
    </div>
    <div class="trust-slider__numeration">01</div>
    <div class="swiper-container trust-slider__swiper-container">
        <div class="swiper-wrapper trust-slider__swiper-wrapper">
            <?foreach ($arResult['ITEMS'] as $arItem):?>
            <div class="swiper-slide trust-slider__slide">
                <div class="trust-slider__wrapper">
                    <div class="trust-slider__bg-wrapper">
                        <img class="trust-slider__bg"
                             src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                             data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
                             data-object-fit="cover"/>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8 col-md-6 offset-md-2 offset-xl-1 trust-slider__comment-wrapper">
                                <div class="trust-slider__comment">
                                    <?=$arItem['DETAIL_TEXT']?>
                                </div>
                                <div class="trust-slider__autor"><?=$arItem['NAME']?></div>
                                <div class="trust-slider__work"><?=$arItem['PREVIEW_TEXT']?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?endforeach;?>
        </div>
    </div>
</div>
