<?
/*
 * Получаем все файлы
 */
foreach ($arResult['PROPERTIES'] as $sPropName => &$arProp){
    if ($arProp['PROPERTY_TYPE']=='F'){
        if ($arProp['MULTIPLE']=='Y' && is_array($arProp['VALUE'])){
            foreach ($arProp['VALUE'] as &$iValue){
                $iValue = CFile::GetFileArray($iValue);
            }
        }else{
            $arProp['VALUE'] = CFile::GetFileArray($arProp['VALUE']);
        }

    }
}
/*
 * Следующий элемент
 */

$arFilter = array(
    'IBLOCK_ID' => $arResult['IBLOCK_ID'],
    'ACTIVE' => 'Y',
);
if ($arResult['IBLOCK_CODE'] == 'OBJECTS'){
    $arOrder = array(
        'PROPERTY_YEAR' => 'DESC',
        'SORT' => 'ASC'
    );
}else{
    $arOrder = array(
        'ACTIVE_FROM' => 'DESC',
        'ID' => 'DESC'
    );
}

$rsElem = CIBlockElement::GetList(
    $arOrder,
    $arFilter,
    false,
    array('nPageSize' => 1, 'nElementID' => $arResult["ID"]),
    array('ID', 'NAME', 'DETAIL_PAGE_URL', 'DETAIL_PICTURE', 'PROPERTY_YEAR')
);
$arElements = [];
while ($arElement = $rsElem->GetNext()) {
    $arElements[] = $arElement;
}

if (count($arElements) == 3) {
    $arResult['NEXT'] = $arElements[2];
} elseif (count($arElements) == 2) {
    if ($arElements[1]['ID'] != $arResult["ID"]) {
        $arResult['NEXT'] = $arElements[1];
    } else {
        $rsElem = CIBlockElement::GetList(
            array(
                'PROPERTY_YEAR' => 'DESC',
                'SORT' => 'ASC'
            ),
            $arFilter,
            false,
            array('nPageSize' => 1),
            array('ID', 'NAME', 'DETAIL_PAGE_URL', 'DETAIL_PICTURE')
        );
        $arElementsLast = [];
        while ($arElement = $rsElem->GetNext()) {
            $arElementsLast[] = $arElement;
        }
        $arResult['NEXT'] = $arElementsLast[0];
    }

}
if (!empty($arResult['NEXT']['DETAIL_PICTURE'])){
    $arResult['NEXT']['DETAIL_PICTURE'] = CFile::GetFileArray($arResult['NEXT']['DETAIL_PICTURE']);
}
if (!empty($arResult['PROPERTIES']['VIDEO_LINK']['VALUE'])) {
    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $arResult['PROPERTIES']['VIDEO_LINK']['VALUE'], $match)) {
        $arResult['PROPERTIES']['YOUTUBE_ID'] = $match[1];
    }

}

?>
