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
<div class="news">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-xxl-1 news__col align-items-end">
                <a class="link news__all-news" href="/news/">Все новости</a>
            </div>
            <?foreach ($arResult['ITEMS'] as $arItem):?>
            <div class="col-md-3 col-xxl-2 news__col align-items-stretch">
                <a class="news-preview news__item" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                    <div class="news-preview__top">
                        <div class="news-preview__wrapper">
                            <div class="news-preview__img-wrapper">
                                <div class="news-preview__img-space"></div>
                                <img class="news-preview__img"
                                     src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                     data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
                                     data-object-fit="cover"/>
                            </div>
                        </div>
                        <div class="news-preview__text">
                            <?=$arItem['NAME']?>
                        </div>
                    </div>
                    <div class="news-preview__bottom"><?=FormatDate('j F Y',MakeTimeStamp($arItem['DATE_ACTIVE_FROM']))?></div>
                </a>
            </div>
            <?endforeach;?>
        </div>
    </div>
</div>
