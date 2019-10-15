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
<?$iNumber=1;?>
<?foreach ($arResult['ITEMS'] as $arItem):?>
<div class="col-8 col-md-4 col-lg-only-third col-xl-2 services-inner__col">
    <a class="service-inner" href="<?=$arItem['DETAIL_PAGE_URL']?>">
        <div class="service-inner__shift-wrapper">
            <div class="service-inner__bg-wrapper">
                <img class="service-inner__bg"
                     data-object-fit="cover"
                     src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                     data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"/>
            </div>
            <div class="service-inner__plus"></div>
        </div>
        <div class="service-inner__wrapper">
            <div class="service-inner__index"><?printf('%02d',$iNumber)?></div>
            <div class="service-inner__text"><?=$arItem['NAME']?></div>
        </div>
    </a>
</div>
<?$iNumber++;?>
<?endforeach;?>
