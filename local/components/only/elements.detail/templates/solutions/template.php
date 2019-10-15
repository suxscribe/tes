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
                    <img class="product-head__bg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?=$arResult['COMPOSITION_SECTION']['PICTURE']['SRC']?>"/>
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
        <!-- Карта с Составом решения-->
        <div class="product-section-1" data-product-section-1="data-product-section-1">
            <div class="product-map-slider product-map-slider_hide">
                <div class="mobile-slider-navigation mobile-slider-navigation_map mobile-slider-navigation_dark">
                    <div class="d-flex align-items-center mobile-slider-navigation__bar">
                        <div class="mobile-slider-navigation__current">01</div>
                        <div class="mobile-slider-navigation__progress"></div>
                        <div class="mobile-slider-navigation__total"><?printf('%02d',count($arResult['COMPOSITIONS']))?></div>
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

                <div class="product-map-slider__container">
                    <div class="swiper-container product-map-slider__slider">
                        <div class="container-fluid product-map-slider__fixed_top">
                            <div class="row">
                                <div class="col-md-4 product-map-slider__title-1"><?=$arResult['COMPOSITION_SECTION']['NAME']?></div>
                                <div class="col-4 product-map-slider__back">Вернуться на экран подстанции
                                    <svg>
                                        <use xlink:href="#arrow-left"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-wrapper">
                            <?foreach ($arResult['COMPOSITIONS'] as $iKey => $arComposition):?>
                                <div class="product-map-slide swiper-slide">
                                    <div class="container-fluid product-map-slide__container-fluid">
                                        <div class="row product-map-slide__row">
                                            <div class="col-sm-4 product-map-slide__image">
                                                <div class="product-map-slide__bg-wrapper">
                                                    <img class="product-map-slide__bg product-map-slide__bg_desktop"
                                                         src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                         data-src="<?=$arComposition['DETAIL_PICTURE']['SRC']?>"/>
                                                </div>
                                            </div>
                                            <img class="product-map-slide__bg product-map-slide__bg_mobile"
                                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                 data-src="<?=$arComposition['DETAIL_PICTURE']['SRC']?>"/>
                                            <div class="col-4 product-map-slide__col d-none d-md-block">
                                                <div class="product-map-slide__name splitText">
                                                    <?=$arComposition['NAME']?>
                                                </div>
                                                <?if (!empty($arComposition['PROPERTIES']['POWER']['VALUE'])):?>
                                                    <div class="product-map-slide__kw">
                                                        <?=$arComposition['PROPERTIES']['POWER']['VALUE']?>
                                                    </div>
                                                <?endif;?>
                                                <div class="product-map-slide__text">
                                                    <?=htmlspecialcharsback($arComposition['PREVIEW_TEXT'])?>
                                                </div>
                                                <?if (!empty($arComposition['PROPERTIES']['LINK']['VALUE'])):?>
                                                <a class="product-map-slide__link" href="<?=$arComposition['PROPERTIES']['LINK']['VALUE']?>">Подробнее</a>
                                                <?endif;?>
                                            </div>
                                            <div class="col-8 d-block d-sm-none">
                                                <div class="product-map-slide__title">
                                                    <?=$arComposition['NAME']?>
                                                </div>
                                                <div class="product-map-slide__desc">
                                                    <?=htmlspecialcharsback($arComposition['PREVIEW_TEXT'])?>
                                                </div>
                                                <div class="product-map-slide__toggle">
                                                    <span>Читать дальше</span>
                                                    <span>Скрыть</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?endforeach;?>
                        </div>

                        <div class="container-fluid product-map-slider__fixed_bottom">
                            <div class="row">
                                <div class="col-1 product-map-slider__navigation-col">
                                    <div class="slider-navigation slider-navigation_map">
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
                                <div class="col-5 offset-1">
                                    <div class="slider-pagination slider-pagination_map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-section-1__map">
                <div class="product-map">
                    <div class="product-map__bg-wrapper">
                        <div class="product-map__content">
                            <img class="product-map__bg product-map__bg_first" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?=$arResult['COMPOSITION_SECTION']['PICTURE']['SRC']?>" />
                            <?$iNumber = 1;?>
                            <?foreach ($arResult['COMPOSITIONS'] as $iKey => $arComposition):?>
                                <img class="product-map__bg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?=$arComposition['PREVIEW_PICTURE']['SRC']?>" data-image="<?=$iNumber?>" alt="<?=$arComposition['NAME']?>"/>
                                <?$iNumber ++;?>
                            <?endforeach;?>
                            <div class="product-map__pins">
                                <?$iNumber = 1;?>
                                <?foreach ($arResult['COMPOSITIONS'] as $iKey => $arComposition):?>
                                    <div class="product-map__pin" style="top:<?=$arComposition['PROPERTIES']['PIN_X']['VALUE']?>%;left:<?=$arComposition['PROPERTIES']['PIN_Y']['VALUE']?>%;" data-pin="<?=$iNumber?>">
                                        <div class="product-map__popup">
                                            <div class="product-map__popup-text">
                                                <?if (!empty($arComposition['PROPERTIES']['NAME_ON_MAP']['VALUE'])):?>
                                                    <?=$arComposition['PROPERTIES']['NAME_ON_MAP']['VALUE']?>
                                                <?else:?>
                                                    <?=$arComposition['NAME']?>
                                                <?endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <?$iNumber ++;?>
                                <?endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-section-1__content container-fluid">
                    <div class="row">
                        <div class="col-8 product-section-1__title-1"><?=$arResult['COMPOSITION_SECTION']['NAME']?></div>
                    </div>
                    <?if(!empty($arResult['PROPERTIES']['COMPOSITION_DESC']['VALUE']['TEXT'])):?>
                    <div class="row product-section-1__row">
                        <div class="col-xl-2 col-lg-4 col-md-4 col-8 product-section-1__desc">
                            <div class="product-section-1__text-1">
                                <?=htmlspecialcharsback($arResult['PROPERTIES']['COMPOSITION_DESC']['VALUE']['TEXT'])?>
                            </div>
                        </div>
                        <?if (!empty($arResult['PROPERTIES']['COMPOSITION_TABLE']['VALUE']['TEXT'])):?>
                        <div class="col-xl-6 col-lg-4 col-md-4 col-8 product-section-1__items">
                            <?=htmlspecialcharsback($arResult['PROPERTIES']['COMPOSITION_TABLE']['VALUE']['TEXT'])?>
                        </div>
                        <?endif;?>
                    </div>
                    <?endif;?>
                </div>
            </div>
        </div>
        <?if (!empty($arResult['PROPERTIES']['APPLICATION_STO_TEXT']['VALUE'])):?>
        <div class="info-block-3" data-navigation-trigger="data-navigation-trigger">
            <div class="info-block-3__content container-fluid">
                <div class="row info-block-3__row">
                    <div class="col-8 info-block-3__title-1">Применение</div>
                    <div class="col-md-4">
                        <div class="info-block-3__text-1">
                            <?=htmlspecialcharsback($arResult['PROPERTIES']['APPLICATION_LARGE_TEXT']['VALUE'])?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?if (!empty($arResult['PROPERTIES']['APPLICATION_STO_TEXT']['VALUE'])):?>
                            <div class="info-block-3__text-2">
                                <?=htmlspecialcharsback($arResult['PROPERTIES']['APPLICATION_STO_TEXT']['VALUE'])?>
                            </div>
                        <?endif;?>
                        <div class="info-block-3__text-3">
                            <?=htmlspecialcharsback($arResult['PROPERTIES']['APPLICATION_SMALL_TEXT']['VALUE'])?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?else:?>
        <div class="info-block-1 container-fluid info-block-1_offset-vertical"
             data-navigation-trigger="data-navigation-trigger">
            <div class="row">
                <div class="col-8 col-md-6 offset-md-1">
                    <div class="info-block-1__title">Применение</div>
                    <div class="info-block-1__text-1">
                        <?=htmlspecialcharsback($arResult['PROPERTIES']['APPLICATION_LARGE_TEXT']['VALUE'])?>
                    </div>
                    <div class="info-block-1__text-2">
                        <?=htmlspecialcharsback($arResult['PROPERTIES']['APPLICATION_SMALL_TEXT']['VALUE'])?>
                    </div>
                </div>
            </div>
        </div>
        <?endif;?>
        <?if (!empty($arResult['EXECUTIONS'])):?>
        <div class="applied-performances">
            <div class="container-fluid">
                <div class="applied-performances__bg-text"/><?=$arResult['NAME']?></div>
                <div class="row">
                    <div class="col-8 col-md-6 offset-md-1">
                        <div class="applied-performances__title">Применяемые исполнения</div>
                        <div class="applied-performances__text">В зависимости от назначения и технических
                            параметров <?=$arResult['NAME']?> разделяются на следующие исполнения
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 offset-1">
                        <div class="solutions-navigation d-none d-md-block solutions-navigation_applied-performances">
                            <div class="container-fluid solutions-navigation__container-fluid">
                                <div class="row solutions-navigation__row">
                                    <div class="col-2 solutions-navigation__col">
                                        <?$iCount=0;?>
                                        <?foreach ($arResult['EXECUTIONS'] as $arExec):?>
                                        <div class="solutions-navigation__item <?=($iCount==0)? 'active':''?>" data-index="<?=$iCount?>">
                                            <?=$arExec['NAME']?>
                                        </div>
                                        <?$iCount++;?>
                                        <?endforeach;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 offset-md-1">
                        <div class="swiper-container applied-performances__slider">
                            <div class="swiper-wrapper">
                                <?foreach ($arResult['EXECUTIONS'] as $arExec):?>
                                <div class="swiper-slide applied-performances__item">
                                    <div class="applied-performances__item-title-1"><?=$arExec['PROPERTIES']['POWER']['VALUE']?></div>
                                    <div class="applied-performances__item-title-2">
                                        <?=$arExec['PREVIEW_TEXT']?>
                                    </div>
                                    <div class="applied-performances__item-text">
                                        <?=htmlspecialcharsback($arExec['DETAIL_TEXT'])?>
                                    </div>
                                </div>
                                <?endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-slider-navigation">
                <div class="d-flex align-items-center mobile-slider-navigation__bar">
                    <div class="mobile-slider-navigation__current">01</div>
                    <div class="mobile-slider-navigation__progress"></div>
                    <div class="mobile-slider-navigation__total"><?printf('%02d',count($arResult['EXECUTIONS']))?></div>
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
        <?endif;?>
        <?if (!empty($arResult['PROPERTIES']['EXECUTION_NAME_1']['VALUE']) && !empty($arResult['PROPERTIES']['EXECUTION_NAME_2']['VALUE'])):?>
        <div class="two-columns">
            <div class="container-fluid">
                <div class="row two-columns__row">
                    <div class="col-md-4 two-columns__column two-columns__column_left">
                        <div class="info-block-4">
                            <div class="info-block-4__title"><?=$arResult['PROPERTIES']['EXECUTION_NAME_1']['VALUE']?></div>
                            <div class="info-block-4__text"><?=$arResult['PROPERTIES']['EXECUTION_NAME_1']['VALUE']?> оптимально подходят в качестве:</div>
                            <?=htmlspecialcharsback($arResult['PROPERTIES']['EXECUTION_DESC_1']['VALUE']['TEXT'])?>
                        </div>
                    </div>
                    <div class="col-md-4 two-columns__column two-columns__column_right">
                        <div class="info-block-4">
                            <div class="info-block-4__title"><?=$arResult['PROPERTIES']['EXECUTION_NAME_2']['VALUE']?></div>
                            <div class="info-block-4__text"><?=$arResult['PROPERTIES']['EXECUTION_NAME_2']['VALUE']?> оптимально подходят в качестве:</div>
                            <?=htmlspecialcharsback($arResult['PROPERTIES']['EXECUTION_DESC_2']['VALUE']['TEXT'])?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?endif;?>
        <div class="construct" data-page-nav-item="Конструкция" data-navigation-trigger="data-navigation-trigger">
            <div class="construct__content container-fluid">
                <div class="row construct__row">
                    <div class="col-8 construct__title-1">Конструкция</div>
                    <div class="col-8">
                        <div class="spoiler-list spoiler-list_construct" id="construct">
                            <!-- ITEM -->
                            <?foreach ($arResult['STRUCTURE'] as $iID => $arStructure):?>
                            <div class="spoiler spoiler-list__item">
                                <div class="spoiler__header collapsed" data-toggle="collapse"
                                     href="#construct-<?=$iID?>" aria-expanded="true">
                                    <div class="spoiler__title">
                                        <?=$arStructure['NAME']?>
                                        <div class="spoiler__plus"></div>
                                    </div>
                                </div>
                                <div class="collapse" id="construct-<?=$iID?>">
                                    <div class="spoiler__content">
                                        <?=$arStructure['PREVIEW_TEXT']?>
                                        <?if (!empty($arStructure['PROPERTIES']['PHOTOS']['VALUE'])):?>
                                            <div class="row spoiler__row spoiler__row_images">
                                                <?foreach ($arStructure['PROPERTIES']['PHOTOS']['VALUE'] as $iPhoto):?>
                                                    <div class="col-xl-4 spoiler__image">
                                                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?=$iPhoto['SRC']?>" alt="<?=$arStructure['NAME']?>"/>
                                                    </div>
                                                <?endforeach;?>
                                            </div>
                                        <?endif;?>

                                        <?if (!empty($arStructure['PROPERTIES']['ELEMENTS']['VALUE'])):?>
                                            <?foreach ($arStructure['PROPERTIES']['ELEMENTS']['VALUE'] as $arChildItem):?>
                                                <div class="spoiler__row">
                                                    <h3><?=$arChildItem['NAME']?></h3>
                                                    <?=$arChildItem['PREVIEW_TEXT']?>
                                                    <?if (!empty($arChildItem['PROPERTIES']['LINK']['VALUE'])):?>
                                                    <a class="link spoiler__link" href="<?=$arChildItem['PROPERTIES']['LINK']['VALUE']?>" >Подробнее</a>
                                                    <?endif;?>
                                                </div>
                                                <?if (!empty($arChildItem['PROPERTIES']['PHOTOS']['VALUE'])):?>
                                                    <div class="row spoiler__row spoiler__row_images">
                                                    <?foreach ($arChildItem['PROPERTIES']['PHOTOS']['VALUE'] as $iPhoto):?>
                                                        <div class="col-xl-4 spoiler__image">
                                                            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?=$iPhoto['SRC']?>" alt="<?=$arChildItem['NAME']?>"/>
                                                        </div>
                                                    <?endforeach;?>
                                                    </div>
                                                <?endif;?>
                                            <?endforeach;?>
                                        <?endif;?>
                                    </div>
                                </div>
                            </div>
                            <?endforeach;?>
                            <!-- END ITEM-->
                        </div>
                    </div>
                    <?if  (!empty($arResult['STRUCTURE_SECTION']['DESCRIPTION'])):?>
                    <div class="col-8 construct__title-2">
                        <?=$arResult['STRUCTURE_SECTION']['DESCRIPTION']?>
                    </div>
                    <?endif;?>
                </div>
            </div>
        </div>
        <?if (!empty($arResult['PROPERTIES']['DOCUMENTS']['VALUE'])):?>
        <div class="documents" data-page-nav-item="Документы">
            <div class="container-fluid">
                <div class="row documents__row">
                    <?if (count($arResult['PROPERTIES']['DOCUMENTS']['VALUE'])>1):?>
                    <div class="col-xl-2 col-md-4 documents__main">
                        <div class="documents__title-1">Документы</div>
                        <div class="documents__text-1">Подробную информацию по <?=$arResult['NAME']?> можно найти в документах
                        </div>
                    </div>
                    <?foreach ($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as $arDocument):?>
                    <div class="document col-xl-2 col-md-4 documents__document">
                        <div class="document__wrapper">
                            <div class="document__title-1"><?=$arDocument['DESCRIPTION']?></div>
                            <div class="document__bottom">
                                <a class="document__link" href="<?=$arDocument['SRC']?>" target="_blank">
                                    Скачать
                                    (<?=$arDocument['FILE_SIZE']?>, <?=$arDocument['EXT']?>)
                                </a>
                            </div>
                        </div>
                    </div>
                    <?endforeach;?>
                    <?elseif (count($arResult['PROPERTIES']['DOCUMENTS']['VALUE'])==1):?>
                    <div class="col-xl-2 col-md-4 documents__main documents__main_single">
                        <div class="documents__title-1">Документы</div>
                        <div class="documents__text-1">Подробную информацию по <?=$arResult['NAME']?> можно найти в документах
                        </div>
                    </div>
                    <?$arDocument = array_shift($arResult['PROPERTIES']['DOCUMENTS']['VALUE']);?>
                    <div class="document col-md-4 document_single documents__document">
                        <div class="document__wrapper">
                            <div class="document__title-1"><?=$arDocument['DESCRIPTION']?></div>
                            <div class="document__bottom">
                                <a class="document__link" href="<?=$arDocument['SRC']?>" target="_blank">
                                    (<?=$arDocument['FILE_SIZE']?>, <?=$arDocument['EXT']?>)
                                </a>
                            </div>
                        </div>
                    </div>
                    <?endif;?>
                    <div class="col-8 documents__text-2">Сформулируйте задачу.<br> Все работы по строительству
                        выполнят наши специалисты
                    </div>
                </div>
            </div>
        </div>
        <?endif;?>
        <div class="advantages" data-page-nav-item="Преимущества">
            <svg class="gradient advantages__bg" width="100%" height="100%" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <rect width="100%" height="100%" fill="#34C5B8"></rect>
                <rect width="100%" height="100%" fill="url(#paint0_radial)" fill-opacity="0.65"></rect>
                <defs>
                    <radialgradient id="paint0_radial" cx="0" cy="0" r="1" gradientunits="userSpaceOnUse"
                                    gradienttransform="translate(810 374.5) rotate(90) scale(750.04 1622.25)">
                        <stop stop-color="white" stop-opacity="0"></stop>
                        <stop offset="0.892931" stop-color="#283D56"></stop>
                    </radialgradient>
                </defs>
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
                                <div class="mobile-slider-navigation__total"><?printf("%02d", count($arResult['PROPERTIES']['ADVANTAGE']['VALUE']));?></div>
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
                                    <?foreach ($arResult['PROPERTIES']['ADVANTAGE']['VALUE'] as $iKey => $arAdvantage):?>
                                        <div class="advantage swiper-slide">
                                            <div class="advantage__wrapper">
                                                <div class="advantage__count"><?printf("%02d", $iKey+1)?></div>
                                                <div class="advantage__title"><?=$arResult['PROPERTIES']['ADVANTAGE']['DESCRIPTION'][$iKey]?></div>
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
        <?if (!empty($arResult['PROPERTIES']['TEH_SOLUTION_TITLE']['VALUE'])):?>
        <div class="specifications">
            <div class="specifications__content container-fluid container-fluid_fix-right_mobile">
                <div class="row specifications__row">
                    <div class="col-8 specifications__title-1">
                        <?=$arResult['PROPERTIES']['TEH_SOLUTION_TITLE']['VALUE']?>
                    </div>
                    <div class="col-8">
                        <div class="specifications-list specifications-list_columns-3">
                            <div class="table-responsive-sm">
                                <?=htmlspecialcharsback($arResult['PROPERTIES']['TEH_SOLUTION']['VALUE']['TEXT'])?>
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
        <?elseif (!empty($arResult['PROPERTIES']['SPECIFICATIONS_TITLE']['VALUE'])):?>
            <div class="specifications">
                <div class="specifications__content container-fluid container-fluid_fix-right_mobile">
                    <div class="row specifications__row">
                        <div class="col-8 specifications__title-1">
                            <?=$arResult['PROPERTIES']['SPECIFICATIONS_TITLE']['VALUE']?>
                        </div>
                        <div class="col-8">
                            <div class="specifications-list specifications-list_columns-3">
                                <div class="table-responsive-sm">
                                    <?=htmlspecialcharsback($arResult['PROPERTIES']['SPECIFICATIONS']['VALUE']['TEXT'])?>
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
        <?if (!empty($arResult['PROPERTIES']['TEH_SOLUTION_TITLE']['VALUE']) && !empty($arResult['PROPERTIES']['SPECIFICATIONS_TITLE']['VALUE'])):?>
        <div class="specifications" data-page-nav-item="Характеристики">
            <div class="specifications__content container-fluid container-fluid_fix-right_mobile">
                <div class="row specifications__row">
                    <div class="col-8 specifications__title-1">
                        <?=$arResult['PROPERTIES']['SPECIFICATIONS_TITLE']['VALUE']?>
                    </div>
                    <div class="col-8">
                        <div class="specifications-list specifications-list_columns-4">
                            <div class="table-responsive-sm">
                                <?=htmlspecialcharsback($arResult['PROPERTIES']['SPECIFICATIONS']['VALUE']['TEXT'])?>
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
        <div class="naming-structure" data-page-nav-item="Обозначения">
            <div class="naming-structure__content container-fluid">
                <div class="row">
                    <div class="col-md-7 offset-md-1 naming-structure__title-1">Структура обозначения</div>
                    <div class="col-md-7 offset-md-1">
                        <div class="naming-structure__structure">
                            <?$iNumber=1;?>
                            <?foreach ($arResult['PROPERTIES']['DESIGNATIONS']['VALUE'] as $iKey => $sVal):?>
                            <?
                            if(!empty($arResult['PROPERTIES']['DESIGNATIONS']['DESCRIPTION'][$iKey])){
                                $sClass = 'naming-structure__item_active';
                            }else{
                                $sClass = 'naming-structure__item_default';
                            }
                            ?>
                            <div class="naming-structure__item <?=$sClass?>" data-item="<?=$iKey+1?>">
                                <?=$sVal?>
                                <? if(!empty($arResult['PROPERTIES']['DESIGNATIONS']['DESCRIPTION'][$iKey])):?>
                                <div class="naming-structure__count"><?printf("%02d", $iNumber)?></div>
                                    <?$iNumber++;?>
                                <?endif;?>
                            </div>
                            <?if ($iKey+1!=count($arResult['PROPERTIES']['DESIGNATIONS']['VALUE'])):?>
                            <div class="naming-structure__item">—</div>
                            <?endif;?>
                            <?endforeach;?>
                        </div>
                        <div class="naming-structure__descriptions">
                            <?foreach ($arResult['PROPERTIES']['DESIGNATIONS']['DESCRIPTION'] as $iKey => $sVal):?>
                            <div class="naming-structure__description" data-desc="<?=$iKey+1?>">
                                <?=$sVal?>
                            </div>
                            <?endforeach;?>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-1">
                        <div class="spoiler-list naming-structure__spoiler-list" id="naming">
                            <div class="spoiler spoiler-list__item">
                                <div class="spoiler__header collapsed" data-toggle="collapse" href="#naming-0"
                                     aria-expanded="true">
                                    <div class="spoiler__title">Пример обозначения
                                        <div class="spoiler__plus"></div>
                                    </div>
                                </div>
                                <div class="collapse" id="naming-0">
                                    <div class="spoiler__content">
                                        <div class="spoiler__row">
                                            <?foreach ($arResult['PROPERTIES']['DESIGNATIONS_EXAMPLE']['VALUE'] as $sDesc):?>
                                            <p><?=$sDesc?></p>
                                            <?endforeach;?>
                                            <h3>Расшифровка:</h3>
                                            <?=htmlspecialcharsback($arResult['PROPERTIES']['DESIGNATIONS_DESCRIPTION']['VALUE']['TEXT'])?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- -->
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
</div><!-- END product-tail -->
