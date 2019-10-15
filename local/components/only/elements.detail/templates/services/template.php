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

$APPLICATION->SetPageProperty('BARBA_NAMESPASE', 'service');
?>
<div class="info-block-8 container-fluid">
    <h1 class="col-8 col-md-6 offset-md-1 info-block-8__title tpg__title">
        <?=$arResult['NAME']?>
    </h1>
    <div class="info-block-8__bg-wrapper">
        <img class="info-block-8__bg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" data-object-fit="cover"/>
    </div>
</div>
<div class="info-block-1 container-fluid info-block-1_offset-vertical-top">
    <div class="row">
        <div class="col-8 col-md-6 offset-md-1">
            <div class="info-block-1__title">Описание</div>
            <div class="info-block-1__text-1">
                <?=htmlspecialcharsback($arResult['PREVIEW_TEXT'])?>
            </div>
            <div class="info-block-1__text-2">
                <?=htmlspecialcharsback($arResult['DETAIL_TEXT'])?>
            </div>
        </div>
    </div>
</div>
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
                        <?for ($i=0; $i<3; $i++):?>
                        <div class="swiper-container gallery__swiper-container">
                            <div class="swiper-wrapper gallery__swiper-wrapper">
                                <?foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $arPhoto):?>
                                <div class="swiper-slide gallery__swiper-slide">
                                    <div class="gallery__space"></div>
                                    <div class="gallery__wrapper">
                                        <div class="gallery__bg-wrapper">
                                            <img class="gallery__bg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?=$arPhoto['SRC']?>" data-object-fit="cover"/>
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
<?if (!empty($arResult['PROPERTIES']['STAGES']['VALUE'])):?>
<div class="competence container-fluid d-none d-md-block">
    <div class="row competence__text-top">
        <?if (!empty($arResult['PROPERTIES']['STAGES_TEXT_LARGE']['VALUE'])):?>
        <div class="col-8 col-md-6 offset-md-1">
            <?=htmlspecialcharsback($arResult['PROPERTIES']['STAGES_TEXT_LARGE']['VALUE']['TEXT'])?>
        </div>
        <?endif;?>
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
                        <?$arRowStages = array_chunk($arResult['PROPERTIES']['STAGES']['VALUE'], 3);?>
                        <?$iNumber = 1;?>
                        <?foreach ($arRowStages as $arItems):?>
                        <div class="swiper-slide">
                            <?foreach ($arItems as $sItem):?>
                            <div class="competence-item">
                                <div class="competence-item__index"><?printf('%02d',$iNumber);?></div>
                                <div class="competence-item__text"><?=$sItem?></div>
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
        <?if (!empty($arResult['PROPERTIES']['STAGES_TEXT_LARGE']['VALUE'])):?>
            <div class="competence-mobile__text">
                <?=htmlspecialcharsback($arResult['PROPERTIES']['STAGES_TEXT_LARGE']['VALUE']['TEXT'])?>
            </div>
        <?endif;?>
        <div class="container-fluid competence-mobile__wrapper">
            <svg class="competence-mobile__bg">
                <use xlink:href="#gradient"></use>
            </svg>
            <div class="mobile-slider-navigation">
                <div class="d-flex align-items-center mobile-slider-navigation__bar">
                    <div class="mobile-slider-navigation__current">01</div>
                    <div class="mobile-slider-navigation__progress"></div>
                    <div class="mobile-slider-navigation__total"><?printf('%02d',round(count($arResult['PROPERTIES']['STAGES']['VALUE'])/2))?></div>
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
                        <?$arRowStages = array_chunk($arResult['PROPERTIES']['STAGES']['VALUE'], 2);?>
                        <?$iNumber = 1;?>
                        <?foreach ($arRowStages as $arItems):?>
                            <div class="swiper-slide">
                                <?foreach ($arItems as $sItem):?>
                                    <div class="competence-item">
                                        <div class="competence-item__index"><?printf('%02d',$iNumber);?></div>
                                        <div class="competence-item__text"><?=$sItem?></div>
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
<?else:?>
<div class="container-fluid service-2__text-1">
    <div class="row">
        <?if (!empty($arResult['PROPERTIES']['STAGES_TEXT_LARGE']['VALUE'])):?>
            <div class="col-md-6 offset-md-1 tpg__p1">
                <?=htmlspecialcharsback($arResult['PROPERTIES']['STAGES_TEXT_LARGE']['VALUE']['TEXT'])?>
            </div>
        <?endif;?>
        <?if (!empty($arResult['PROPERTIES']['STAGES_TEXT_SMALL']['VALUE'])):?>
            <div class="col-md-6 offset-md-1 tpg__p2">
                <?=htmlspecialcharsback($arResult['PROPERTIES']['STAGES_TEXT_SMALL']['VALUE']['TEXT'])?>
            </div>
        <?endif;?>
    </div>
