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
<div class="news-modal-list">
<div class="modal fade news-modal-popup news-modal__modal" id="modalPreview1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="news-modal-popup__content"><img class="news-modal-popup__content-img" src=
            "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src=
            "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-object-fit="cover"></div>
            <div class="sandwich-menu-close sandwich-menu__close modal__close" data-dismiss="modal">
                <div class="sandwich-menu-close__line sandwich-menu-close__line_top"></div>
                <div class="sandwich-menu-close__line sandwich-menu-close__line_bottom"></div>
            </div>
        </div>
    </div>
</div>
<div class="info-block-8 container-fluid info-block-8_title-mobile-small">
    <h1 class="col-8 col-md-6 offset-md-1 info-block-8__title tpg__title">
        <?=$arResult['NAME']?>
    </h1>
    <div class="info-block-8__bg-wrapper">
        <img class="info-block-8__bg"
             src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
             data-src="<?=$arResult['DETAIL_PICTURE']['SRC']?>"
             data-object-fit="cover"/>
    </div>
</div>
<div class="info-block-1 container-fluid info-block-1_offset-vertical-top">
    <div class="row">
        <div class="col-8 col-md-6 offset-md-1">
            <div class="info-block-1__text-1">
                <?=htmlspecialcharsback($arResult['PREVIEW_TEXT'])?>
            </div>
            <?if (!empty($arResult['DETAIL_TEXT'])):?>
            <div class="info-block-1__text-2 info-block-1__text-2_bottom-offset">
                <?=htmlspecialcharsback($arResult['DETAIL_TEXT'])?>
            </div>
            <?endif;?>
        </div>
    </div>
</div>
<?if (!empty($arResult['PROPERTIES']['IMAGE_PART_1']['VALUE']['SRC']) || !empty($arResult['PROPERTIES']['TEXT_PART_1']['VALUE']['TEXT'])):?>
<div class="info-block-5 container-fluid info-block-5_detail info-block-5_detail-reverse">
    <div class="row">
        <?if (!empty($arResult['PROPERTIES']['IMAGE_PART_1']['VALUE']['SRC'])):?>
        <div class="col-8 col-md-6 col-xl-3 info-block-5__col-1 news-modal-list__modal news-modal" data-toggle="modal" data-img="<?=$arResult['PROPERTIES']['IMAGE_PART_1']['VALUE']['SRC']?>">
            <img class="info-block-5__img"
                 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                 data-src="<?=$arResult['PROPERTIES']['IMAGE_PART_1']['VALUE']['SRC']?>"/>
        </div>
        <?endif;?>
        <?if (!empty($arResult['PROPERTIES']['TEXT_PART_1']['VALUE']['TEXT'])):?>
        <div class="col-8 col-md-6 col-xl-3 info-block-5__col-2">
            <div class="info-block-5__text info-block-5__text_large-font info-block-5__text_no-offset">
                <?=htmlspecialcharsback($arResult['PROPERTIES']['TEXT_PART_1']['VALUE']['TEXT'])?>
            </div>
        </div>
        <?endif;?>
    </div>
</div>
<?endif;?>
<?if (!empty($arResult['PROPERTIES']['TEXT_PART_2_LARGE']['VALUE']['TEXT'])):?>
<div class="info-block-1 container-fluid info-block-1_offset-vertical-top_less">
    <div class="row">
        <div class="col-8 col-md-6 offset-md-1">
            <div class="info-block-1__text-1">
                <?=htmlspecialcharsback($arResult['PROPERTIES']['TEXT_PART_2_LARGE']['VALUE']['TEXT'])?>
            </div>
        </div>
    </div>
