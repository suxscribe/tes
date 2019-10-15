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
<div class="index-section-2 section" data-section="data-section">
    <div class="solutions">
        <div class="swiper-container solutions__slider">
            <div class="swiper-wrapper solutions__slider-warpper">
                <?foreach ($arResult['ITEMS'] as $iKey => $arItem):?>
                <div class="solution swiper-slide solutions__solution">
                    <svg class="solution-gradient solution__gradient" width="100%" height="100%" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <rect width="100%" height="100%" fill="white"></rect>
                        <rect width="100%" height="100%" fill="#DCE0E7"></rect>
                        <rect width="100%" height="100%" fill="url(##DCE0E7#2E2E43)" fill-opacity="0.65"></rect>
                        <defs>
                            <radialgradient id="#DCE0E7#2E2E43" cx="0" cy="0" r="1"
                                            gradientUnits="userSpaceOnUse"
                                            gradientTransform="translate(960 540) rotate(90) scale(1081.5 1922.67)">
                                <stop stop-color="white" stop-opacity="0"></stop>
                                <stop offset="0.892931" stop-color="#2E2E43"></stop>
                            </radialgradient>
                        </defs>
                    </svg>
                    <div class="container-fluid solution__container-fluid">
                        <div class="row solution__row">
                            <div class="solution__bg-wrapper">
                                <img class="solution__bg"
                                     src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                     data-src="<?=$arItem['PROPERTIES']['MAIN_PICTURE']['SRC']?>"/>
                            </div>
                            <div class="col-md-6 solution__col" data-content="data-content">
                                <div class="solution__top-space"></div>
                                <div class="solution__name"><?=$arItem['NAME']?></div>
                                <div class="solution__bottom-space"></div>
                                <div class="solution__solutions-label">Решения</div>
                                <div class="solution__full-name">
                                    <?=$arItem['PREVIEW_TEXT']?>
                                </div>
                                <div class="solution__kw"><?=$arItem['PROPERTIES']['POWER']['VALUE']?></div>
                                <a class="button solution__link" href="<?=$arItem['DETAIL_PAGE_URL']?>">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?endforeach;?>
            </div>
        </div>
        <div class="solutions-navigation d-none d-md-block">
            <div class="container-fluid solutions-navigation__container-fluid">
                <div class="row solutions-navigation__row">
                    <div class="col-2 solutions-navigation__col offset-6">
                        <?$iNumber=0;?>
                        <?foreach ($arResult['ITEMS']  as $arItem):?>
                        <div class="solutions-navigation__item" data-index="<?=$iNumber?>"><?=$arItem['NAME']?> <?=$arItem['PROPERTIES']['POWER']['VALUE']?>
                            <div class="solutions-navigation__progress"></div>
                        </div>
                        <?$iNumber++;?>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-slider-navigation">
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
    </div>
</div>
