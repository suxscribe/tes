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
<?php
$APPLICATION->SetPageProperty('BARBA_NAMESPASE', 'solution');
$APPLICATION->SetPageProperty('PAGE_NAVIGATION', true);
$this->setFrameMode(true);
?>
<div class="product-head section" data-section="data-section">
    <div class="product-head__content container-fluid">
        <div class="row product-head__row">
            <div class="col-xl-4 col-8">
                <h1 class="product-head__title-1"><?=$arResult['NAME']?></h1>
                <div class="product-head__title-2"><?=$arResult['PROPERTIES']['POWER']['VALUE']?></div>
            </div>
            <div class="col-xl-4 col-8 product-head__text-1 splitText">
                <?=$arResult['PREVIEW_TEXT']?>
            </div>
            <div class="col-8 product-head__text-2">
                <?=$arResult['DETAIL_TEXT']?>
            </div>
        </div>
        <div class="row product-head__bottom">
            <div class="product-head__arrow"></div>
            <div class="product-head__arrow-wrapper product-head__arrow-down">
                <svg>
                    <use xlink:href="#arrow-down"></use>
                </svg>
            </div>
            <div class="col-8 product-head__col">
                <div class="product-head__bg-wrapper">
                    <img class="product-head__bg"
                         src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                         data-src="<?=$arResult['DETAIL_PICTURE']['SRC']?>"/>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-tail section" data-section="data-section">
    <div class="product-tail__wrapper">
        <? $APPLICATION->IncludeComponent(
            'bitrix:menu',
            'fake',
            Array(
                'ALLOW_MULTI_SELECT' => 'N',
                'CHILD_MENU_TYPE' => '',
                'DELAY' => 'N',
                'MAX_LEVEL' => '1',
                'MENU_CACHE_GET_VARS' => array(''),
                'MENU_CACHE_TIME' => '3600',
                'MENU_CACHE_TYPE' => 'A',
                'MENU_CACHE_USE_GROUPS' => 'Y',
                'ROOT_MENU_TYPE' => 'top',
                'USE_EXT' => 'N'
            )
        ); ?>
        <div class="solution-image" data-product-section-1="data-product-section-1">
            <img class="solution-image__img"
                 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                 data-src="<?=$arResult['DETAIL_PICTURE']['SRC']?>"/>
        </div>
        <div class="info-block-1 container-fluid info-block-1_offset-vertical-top"
             data-page-nav-item="Применение" data-navigation-trigger="data-navigation-trigger">
            <div class="row">
                <div class="col-8 col-md-6 offset-md-1">
                    <div class="info-block-1__title">Применение</div>
                    <div class="info-block-1__text-1">
                        <?=$arResult['PROPERTIES']['APPLICATION_LARGE_TEXT']['VALUE']?>
                    </div>
                    <div class="info-block-1__text-2">
                        <?=$arResult['PROPERTIES']['APPLICATION_SMALL_TEXT']['VALUE']?>
                    </div>
                </div>
            </div>
        </div>
        <?if (!empty($arResult['PROPERTIES']['APPLICATION_PHOTO']['VALUE']['SRC']) && (!empty($arResult['PROPERTIES']['OBJECTS']['VALUE']))):?>
        <div class="applications container-fluid">
            <div class="row">
                <div class="applications__left col-8 col-md-6 col-lg-3 offset-md-1">
                    <div class="applications__title">Применение на различных этапах</div>
                    <img class="applications__infographic"
                         src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                         data-src="<?=$arResult['PROPERTIES']['APPLICATION_PHOTO']['VALUE']['SRC']?>"/>
                </div>
                <div class="applications__right col-8 col-md-6 offset-md-1 col-lg-3 offset-lg-0">
                    <div class="applications__title">Объекты</div>
                    <ol class="numeric-list">
                        <?foreach ($arResult['PROPERTIES']['OBJECTS']['VALUE'] as $iKey => $sObjects):?>
                        <li class="numeric-list__item">
                            <div class="numeric-list__number"><?printf('%02d',$iKey+1)?></div>
                            <span>
                                <?=$sObjects?>
                            </span>
                        </li>
                        <?endforeach;?>
                    </ol>
                </div>
            </div>
        </div>
        <?endif;?>
        <?if (!empty($arResult['PROPERTIES']['DOCUMENTS']['VALUE'])):?>
        <div class="documents documents_3-doc" data-page-nav-item="Документы">
            <div class="container-fluid">
                <div class="row documents__row">
                    <div class="col-md-3 col-xl-2 offset-xl-1 documents__title-1 d-flex align-items-center">
                        Документы
                    </div>
                    <div class="col-md-5 col-xl-4 documents__text-1 d-flex align-items-center">
                        <?=$arResult['PROPERTIES']['DOCUMENTS_TITLE']['VALUE']?>
                    </div>
                    <?foreach ($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as $arDocument):?>
                        <div class="document col-xl-2 col-md-4 documents__document">
                            <div class="document__wrapper">
                                <div class="document__title-1">
                                    <?=$arDocument['DESCRIPTION']?>
                                </div>
                                <div class="document__bottom">
                                    <a class="document__link" href="<?=$arDocument['SRC']?>" target="_blank">
                                        (<?=$arDocument['FILE_SIZE']?>, <?=$arDocument['EXT']?>)
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?endforeach;?>
                </div>
            </div>
        </div>
        <?endif;?>
        <?if (!empty($arResult['PROPERTIES']['ADVANTAGES']['VALUE'])):?>
        <div class="advantages" data-page-nav-item="Преимущества">
            <svg class="advantages__bg">
                <use xlink:href="#gradient"></use>
            </svg>
            <div class="container-fluid">
                <div class="row">
                    <div class="advantages__title-1 col-md-5 offset-md-1">Преимущества
                    </div>
                    <div class="col-2 d-none d-md-block">
                        <div class="slider-navigation slider-navigation_advantages slider-navigation_white">
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
                        <div class="mobile-slider-navigation mobile-slider-navigation_advantages">
                            <div class="d-flex align-items-center mobile-slider-navigation__bar">
                                <div class="mobile-slider-navigation__current">01</div>
                                <div class="mobile-slider-navigation__progress"></div>
                                <div class="mobile-slider-navigation__total">
                                    <?printf('%02d',count($arResult['PROPERTIES']['ADVANTAGES']['VALUE']))?>
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
                        <div class="col__fix-right">
                            <div class="swiper-container advantages__swiper-container">
                                <div class="swiper-wrapper advantages__swiper-wrapper">
                                    <?foreach ($arResult['PROPERTIES']['ADVANTAGES']['VALUE'] as $iKey => $sAdvantage):?>
                                    <div class="advantage swiper-slide">
                                        <div class="advantage__wrapper">
                                            <div class="advantage__count"><?printf('%02d',$iKey+1)?></div>
                                            <div class="advantage__title"><?=$arResult['PROPERTIES']['ADVANTAGES']['DESCRIPTION'][$iKey]?></div>
                                            <div class="advantage__text">
                                                <?=$sAdvantage?>
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
        <?endif;?>
        <?if (!empty($arResult['PROPERTIES']['SPECIFICATION']['VALUE']['TEXT'])):?>
        <div class="specifications specifications_bottom-offset" data-page-nav-item="Характеристики">
            <div class="specifications__content container-fluid container-fluid_fix-right_mobile">
                <div class="row specifications__row">
                    <div class="col-8 specifications__title-1">
                        <?=$arResult['PROPERTIES']['SPECIFICATION_NAME']['VALUE']?>
                    </div>
                    <?if (!empty($arResult['PROPERTIES']['SPECIFICATION_TEXT']['VALUE']['TEXT'])):?>
                    <div class="col-8 specifications__text">
                        <?=htmlspecialcharsback($arResult['PROPERTIES']['SPECIFICATION_TEXT']['VALUE']['TEXT'])?>
                    </div>
                    <?endif;?>
                    <div class="col-8">
                        <div class="specifications-list">
                            <div class="table-responsive-sm">
                                <?=htmlspecialcharsback($arResult['PROPERTIES']['SPECIFICATION']['VALUE']['TEXT'])?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="specifications__content container-fluid">
                <div class="row specifications__row">
                    <div class="col-8">
                        <div class="specifications__more collapsed" data-toggle="collapse" href="#table-1"
                             aria-expanded="true">
                            <div class="specifications__more-show">Развернуть</div>
                            <div class="specifications__more-hide">Свернуть</div>
                            <div class="specifications__more-plus"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?endif;?>
        <?if (!empty($arResult['PROPERTIES']['CLASSIFICATION']['VALUE']['TEXT'])):?>
        <div class="specifications">
            <div class="specifications__content container-fluid container-fluid_fix-right_mobile">
                <div class="row specifications__row">
                    <div class="col-8 specifications__title-1">
                        <?=$arResult['PROPERTIES']['CLASSIFICATION_NAME']['VALUE']?>
                    </div>
                    <div class="col-8">
                        <div class="specifications-list">
                            <div class="table-responsive-sm">
                                <?=htmlspecialcharsback($arResult['PROPERTIES']['CLASSIFICATION']['VALUE']['TEXT'])?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="specifications__content container-fluid">
                <div class="row specifications__row">
                    <div class="col-8">
                        <div class="specifications__more collapsed" data-toggle="collapse" href="#table-2"
                             aria-expanded="true">
                            <div class="specifications__more-show">Развернуть</div>
                            <div class="specifications__more-hide">Свернуть</div>
                            <div class="specifications__more-plus"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?endif;?>
        <?if (!empty($arResult['PROPERTIES']['PHOTOS']['VALUE'])):?>
        <div class="gallery">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <div class="gallery__slider">
                            <div class="mobile-slider-navigation mobile-slider-navigation_gallery mobile-slider-navigation_dark">
                                <div class="d-flex align-items-center mobile-slider-navigation__bar">
                                    <div class="mobile-slider-navigation__current">01</div>
                                    <div class="mobile-slider-navigation__progress"></div>
                                    <div class="mobile-slider-navigation__total"><?printf('%02d',count($arResult['PROPERTIES']['PHOTOS']['VALUE']))?></div>
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
                            <div class="gallery__content d-flex justify-content-between col__fix-left col__fix-right">
                                <?for ($i=0; $i <= 2; $i++):?>
                                <div class="swiper-container gallery__swiper-container">
                                    <div class="swiper-wrapper gallery__swiper-wrapper">
                                        <?foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $arPhoto):?>
                                        <div class="swiper-slide gallery__swiper-slide">
                                            <div class="gallery__space"></div>
                                            <div class="gallery__wrapper">
                                                <div class="gallery__bg-wrapper">
                                                    <img class="gallery__bg"
                                                         src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                         data-src="<?=$arPhoto['SRC']?>"
                                                         data-object-fit="cover"/>
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
        <?endif;?>
        <?if (!empty($arResult['PROPERTIES']['TYPES_EQU']['VALUE']['TEXT'])):?>
        <div class="specifications specifications_bottom-offset">
            <div class="specifications__content container-fluid container-fluid_fix-right_mobile">
                <div class="row specifications__row">
                    <div class="col-8 specifications__title-1">
                        <?=$arResult['PROPERTIES']['TYPES_EQU_NAME']['VALUE']?>
                    </div>
                    <div class="col-8">
                        <div class="specifications-list specifications-list_columns-3">
                            <div class="table-responsive-sm">
                                <?=htmlspecialcharsback($arResult['PROPERTIES']['TYPES_EQU']['VALUE']['TEXT'])?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="specifications__content container-fluid">
                <div class="row specifications__row">
                    <div class="col-8">
                        <div class="specifications__more collapsed" data-toggle="collapse" href="#table-3"
                             aria-expanded="true">
                            <div class="specifications__more-show">Развернуть</div>
                            <div class="specifications__more-hide">Свернуть</div>
                            <div class="specifications__more-plus"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?endif;?>
        <?if (!empty($arResult['OBJECTS'])):?>
            <div class="projects projects_product" data-page-nav-item="Проекты">
                <div class="mobile-slider-navigation mobile-slider-navigation_dark">
                    <div class="d-flex align-items-center mobile-slider-navigation__bar">
                        <div class="mobile-slider-navigation__current">01</div>
                        <div class="mobile-slider-navigation__progress"></div>
                        <div class="mobile-slider-navigation__total"><?printf('%02d',count($arResult['OBJECTS']))?></div>
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
                            <a class="link projects__all" href="/objects/">Все проекты</a></div>
                        <div class="col-8 col-md-7">
                            <div class="col__fix-right d-md-flex justify-content-between projects__sliders-wrapper">
                                <?if (count($arResult['OBJECTS'])<4){
                                    $iCountSlider = count($arResult['OBJECTS']);
                                }else{
                                    $iCountSlider =4;
                                }
                                ?>
                                <?for ($i=0; $i<$iCountSlider; $i++):?>
                                    <div class="swiper-container projects__swiper-container">
                                        <div class="swiper-wrapper projects__swiper-wrapper">
                                            <?for ($j=0;$j<2;$j++):?>
                                                <?foreach ($arResult['OBJECTS'] as $arObject):?>
                                                    <a class="project swiper-slide projects__swiper-slide" href="<?=$arObject['DETAIL_PAGE_URL']?>">
                                                        <div class="project__space"></div>
                                                        <div class="project__wrapper">
                                                            <div class="project__bg-wrapper">
                                                                <img class="project__bg"
                                                                     src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                                     data-src="<?=$arObject['PICTURE_SLIDER']['SRC']?>"
                                                                     data-object-fit="cover"/>
                                                                <div class="project__shade"></div>
                                                            </div>
                                                            <div class="project__content">
                                                                <div class="project__text"><?=$arObject['PROPERTY_NAME_SLIDER_VALUE']?></div>
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
        <?endif;?>
        <?
        $APPLICATION->IncludeComponent(
            'only:mailer',
            'feedback',
            [
                'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('FEEDBACK','FEEDBACK'),
                'USE_CAPTCHA' => 'Y',
            ],
            $component
        );
        ?>
        <div class="static-footer"></div>
    </div>
</div>
