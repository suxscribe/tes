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
                    <img class="product-head__bg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?=$arResult['DETAIL_PICTURE']['SRC']?>"/>
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
        <div class="info-block-1 container-fluid info-block-1_offset-vertical" data-page-nav-item="Применение" data-navigation-trigger="data-navigation-trigger">
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
        <!-- IF -->
        <?if (!empty($arResult['PROPERTIES']['CONTENTS']['VALUE'])):?>
        <div class="competence container-fluid d-none d-md-block competence_offset-vertical" data-page-nav-item="Комплектация">
            <div class="row competence__content">
                <svg class="competence__bg">
                    <use xlink:href="#gradient"></use>
                </svg>
                <div class="competence__bg-text">Комплект</div>
                <div class="competence__left col-md-6 col-xl-2 offset-md-1">
                    <div class="competence__text">Типовой комплект поставки содержит</div>
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
                                <?
                                $arRows = array_chunk($arResult['PROPERTIES']['CONTENTS']['VALUE'], 3);
                                $iNumber = 1;
                                ?>
                                <?foreach ($arRows as $arRow):?>
                                <div class="swiper-slide">
                                    <?foreach ($arRow as $arItem):?>
                                    <div class="competence-item">
                                        <div class="competence-item__index"><?printf('%02d',$iNumber);?></div>
                                        <div class="competence-item__text"><?=$arItem['TEXT']?></div>
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
            <?
            $arRows = array_chunk($arResult['PROPERTIES']['CONTENTS']['VALUE'], 2);
            $iCount = count($arRows);
            ?>
        <div class="competence-mobile d-md-none">
            <div class="container-fluid competence-mobile__wrapper">
                <svg class="competence-mobile__bg">
                    <use xlink:href="#gradient"></use>
                </svg>
                <div class="mobile-slider-navigation">
                    <div class="d-flex align-items-center mobile-slider-navigation__bar">
                        <div class="mobile-slider-navigation__current">01</div>
                        <div class="mobile-slider-navigation__progress"></div>
                        <div class="mobile-slider-navigation__total"><?printf('%02d',$iCount);?></div>
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
                    <div class="competence-mobile__title">Типовой комплект поставки содержит</div>
                    <div class="swiper-container competence-mobile__swiper">
                        <div class="swiper-wrapper">
                            <?$iNumber=1;?>
                            <?foreach ($arRows as $arRow):?>
                            <div class="swiper-slide">
                                <?foreach ($arRow as $arItem): ?>
                                <div class="competence-item">
                                    <div class="competence-item__index"><?printf('%02d',$iNumber);?></div>
                                    <div class="competence-item__text"><?=$arItem['TEXT']?></div>
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
        <div class="container-fluid oru-35-page__text-1">
            <div class="row">
                <div class="col-md-6 offset-md-1 tpg__p1 tpg__p1_big-offset">Комплект поставки индивидуален: определяется договором
                    с&nbsp;заказчиком и&nbsp;проектной документацией. Полный пакет сопроводительной технической
                    документации включает вспомогательные схемы на&nbsp;каждый блок
                </div>
            </div>
        </div>
        <?endif;?>

        <div class="block-types" data-page-nav-item="Типы блоков">
            <div class="info-block-1 container-fluid">
                <div class="row">
                    <div class="col-8 col-md-6 offset-md-1">
                        <div class="info-block-1__title">Типы блоков <?=$arResult['NAME']?> <?=$arResult['PROPERTIES']['POWER']['VALUE']?></div>
                        <div class="info-block-1__text-2">
                            <?=$arResult['PROPERTIES']['TYPES_OF_BLOCKS_DESC_BEFORE']['VALUE']?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block-types__items">
                <?foreach ($arResult['TYPES_OF_BLOCKS'] as $arItem):?>
                <div class="info-block-5 container-fluid">
                    <div class="row">
                        <div class="col-8 col-md-6 col-xl-3 info-block-5__col-1">
                            <img class="info-block-5__img" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"/>
                        </div>
                        <div class="col-8 col-md-6 col-xl-3 info-block-5__col-2">
                            <div class="info-block-5__title"><?=$arItem['NAME']?></div>
                            <div class="info-block-5__text">
                                <?=$arItem['PREVIEW_TEXT']?>
                            </div>
                        </div>
                    </div>
                </div>
                <?endforeach;?>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 offset-md-1 block-types__text">
                        <?=$arResult['PROPERTIES']['TYPES_OF_BLOCKS_DESC_AFTER']['VALUE']?>
                    </div>
                </div>
            </div>
        </div>
        <div class="documents documents_3-doc" data-page-nav-item="Документы">
            <div class="container-fluid">
                <div class="row documents__row">
                    <div class="col-md-3 col-xl-2 offset-xl-1 documents__title-1 d-flex align-items-center">Документы
                    </div>
                    <div class="col-md-5 col-xl-4 documents__text-1 d-flex align-items-center">Подробную
                        информацию по&nbsp;ОРУ можно найти в&nbsp;документах
                    </div>
                    <?foreach ($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as $arDocument):?>
                    <div class="document col-xl-2 col-md-4 documents__document">
                        <div class="document__wrapper">
                            <div class="document__title-1">
                                <?=$arDocument['DESCRIPTION']?>
                            </div>
                            <div class="document__bottom"><a class="document__link" href="<?=$arDocument['SRC']?>" target="_blank">Скачать
                                    (<?=$arDocument['FILE_SIZE']?>, <?=$arDocument['EXT']?>)</a>
                            </div>
                        </div>
                    </div>
                    <?endforeach;?>
                </div>
            </div>
        </div>
        <?if (!empty($arResult['STRUCTURE'])):?>
        <?$arFirstStructure = array_shift($arResult['STRUCTURE']);?>
        <div class="info-block-6" data-page-nav-item="Конструкция">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 offset-md-1">
                        <div class="info-block-6__title">Конструкция</div>
                        <img class="info-block-6__img"
                             src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                             data-src="<?=$arFirstStructure['PHOTO']['SRC']?>"/>
                        <div class="info-block-6__text">
                            <?=$arFirstStructure['PREVIEW_TEXT']?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info-block-6__items">
                <?foreach ($arResult['STRUCTURE'] as $arStructure):?>
                <div class="info-block-5 container-fluid">
                    <div class="row">
                        <div class="col-8 col-md-6 col-xl-3 info-block-5__col-1">
                            <img class="info-block-5__img" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?=$arStructure['PHOTO']['SRC']?>"/>
                        </div>
                        <div class="col-8 col-md-6 col-xl-3 info-block-5__col-2">
                            <div class="info-block-5__text">
                                <?=$arStructure['PREVIEW_TEXT']?>
                            </div>
                        </div>
                    </div>
                </div>
                <?endforeach;?>
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
                                        <div class="mobile-slider-navigation__total"><?printf("%02d", count($arResult['PROPERTIES']['PHOTOS']['VALUE']));?></div>
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
                                    <div class="swiper-container gallery__swiper-container">
                                        <div class="swiper-wrapper gallery__swiper-wrapper">
                                            <?foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $arPhoto):?>
                                                <div class="swiper-slide gallery__swiper-slide">
                                                    <div class="gallery__space"></div>
                                                    <div class="gallery__wrapper">
                                                        <div class="gallery__bg-wrapper">
                                                            <img class="gallery__bg"
                                                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                                 data-object-fit="cover"
                                                                 data-src="<?=$arPhoto['SRC']?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?endforeach;?>
                                        </div>
                                    </div>
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
                                </div>
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