</div>
<?endif;?>
<?if (!empty($arResult['PROPERTIES']['IMAGE_PART_2']['VALUE']) || !empty($arResult['PROPERTIES']['TEXT_PART_2_SMALL']['VALUE']['TEXT'])):?>
<div class="info-block-5 container-fluid info-block-5_detail">
    <div class="row">
        <?if (!empty($arResult['PROPERTIES']['IMAGE_PART_2']['VALUE'])):?>
        <div class="col-8 col-md-6 col-xl-3 info-block-5__col-1 news-modal-list__modal news-modal" data-toggle="modal" data-img="<?=$arResult['PROPERTIES']['IMAGE_PART_2']['VALUE']['SRC']?>">
            <img class="info-block-5__img"
                 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                 data-src="<?=$arResult['PROPERTIES']['IMAGE_PART_2']['VALUE']['SRC']?>"/>
        </div>
        <?endif;?>
        <?if (!empty($arResult['PROPERTIES']['TEXT_PART_2_SMALL']['VALUE']['TEXT'])):?>
        <div class="col-8 col-md-6 col-xl-3 info-block-5__col-2">
            <div class="info-block-5__text info-block-5__text_large-font info-block-5__text_no-offset">
                <?=htmlspecialcharsback($arResult['PROPERTIES']['TEXT_PART_2_SMALL']['VALUE']['TEXT'])?>
            </div>
        </div>
        <?endif;?>
    </div>
</div>
<?endif;?>
<?if (!empty($arResult['PROPERTIES']['TEXT_PART_3']['VALUE']['TEXT']) && empty($arResult['PROPERTIES']['IMAGE_PART_3']['VALUE']['SRC'])):?>
<div class="info-block-1 info-block-1_margin-bottom container-fluid">
    <div class="row">
        <div class="col-8 col-md-6 offset-md-1">
            <div class="info-block-1__text-2">
                <?=htmlspecialcharsback($arResult['PROPERTIES']['TEXT_PART_3']['VALUE']['TEXT'])?>
            </div>
        </div>
    </div>
</div>
<?elseif(!empty($arResult['PROPERTIES']['IMAGE_PART_3']['VALUE']['SRC']) || !empty($arResult['PROPERTIES']['TEXT_PART_3']['VALUE']['TEXT'])):?>
    <div class="info-block-5 container-fluid info-block-5_detail info-block-5_detail-reverse">
        <div class="row">
            <?if (!empty($arResult['PROPERTIES']['IMAGE_PART_3']['VALUE']['SRC'])):?>
                <div class="col-8 col-md-6 col-xl-3 info-block-5__col-1 news-modal-list__modal news-modal" data-toggle="modal" data-img="<?=$arResult['PROPERTIES']['IMAGE_PART_3']['VALUE']['SRC']?>">
                    <img class="info-block-5__img"
                         src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                         data-src="<?=$arResult['PROPERTIES']['IMAGE_PART_3']['VALUE']['SRC']?>"/>
                </div>
            <?endif;?>
            <?if (!empty($arResult['PROPERTIES']['TEXT_PART_3']['VALUE']['TEXT'])):?>
                <div class="col-8 col-md-6 col-xl-3 info-block-5__col-2">
                    <div class="info-block-5__text info-block-5__text_large-font info-block-5__text_no-offset">
                        <?=htmlspecialcharsback($arResult['PROPERTIES']['TEXT_PART_3']['VALUE']['TEXT'])?>
                    </div>
                </div>
            <?endif;?>
        </div>
    </div>
<?endif;?>

<?if (!empty($arResult['PROPERTIES']['TEXT_PART_4']['VALUE']['TEXT']) && empty($arResult['PROPERTIES']['IMAGE_PART_4']['VALUE']['SRC'])):?>
    <div class="info-block-1 container-fluid">
        <div class="row">
            <div class="col-8 col-md-6 offset-md-1">
                <div class="info-block-1__text-2">
                    <?=htmlspecialcharsback($arResult['PROPERTIES']['TEXT_PART_4']['VALUE']['TEXT'])?>
                </div>
            </div>
        </div>
    </div>
