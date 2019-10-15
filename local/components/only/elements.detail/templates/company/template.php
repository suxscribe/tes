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
<?
$APPLICATION->SetPageProperty('BARBA_NAMESPASE', 'company');
$APPLICATION->SetPageProperty('PAGE_NAVIGATION', true);
$this->setFrameMode(true);
?>
<div class="info-block-8 container-fluid">
    <h1 class="col-8 col-md-6 offset-md-1 info-block-8__title tpg__title"><?=$arResult['NAME']?></h1>
    <div class="info-block-8__bg-wrapper">
        <img class="info-block-8__bg"
             src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
             data-src="<?=$arResult['DETAIL_PICTURE']['SRC']?>"
             data-object-fit="cover"/>
    </div>
</div>
<div class="info-block-1 container-fluid info-block-1_offset-vertical-top" data-page-nav-item="О нас"
     data-navigation-trigger="data-navigation-trigger">
    <div class="row">
        <div class="col-8 col-md-6 offset-md-1">
            <div class="info-block-1__title">О нас</div>
            <div class="info-block-1__text-1">
                <?=$arResult['PREVIEW_TEXT']?>
            </div>
            <div class="info-block-1__text-2">
                <?=$arResult['DETAIL_TEXT']?>
            </div>
        </div>
    </div>