</div>
<?endif;?>

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

                            <?foreach ($arResult['PROPERTIES']['ADVANTAGE']['VALUE'] as $iKey => $arAdvantage):?>

                            <div class="advantage swiper-slide advantage_dark">
                                <div class="advantage__wrapper">
                                    <div class="advantage__count"><?printf('%02d',$iKey+1)?></div>
                                    <div class="advantage__title">
                                        <?=$arResult['PROPERTIES']['ADVANTAGE']['DESCRIPTION'][$iKey]?>
                                    </div>
                                    <div class="advantage__text">
                                        <?=htmlspecialcharsback($arAdvantage['TEXT'])?>
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
<?if (!empty($arResult['PROPERTIES']['DOCUMENTS']['VALUE'])):?>
<div class="documentation-certificates container-fluid">
    <div class="row">
        <div class="col-8 col-md-6 offset-md-1 documentation-certificates__title tpg__title-2">Лицензии и&nbsp;сертификаты</div>
    </div>
    <div class="row">
        <div class="col-md-7 col-xl-2 offset-md-1 documentation-certificates__text tpg__p2">Компетенция компании
            в&nbsp;оказании проектно-изыскательских работ подтверждена соответствующими свидетельствами СРО
        </div>
        <div class="col-md-7 col-xl-5 offset-xl-0 offset-md-1">
            <?foreach ($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as $arDocument):?>
            <div class="documentation-certificates__item">
                <div class="documentation-certificates__item-title">
                    <?=$arDocument['DESCRIPTION']?>
                </div>
                <a class="documentation-certificates__item-link" href="<?=$arDocument['SRC']?>" target="_blank">
                    Скачать (<?=$arDocument['EXT']?>, <?=$arDocument['FILE_SIZE']?>)
                </a>
            </div>
            <?endforeach;?>
        </div>
    </div>
</div>
<?endif;?>

<?if (!empty($arResult['OBJECTS'])):?>
    <div class="projects projects_product projects_services" data-page-nav-item="Проекты">
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
<?if (!empty($arResult['NEXT'])):?>
<div class="adjacent-page container-fluid">
    <div class="adjacent-page__content">
        <img class="adjacent-page__bg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?=$arResult['NEXT']['DETAIL_PICTURE']['SRC']?>" data-object-fit="cover"/>
        <div class="row">
            <div class="col-8 col-md-6 col-xl-2 offset-md-2 offset-xl-1 adjacent-page__link-wrapper"><a
                    class="adjacent-page__link adjacent-page__link_back" href="<?=$arResult['IBLOCK']['LIST_PAGE_URL']?>">Назад к услугам
                    <svg class="adjacent-page__arrow-svg">
                        <use xlink:href="#arrow-left"></use>
                    </svg>
                </a>
            </div>
            <div class="col-8 col-md-5 col-xl-4 offset-md-2 offset-xl-0 adjacent-page__link-wrapper">
                <div class="adjacent-page__title-1">Следующая услуга
                    <svg class="adjacent-page__arrow-svg adjacent-page__arrow-svg_mobile">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </div>
                <div class="adjacent-page__title-2">
                    <?=$arResult['NEXT']['NAME']?>
                </div>
                <a class="adjacent-page__link adjacent-page__link_next" href="<?=$arResult['NEXT']['DETAIL_PAGE_URL']?>">Перейти
                    <svg class="adjacent-page__arrow-svg">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </a>
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
