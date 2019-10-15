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
<div class="competence container-fluid d-none d-md-block" data-page-nav-item="Область компетенций">
    <div class="row competence__text-top">
        <div class="col-8 col-md-6 offset-md-1">
            <?=$arResult['PREVIEW_TEXT']?>
        </div>
    </div>
    <div class="row competence__content">
        <svg class="competence__bg">
            <use xlink:href="#gradient"></use>
        </svg>
        <div class="competence__bg-text"><?=$arResult['PROPERTIES']['STAGES_NAME']['VALUE']?></div>
        <div class="competence__left col-md-6 col-xl-2 offset-md-1">
            <div class="competence__text"><?=$arResult['PROPERTIES']['STAGES_DESC']['VALUE']?></div>
            <div class="slider-navigation slider-navigation_services slider-navigation_white d-none d-md-block">
                <div class="slider-navigation__arrows">
                    <div class="slider-navigation__arrow slider-navigation__arrow_prev">
                        <div class="slider-navigation__arrow-space"></div>
                        <div class="slider-navigation__arrow-wrapper">
                            <svg>
                                <use xlink:href="#arrow-left"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="slider-navigation__arrow slider-navigation__arrow_next">
                        <div class="slider-navigation__arrow-space"></div>
                        <div class="slider-navigation__arrow-wrapper">
                            <svg>
                                <use xlink:href="#arrow-right"></use>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="slider-navigation__text">Или используйте клавиатуру</div>
            </div>
        </div>
        <div class="competence__right col-md-6 offset-md-1 col-xl-4 offset-xl-0">
            <div class="competence-slider">
                <div class="swiper-container competence-slider__swiper">
                    <div class="swiper-wrapper">
                        <?$arRows = array_chunk($arResult['PROPERTIES']['STAGES']['VALUE'], 3);?>
                        <?$iNumber = 1;?>
                        <?foreach ($arRows as $arRow):?>
                        <div class="swiper-slide">
                            <?foreach ($arRow as $arItem):?>
                            <div class="competence-item">
                                <div class="competence-item__index"><?printf('%02d',$iNumber);?></div>
                                <div class="competence-item__text"><?=$arItem?>
                                </div>
                            </div>
                            <?$iNumber++;?>
                            <?endforeach;?>
                        </div>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="competence-mobile d-md-none">
    <div class="container-fluid competence-mobile__wrapper">
        <svg class="competence-mobile__bg">
            <use xlink:href="#gradient"></use>
        </svg>
        <div class="mobile-slider-navigation">
            <div class="d-flex align-items-center mobile-slider-navigation__bar">
                <div class="mobile-slider-navigation__current">01</div>
                <div class="mobile-slider-navigation__progress"></div>
                <div class="mobile-slider-navigation__total">
                    <?printf('%02d',round(count($arResult['PROPERTIES']['STAGES']['VALUE'])/2))?>
                </div>
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
        <div class="competence-mobile__content">
            <div class="competence-mobile__title"><?=$arResult['PROPERTIES']['STAGES_DESC']['VALUE']?></div>
            <div class="swiper-container competence-mobile__swiper">
                <div class="swiper-wrapper">
                <?$arRows = array_chunk($arResult['PROPERTIES']['STAGES']['VALUE'], 2);?>
                <?$iNumber = 1;?>
                <?foreach ($arRows as $arRow):?>
                    <div class="swiper-slide">
                        <?foreach ($arRow as $arItem):?>
                            <div class="competence-item">
                                <div class="competence-item__index"><?printf('%02d',$iNumber);?></div>
                                <div class="competence-item__text"><?=$arItem?>
                                </div>
                            </div>
                            <?$iNumber++;?>
                        <?endforeach;?>
                    </div>
                <?endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="advantages advantages_white">
    <div class="container-fluid">
        <div class="row">
            <div class="advantages__title-1 col-md-5 offset-md-1" data-page-nav-item="">Преимущества</div>
            <div class="col-2 d-none d-md-block">
                <div class="slider-navigation slider-navigation_advantages">
                    <div class="slider-navigation__arrows">
                        <div class="slider-navigation__arrow slider-navigation__arrow_prev">
                            <div class="slider-navigation__arrow-space"></div>
                            <div class="slider-navigation__arrow-wrapper">
                                <svg>
                                    <use xlink:href="#arrow-left"></use>
                                </svg>
                            </div>
                        </div>
                        <div class="slider-navigation__arrow slider-navigation__arrow_next">
                            <div class="slider-navigation__arrow-space"></div>
                            <div class="slider-navigation__arrow-wrapper">
                                <svg>
                                    <use xlink:href="#arrow-right"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="slider-navigation__text">Или используйте клавиатуру</div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid advantages__container">
        <div class="row">
            <div class="advantages__wrapper col-md-7 offset-md-1">
                <div class="mobile-slider-navigation mobile-slider-navigation_advantages mobile-slider-navigation_dark">
                    <div class="d-flex align-items-center mobile-slider-navigation__bar">
                        <div class="mobile-slider-navigation__current">01</div>
                        <div class="mobile-slider-navigation__progress"></div>
                        <div class="mobile-slider-navigation__total"><?printf('%02d',count($arResult['PROPERTIES']['ADVANTAGE']['VALUE']))?></div>
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
                <div class="col__fix-right">
                    <div class="swiper-container advantages__swiper-container">
                        <div class="swiper-wrapper advantages__swiper-wrapper">
                            <?foreach ($arResult['PROPERTIES']['ADVANTAGE']['VALUE'] as $iKey => $sItem):?>
                            <div class="advantage swiper-slide advantage_dark">
                                <div class="advantage__wrapper">
                                    <div class="advantage__count"><?printf('%02d',$iKey+1)?></div>
                                    <div class="advantage__title"><?=$arResult['PROPERTIES']['ADVANTAGE']['DESCRIPTION'][$iKey]?></div>
                                    <div class="advantage__text">
                                        <?=$sItem['TEXT']?>
                                    </div>
                                </div>
                            </div>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
