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
global $APPLICATION;
?>
<div class="trust__section-bg">
    <div class="container-fluid">
        <div class="row">
            <div class="filters col-8 col-md-6 offset-md-1 filters_trust">
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
                        </select></div>
                    <div class="select filters__select">
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
                </div>
                <div class="filters__reset">
                    <svg class="filters__reset-icon">
                        <use xlink:href="#refresh"></use>
                    </svg>
                    <span class="filters__reset-text">Сбросить фильтры</span>
                </div>
            </div>
        </div>
    </div>
    <div class="comment-preview-grid container-fluid">
        <div class="row">
            <div class="col-8 col-md-6 offset-md-1">
                <div class="comment-preview-grid__modal">
                    <div class="modal fade comment-modal comment-preview__modal" id="modalPreview1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="comment-modal__content">
                                    <img class="comment-modal__content-img"
                                         src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                         data-src="/media/comm1.9e904038.jpg"
                                         data-object-fit="cover"/>
                                </div>
                                <div class="sandwich-menu-close sandwich-menu__close modal__close"
                                     data-dismiss="modal">
                                    <div class="sandwich-menu-close__line sandwich-menu-close__line_top"></div>
                                    <div class="sandwich-menu-close__line sandwich-menu-close__line_bottom"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row comment-preview-grid__container filters__filterable endless-btn__container">
                    <?
                    if (Only\Site\Helper::isAjax()){
                        $APPLICATION->RestartBuffer();
                        ob_start();
                    }
                    ?>
                    <?foreach ($arResult['ITEMS'] as $arItem):?>
                    <div class="col-8 col-lg-4 comment-preview-grid__item">
                        <div class="comment-preview comment-preview-grid__comment" data-toggle="modal"
                             data-img="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
                            <div class="comment-preview__title">Отзыв компании <?=$arItem['NAME']?></div>
                            <div class="comment-preview__btn">посмотреть</div>
                        </div>
                    </div>
                    <?endforeach;?>
                    <?
                    if (Only\Site\Helper::isAjax()){
                        $bLast = ($arResult['NAV_DATA']['nEndPage'] == $arResult['NAV_DATA']['NavPageNomer']) || ($arResult['NAV_DATA']['nEndPage'] == 0);
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
    <div class="endless-btn endless-btn_trust <?=$bLast ? '_is-hidden' : ''?>" data-count-page="1">
        <svg class="endless-btn__icon">
            <use xlink:href="#arrow-down"></use>
        </svg>
    </div>
</div>
