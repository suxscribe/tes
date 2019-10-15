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
<div class="container-fluid company__text-1" data-page-nav-item="Клиенты">
    <div class="row">
        <div class="col-md-6 offset-md-1 tpg__p1">С нами сотрудничают крупнейшие российские компании из различных
            отраслей: электроэнергетика, нефтегазовая и тяжелая промышленности, строительство
        </div>
    </div>
</div>
<div class="partners">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <div class="row partners__row partners__row_head">
                    <div class="partners__col-1"></div>
                    <div class="partners__col-2">
                        <div class="partners__title">Имя</div>
                    </div>
                    <div class="partners__col-3">
                        <div class="partners__title">Описание</div>
                    </div>
                </div>
                <?$i=0;?>
                <?foreach ($arResult['ITEMS'] as $arItem):?>
                <?if ($i==3):?><div class="collapse partners__collapse" id="partners"><?endif;?>
                <div class="row partners__row">
                    <div class="partners__col-1 partners__logo">
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"/>
                    </div>
                    <div class="partners__col-2 partners__name"><?=$arItem['NAME']?></div>
                    <div class="partners__col-3 partners__text">
                        <?=$arItem['PREVIEW_TEXT']?>
                    </div>
                </div>
                <?$i++;?>
                <?endforeach;?>
                <?if (count($arResult['ITEMS'])>3):?>
                </div>
            </div>
        </div>
        <div class="row partners__row partners__row_more">
            <div class="col-md-6 offset-md-1">
                <div class="partners__more collapsed" data-toggle="collapse" href="#partners"
                     aria-expanded="true">
                    <div class="partners__more-show">Показать больше компаний</div>
                    <div class="partners__more-hide">Свернуть</div>
                    <div class="partners__more-plus"></div>
                </div>
            </div>
        </div>
        <?endif;?>
    </div>
</div>
