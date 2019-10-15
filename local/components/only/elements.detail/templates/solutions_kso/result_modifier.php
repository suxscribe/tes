<?
if (!empty($arResult['PROPERTIES']['APPLICATION_PHOTO']['VALUE'])){
    $arResult['PROPERTIES']['APPLICATION_PHOTO']['VALUE'] = CFile::GetFileArray($arResult['PROPERTIES']['APPLICATION_PHOTO']['VALUE']);
}
/* Готовим документы */
if (!empty($arResult['PROPERTIES']['DOCUMENTS']['VALUE'])) {
    foreach ($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as &$iDocument){
        $iDocument = CFile::GetFileArray($iDocument);
        $iDocument['FILE_SIZE'] = CFile::FormatSize($iDocument['FILE_SIZE']);
        /*
         * Если не задано описание файла то берем его имя без расширения.
         */
        if (empty($iDocument['DESCRIPTION'])){
            $iDocument['DESCRIPTION'] =  substr($iDocument['ORIGINAL_NAME'], 0, strripos($iDocument['ORIGINAL_NAME'], '.'));

        }
        $iDocument['EXT'] =  substr($iDocument['ORIGINAL_NAME'],  strripos($iDocument['ORIGINAL_NAME'], '.')+1);
    }
}
/* Готовим ссылки на фотографии */
if (!empty($arResult['PROPERTIES']['PHOTOS']['VALUE'])){
    foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as &$iPhoto){
        $iPhoto = CFile::GetFileArray($iPhoto);
    }
}

/*
 * Объекты
 */

if (!empty($arResult['PROPERTIES']['SOLUTIONS_FILTER']['VALUE'])){
    /*
     * Выбираем элементы
     */
    $rsItems = CIBlockElement::GetList(
        [
            "SORT"=>"ASC"
        ],
        [
            'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('OBJECTS','OBJECTS'),
            'ACTIVE' => 'Y',
            'PROPERTY_SOLUTIONS' => $arResult['PROPERTIES']['SOLUTIONS_FILTER']['VALUE']
        ],
        false,
        false,
        ['ID', 'NAME', 'PROPERTY_SOLUTIONS','PROPERTY_NAME_SLIDER','PROPERTY_PICTURE_SLIDER', 'DETAIL_PAGE_URL']
    );
    while ($obItem = $rsItems->GetNextElement(true, false)) {
        $arItemObject = $obItem->GetFields();
        $arResult['OBJECTS'][$arItemObject['ID']] = $arItemObject;
        if (empty($arItemObject['PROPERTY_NAME_SLIDER_VALUE']) || empty($arItemObject['PROPERTY_PICTURE_SLIDER_VALUE'])){
            unset($arResult['OBJECTS'][$arItemObject['ID']]);
        }
        if (!empty($arResult['OBJECTS'][$arItemObject['ID']]['PROPERTY_PICTURE_SLIDER_VALUE'])){
            $arResult['OBJECTS'][$arItemObject['ID']]['PICTURE_SLIDER'] = CFile::GetFileArray($arResult['OBJECTS'][$arItemObject['ID']]['PROPERTY_PICTURE_SLIDER_VALUE']);
        }
    }
}

