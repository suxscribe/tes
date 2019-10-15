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
<div class="news-slider">
    <div class="gallery-navigation gallery-navigation_news-slider">
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
    <div class="mobile-slider-navigation mobile-slider-navigation_news-slider">
        <div class="d-flex align-items-center mobile-slider-navigation__bar">
            <div class="mobile-slider-navigation__current">01</div>
            <div class="mobile-slider-navigation__progress"></div>
            <div class="mobile-slider-navigation__total"><?printf('%02d',count($arResult['ITEMS']))?></div>
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
    <div class="swiper-container news-slider__swiper-container">
        <div class="swiper-wrapper news-slider__swiper-wrapper">
            <!-- SLIDE ITEMS-->
            <?foreach ($arResult['ITEMS'] as $arItem):?>
            <div class="swiper-slide news-slider__slide">
                <a class="news-slider__wrapper" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                    <div class="news-slider__bg-wrapper">
                        <img class="news-slider__bg"
                             src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                             data-src="<?=$arItem['DETAIL_PICTURE']['SRC']?>"
                             data-object-fit="cover" alt="<?=$arItem['DETAIL_PICTURE']['ALT']?>"/>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-4 col-md-5 offset-md-2 offset-xl-1">
                                <div class="news-slider__date"><?=FormatDate('j F Y',MakeTimeStamp($arItem['DATE_ACTIVE_FROM']))?></div>
                                <div class="news-slider__title">
                                    <?=$arItem['NAME']?>
                                </div>
                                <div class="news-slider__text">
                                    <?=$arItem['PREVIEW_TEXT']?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?endforeach;?>
            <!-- END SLIDE ITEMS -->
        </div>
    </div>
</div>
