<?foreach ($arResult['ITEMS'] as $arItem):?>
    <a class="solution-inner container-fluid d-block" href="<?=$arItem['DETAIL_PAGE_URL']?>">
        <div class="row">
            <div class="solution-inner__col-1">
                <div class="solution-inner__kw"><?=$arItem['PROPERTIES']['POWER']['VALUE']?></div>
                <div class="solution-inner__full-name"><?=$arItem['PREVIEW_TEXT']?></div>
                <span class="link solution-inner__link">Подробнее</span>
            </div>
            <div class="solution-inner__col-2">
                <img class="solution-inner__bg"
                     src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                     data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"/>
                <div class="solution-inner__name"><?=(!empty($arItem['PROPERTIES']['SECOND_NAME']['VALUE']))?$arItem['PROPERTIES']['SECOND_NAME']['VALUE']:$arItem['NAME']?></div>
            </div>
        </div>
    </a>
<?endforeach;?>
