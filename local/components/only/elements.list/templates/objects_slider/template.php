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
<div class="projects">
    <div class="mobile-slider-navigation mobile-slider-navigation_dark">
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
    <div class="container-fluid container-fluid_fix-right">
        <div class="row">
            <div class="projects__title col-8 col-md-7 offset-md-1">Проекты</div>
            <div class="d-none d-md-flex col-1 projects__navigation-col">
                <div class="slider-navigation slider-navigation_projects">
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
                <a class="link projects__all" href="/objects/">Все проекты</a>
            </div>
            <div class="col-8 col-md-7">
                <div class="col__fix-right d-md-flex justify-content-between projects__sliders-wrapper">
                    <?for ($i=0;$i<4;$i++):?>
                        <div class="swiper-container projects__swiper-container">
                            <div class="swiper-wrapper projects__swiper-wrapper">
                                <?for ($j=0;$j<2;$j++):?>
                                <?foreach ($arResult['ITEMS'] as $arItem):?>
                                <a class="project swiper-slide projects__swiper-slide" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                    <div class="project__space"></div>
                                    <div class="project__wrapper">
                                        <div class="project__bg-wrapper">
                                            <img class="project__bg"
                                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                 data-src="<?=$arItem['PROPERTIES']['PICTURE_SLIDER']['SRC']?>"
                                                 data-object-fit="cover"/>
                                            <div class="project__shade"></div>
                                        </div>
                                        <div class="project__content">
                                            <div class="project__text"><?=$arItem['PROPERTIES']['NAME_SLIDER']['VALUE']?></div>
                                            <div class="project__plus"></div>
                                        </div>
                                    </div>
                                </a>
                                <?endforeach;?>
                                <?endfor;?>
                            </div>
                        </div>
                    <?endfor;?>
                </div>
            </div>
        </div>
    </div>
</div>