<?elseif(!empty($arResult['PROPERTIES']['IMAGE_PART_4']['VALUE']['SRC']) || !empty($arResult['PROPERTIES']['TEXT_PART_4']['VALUE']['TEXT'])):?>
    <div class="info-block-5 container-fluid info-block-5_detail info-block-5_detail-reverse">
        <div class="row">
            <?if (!empty($arResult['PROPERTIES']['IMAGE_PART_4']['VALUE']['SRC'])):?>
                <div class="col-8 col-md-6 col-xl-3 info-block-5__col-1 news-modal-list__modal news-modal" data-toggle="modal" data-img="<?=$arResult['PROPERTIES']['IMAGE_PART_4']['VALUE']['SRC']?>">
                    <img class="info-block-5__img"
                         src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                         data-src="<?=$arResult['PROPERTIES']['IMAGE_PART_4']['VALUE']['SRC']?>"/>
                </div>
            <?endif;?>
            <?if (!empty($arResult['PROPERTIES']['TEXT_PART_4']['VALUE']['TEXT'])):?>
                <div class="col-8 col-md-6 col-xl-3 info-block-5__col-2">
                    <div class="info-block-5__text info-block-5__text_large-font info-block-5__text_no-offset">
                        <?=htmlspecialcharsback($arResult['PROPERTIES']['TEXT_PART_4']['VALUE']['TEXT'])?>
                    </div>
                </div>
            <?endif;?>
        </div>
    </div>
<?endif;?>


<?if (!empty($arResult['PROPERTIES']['TEXT_FULL_PAGE']['VALUE']['TEXT'])):?>
    <div class="info-block-1 container-fluid">
        <div class="row">
            <div class="col-8 col-md-6 offset-md-1">
                <div class="info-block-1__text-2">
                    <?=htmlspecialcharsback($arResult['PROPERTIES']['TEXT_FULL_PAGE']['VALUE']['TEXT'])?>
                </div>
            </div>
        </div>
    </div>
<?endif;?>
</div>


<?if (!empty($arResult['PROPERTIES']['PHOTOS']['VALUE']) && is_array($arResult['PROPERTIES']['PHOTOS']['VALUE'])):?>
<div class="gallery gallery_nav-vertival">
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
                                <?foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $arImage):?>
                                <div class="swiper-slide gallery__swiper-slide">
                                    <div class="gallery__space"></div>
                                    <a class="gallery__wrapper" href="<?=$arImage['SRC']?>">
                                        <div class="gallery__bg-wrapper">
                                            <img class="gallery__bg" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?=$arImage['SRC']?>" data-object-fit="cover"/>
                                        </div>
                                    </a>
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
<?if (!empty($arResult['PROPERTIES']['VIDEO_LINK']['VALUE'])): ?>
    <div class="video-block container-fluid">
        <div class="row">
            <div class="col-8 col-md-6 offset-md-1">
                <div class="video video-block__video">
                    <img class="video__bg-wrapper" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="https://img.youtube.com/vi/<?=$arResult['PROPERTIES']['YOUTUBE_ID']?>/maxresdefault.jpg"/>
                    <div class="video__button">
                        <svg class="video__button-btn">
                            <use xlink:href="#play"></use>
                        </svg>
                    </div>
                    <div class="video__item video__item_youtube" data-embed="<?=$arResult['PROPERTIES']['YOUTUBE_ID']?>"></div>
                </div>
            </div>
        </div>
    </div>
<?endif;?>

<div class="adjacent-page container-fluid">
    <div class="adjacent-page__content">
        <img class="adjacent-page__bg"
             src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
             data-src="<?=$arResult['NEXT']['DETAIL_PICTURE']['SRC']?>"
             data-object-fit="cover"/>
        <div class="row">
            <div class="col-8 col-md-6 col-xl-2 offset-md-2 offset-xl-1 adjacent-page__link-wrapper">
                <a class="adjacent-page__link adjacent-page__link_back" href="<?=$arResult['LIST_PAGE_URL']?>">
                    <?=($arResult['IBLOCK_CODE']=='OBJECTS')?'Назад к объектам':'Назад к новостям'?>
                    <svg class="adjacent-page__arrow-svg">
                        <use xlink:href="#arrow-left"></use>
                    </svg>
                </a>
            </div>
            <div class="col-8 col-md-5 col-xl-4 offset-md-2 offset-xl-0 adjacent-page__link-wrapper">
                <div class="adjacent-page__title-1">
                    <?=($arResult['IBLOCK_CODE']=='OBJECTS')?'Следующий объект':'Следующая новость'?>
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
<?
$APPLICATION->IncludeComponent(
    'only:subscribe',
    $component
);
?>
<div class="static-footer"></div>