</div>
<div class="company-inner container-fluid company-inner_offset-vertical-top">
    <svg class="company-inner__epc">
        <use xlink:href="#epc"></use>
    </svg>
    <div class="row">
        <div class="col-md-6 offset-md-1">
            <div class="row">
                <div class="col-md-3 d-flex flex-column justify-content-center company-inner__items">
                    <div class="company-inner__item"><span>E</span><span>Engineering</span></div>
                    <div class="company-inner__item"><span>P</span><span>Procurement</span></div>
                    <div class="company-inner__item"><span>C</span><span>Construction</span></div>
                </div>
                <div class="col-xl-5 col-md-4 offset-xl-0 offset-md-1 d-flex flex-column justify-content-center">
                    <div class="company-inner__text-1">
                        <?=$arResult['PROPERTIES']['EPC_TEXT']['VALUE']['TEXT']?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="video-slider">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="video-slider__slider">
                    <div class="mobile-slider-navigation mobile-slider-navigation_video-slider mobile-slider-navigation_dark">
                        <div class="d-flex align-items-center mobile-slider-navigation__bar">
                            <div class="mobile-slider-navigation__current">01</div>
                            <div class="mobile-slider-navigation__progress"></div>
                            <div class="mobile-slider-navigation__total">
                                <?printf('%02d',count($arResult['PROPERTIES']['VIDEOS']['VALUE']))?>
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
                    <div class="video-slider__content d-flex justify-content-between col__fix-left col__fix-right">
                        <?for ($i=0; $i<3;$i++):?>
                        <div class="swiper-container video-slider__swiper-container">
                            <div class="swiper-wrapper video-slider__swiper-wrapper">
                                <?foreach ($arResult['PROPERTIES']['VIDEOS']['VALUE'] as $arVideo):?>
                                <div class="swiper-slide video-slider__swiper-slide">
                                    <div class="video-slider__space"></div>
                                    <div class="video-slider__wrapper">
                                        <div class="video-slider__bg-wrapper">
                                            <div class="video video-slider__item">
                                                <?if (!empty($arVideo['YOUTUBE_ID'])):?>
                                                <img class="video__bg-wrapper"
                                                     src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                     data-src="https://img.youtube.com/vi/<?=$arVideo['YOUTUBE_ID']?>/maxresdefault.jpg"/>
                                                <div class="video__button">
                                                    <svg>
                                                        <use xlink:href="#play"></use>
                                                    </svg>
                                                </div>
                                                <div class="video__item video__item_youtube" data-embed="<?=$arVideo['YOUTUBE_ID']?>"></div>
                                                <?else:?>
                                                <div class="video__bg-wrapper">
                                                    <div class="video__button">
                                                        <svg>
                                                            <use xlink:href="#play"></use>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <video class="autoplay-video video__item video__item_inner"
                                                       src="<?=$arVideo['SRC']?>" preload="metadata"
                                                       playsinline="playsinline" muted="muted"
                                                       loop="loop">
                                                </video>
                                                <?endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?endforeach;?>
                            </div>
                        </div>
                        <?endfor;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="competence container-fluid d-none d-md-block competence_offset-top">
    <div class="row competence__content">
        <svg class="competence__bg">
            <use xlink:href="#gradient"></use>
        </svg>
        <div class="competence__bg-text">Ресурсы</div>
        <div class="competence__left col-md-6 col-xl-2 offset-md-1">
            <div class="competence__text">В состав организации входят</div>
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
                        <?$arRows = array_chunk($arResult['PROPERTIES']['COMPOSITION_ORG']['VALUE'],3)?>
                        <?$iNumber =1;?>
                        <?foreach ($arRows as $arRow):?>
                        <div class="swiper-slide">
                            <?foreach ($arRow as $arItem):?>
                            <div class="competence-item competence-slider__item">
                                <div class="competence-item__index"><?printf('%02d',$iNumber)?></div>
                                <div class="competence-item__text">
                                    <?=$arItem['TEXT']?>
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
                <div class="mobile-slider-navigation__total"><?printf('%02d',count($arResult['PROPERTIES']['COMPOSITION_ORG']['VALUE'])/2)?></div>
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
            <div class="competence-mobile__title">В&nbsp;состав организации входят</div>
            <div class="swiper-container competence-mobile__swiper">
                <div class="swiper-wrapper">
                    <?$arRows = array_chunk($arResult['PROPERTIES']['COMPOSITION_ORG']['VALUE'],2)?>
                    <?$iNumber =1;?>
                    <?foreach ($arRows as $arRow):?>
                    <div class="swiper-slide">
                        <?foreach ($arRow as $arItem):?>
                        <div class="competence-item">
                            <div class="competence-item__index"><?printf('%02d',$iNumber)?></div>
                            <div class="competence-item__text">
                                <?=$arItem['TEXT']?>
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
            <div class="advantages__title-1 col-md-5 offset-md-1">Преимущества</div>
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
                        <div class="mobile-slider-navigation__total"><?printf('%02d',count($arResult['PROPERTIES']['ADVANTAGES']['VALUE']))?></div>
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
                            <?foreach ($arResult['PROPERTIES']['ADVANTAGES']['VALUE'] as $iKey => $arAdvantage):?>
                            <div class="advantage swiper-slide advantage_dark">
                                <div class="advantage__wrapper">
                                    <div class="advantage__count"><?printf('%02d',$iKey+1)?></div>
                                    <div class="advantage__title">
                                        <?=$arResult['PROPERTIES']['ADVANTAGES']['DESCRIPTION'][$iKey]?>
                                    </div>
                                    <div class="advantage__text">
                                        <?=$arAdvantage['TEXT']?>
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
<div class="company-map" data-page-nav-item="География" data-navigation-contrast>
    <div class="company-map__bg-wrapper">
        <picture>
            <source srcset="<?=$arResult['PROPERTIES']['MAP_IMAGE_MOBILE']['VALUE']['SRC']?>" media="(max-width: 767px)">
            <img src="<?=$arResult['PROPERTIES']['MAP_IMAGE']['VALUE']['SRC']?>" class="company-map__bg">
        </picture>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 offset-md-1">
                <div class="company-map__title-1">География работы</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 offset-md-1">
                <div class="company-map__text-1">
                    <?=$arResult['PROPERTIES']['MAP_TEXT']['VALUE']['TEXT']?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-none d-md-block company-map__text-2">Представительства компании</div>
            </div>
        </div>
    </div>
</div>
