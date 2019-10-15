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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 offset-md-1">
            <div class="row">
                <div class="w-100 row news-card-grid endless-btn__container">
                    <?
                    if (Only\Site\Helper::isAjax()){
                        $APPLICATION->RestartBuffer();
                        ob_start();
                    }
                    ?>
                    <?foreach ($arResult['ITEMS'] as $arItem):?>
                    <div class="col-md-4 news-page__item news-page__item_cut-text">
                        <a class="news-preview" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <div class="news-preview__top">
                                <div class="news-preview__wrapper">
                                    <div class="news-preview__img-wrapper">
                                        <div class="news-preview__img-space"></div>
                                        <img class="news-preview__img"
                                             src="<?=(Only\Site\Helper::isAjax())?$arItem['PREVIEW_PICTURE']['SRC']:'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'?>"
                                             data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
                                             data-object-fit="cover"/>
                                    </div>
                                </div>
                                <div class="news-preview__text">
                                    <?=$arItem['NAME']?>
                                </div>
                            </div>
                            <div class="news-preview__bottom">
                                <?=FormatDate('j F Y',MakeTimeStamp($arItem['DATE_ACTIVE_FROM']))?>
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
            </div>
        </div>
    </div>
</div>
<div class="endless-btn <?=$bLast ? '_is-hidden' : ''?>" data-count-page="1">
    <svg class="endless-btn__icon">
        <use xlink:href="#arrow-down"></use>
    </svg>
</div>
