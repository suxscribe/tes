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
<div class="row">
    <div class="filters col-8 col-md-6 offset-md-1 filters_objects">
        <div class="filters__container">
            <div class="select filters__select">
                <svg class="select__arrow">
                    <use xlink:href="#s-arrow"></use>
                </svg>
                <select class="select__select" name="year">
                    <option value="all">Год выполнения</option>
                    <?foreach ($arResult['FILTERS']['YEARS'] as $sYear):?>
                    <option value="<?=$sYear?>"><?=$sYear?></option>
                    <?endforeach;?>
                </select>
            </div>
            <div class="select select_service filters__select">
                <svg class="select__arrow">
                    <use xlink:href="#s-arrow"></use>
                </svg>
                <select class="select__select" name="typeWork">
                    <option value="all">Вид работ</option>
                    <?foreach ($arResult['FILTERS']['WORK_TYPES'] as $iKey => $sWork):?>
                        <option value="<?=$iKey?>"><?=$sWork?></option>
                    <?endforeach;?>
                </select>
            </div>
            <div class="select filters__select">
                <svg class="select__arrow">
                    <use xlink:href="#s-arrow"></use>
                </svg>
                <select class="select__select" name="branch">
                    <option value="all">Филиал</option>
                    <?foreach ($arResult['FILTERS']['BRANCH'] as $iKey => $sBranchName):?>
                        <option value="<?=$iKey?>"><?=$sBranchName?></option>
                    <?endforeach;?>
                </select>
            </div>
            <div class="select filters__select">
                <svg class="select__arrow">
                    <use xlink:href="#s-arrow"></use>
                </svg>
                <select class="select__select" name="solutions">
                    <option value="all">Применяемые решения</option>
                    <?foreach ($arResult['FILTERS']['SOLUTIONS'] as $iKey => $sSolutions):?>
                        <option value="<?=$iKey?>"><?=$sSolutions?></option>
                    <?endforeach;?>
                </select>
            </div>
        </div>
        <div class="filters__reset">
            <svg class="filters__reset-icon">
                <use xlink:href="#refresh"></use>
            </svg>
            <span class="filters__reset-text">Сбросить фильтры</span></div>
    </div>
</div>

<div class="row object-card-grid filters__filterable endless-btn__container">
<?

if (Only\Site\Helper::isAjax()){
    $APPLICATION->RestartBuffer();
    ob_start();
}
?>

    <?foreach ($arResult['ITEMS'] as $arItem):?>
    <?
     $FullWidth = ($arItem['PROPERTIES']['FULL_WIDTH']['VALUE_XML_ID']=='Y');
    ?>
    <div class="object-card-grid__item col-8 <?=($FullWidth)? '': 'col-lg-4'?>">
        <a class="object-card" href="<?=$arItem['DETAIL_PAGE_URL']?>" data-year="2018" data-type-work="typeWork-1" data-solutions="solutions-1">
            <img class="object-card__img"
                 src="<?=(Only\Site\Helper::isAjax())?$arItem['PREVIEW_PICTURE']['SRC']:'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'?>"
                 data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
                 data-object-fit="cover"/>
            <div class="object-card__head">
                <div class="object-card__title"><?=$arItem['NAME']?></div>
                <div class="object-card__data"><?=$arItem['PROPERTIES']['YEAR']['VALUE']?></div>
            </div>
        </a>
    </div>
    <?endforeach;?>
<?
$bLast = ($arResult['NAV_DATA']['nEndPage'] == $arResult['NAV_DATA']['NavPageNomer']) || ($arResult['NAV_DATA']['nEndPage'] == 0);

    if (Only\Site\Helper::isAjax()){
        $data = ob_get_contents();
        ob_end_clean();
        $dataJson = array("data" => $data, 'lastPage' => $bLast);
        $jsonData = \Bitrix\Main\Web\Json::encode($dataJson);
        print $jsonData;
        exit();
    }
?>
</div>
<div class="endless-btn <?=$bLast ? '_is-hidden' : ''?>" data-count-page="1">
    <svg class="endless-btn__icon">
        <use xlink:href="#arrow-down"></use>
    </svg>
</div>
