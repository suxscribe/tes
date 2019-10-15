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
<div class="services">
    <div class="electro-lines">
        <img class="electro-lines__static-bg"
             src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
             data-src="/media/static-bg.daa5b578.jpg" data-object-fit="cover"/>
        <div class="electro-lines__canvas-wrapper">
            <canvas class="electro-lines__canvas d-none d-md-block"></canvas>
        </div>
    </div>
    <img class="services__mobile-bg d-md-none"
         src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
         data-src="/media/mobile-bg.2f72d2bd.jpg"
         data-src-mobile="/media/mobile-bg.2f72d2bd.jpg" />
    <div class="container-fluid services__container-fluid">
        <div class="row services__row">
            <div class="col-md-8 col-xxl-2">
                <div class="services-description services__description">
                    <div class="services-description__title-1">Услуги</div>
                    <div class="services-description__title-2">EPC &mdash; подрядчик</div>
                    <div class="services-description__text">Выступаем в&nbsp;отношениях с&nbsp;партнерами
                        в&nbsp;качестве EPC-подрядчика
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="row services__items">
                    <?$iNumber=1;?>
                    <?foreach ($arResult['ITEMS'] as $arItem):?>
                    <div class="services__service col-2"><a class="service" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <div class="service__index"><?printf('%02d',$iNumber)?></div>
                            <div class="service__text splitText">
                                <?=$arItem['NAME']?>
                            </div>
                        </a>
                    </div>
                    <?$iNumber++;?>
                    <?endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
