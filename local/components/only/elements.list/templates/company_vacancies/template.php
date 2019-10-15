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
<div class="construct construct_vacancy" data-page-nav-item="Вакансии">
    <div class="construct__content container-fluid">
        <div class="row construct__row">
            <div class="col-8 construct__title-1">Открытые вакансии</div>
            <div class="col-8">
                <div class="spoiler-list spoiler-list_construct" id="vacancy">
                    <?foreach ($arResult['ITEMS'] as $iKey => $arItem):?>
                    <div class="spoiler spoiler-list__item">
                        <div class="spoiler__header collapsed" data-toggle="collapse" href="#vacancy-<?=$iKey?>"
                             aria-expanded="true">
                            <div class="spoiler__title">
                                <?=$arItem['NAME']?>
                                <div class="spoiler__plus"></div>
                            </div>
                        </div>
                        <div class="collapse" id="vacancy-<?=$iKey?>">
                            <div class="spoiler__content">
                                <div class='spoiler__row'>
                                    <h3>Условия работы</h3>
                                    <p><?=$arItem['PREVIEW_TEXT']?></p>
                                    <ul>
                                        <?foreach ($arItem['PROPERTIES']['CONDITIONS']['VALUE'] as $sCondition):?>
                                        <li><?=$sCondition?></li>
                                        <?endforeach;?>
                                    </ul>
                                    <h3>Должностные обязанности</h3>
                                    <ul>
                                        <?foreach ($arItem['PROPERTIES']['DUTIES']['VALUE'] as $sDuties):?>
                                            <li><?=$sDuties?></li>
                                        <?endforeach;?>
                                    </ul>
                                    <h3>Требования</h3>
                                    <ul>
                                        <?foreach ($arItem['PROPERTIES']['REQUIREMENTS']['VALUE'] as $sReq):?>
                                            <li><?=$sReq?></li>
                                        <?endforeach;?>
                                    </ul>
                                    <h3>Резюме принимаются</h3>
                                    <?=htmlspecialcharsback($arItem['PROPERTIES']['RESUME_CONTACTS']['VALUE']['TEXT'])?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?endforeach;?>
                </div>
            </div>
            <div class="col-8 construct__title-2">
                Если вас заинтересовали вакансии, отправьте нам резюме на&nbsp;
                <a href="mailto:info@tes.com">info@tes.com</a>
            </div>
        </div>
    </div>
</div>
