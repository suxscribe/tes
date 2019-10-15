<?
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
if (!empty($arResult['PROPERTIES']['VIDEO_LINKS']['VALUE'])) {
    foreach ($arResult['PROPERTIES']['VIDEO_LINKS']['VALUE'] as &$sLink)
    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $sLink, $match)) {
        $arResult['PROPERTIES']['VIDEOS']['VALUE'][]['YOUTUBE_ID'] = $match[1];
    }
}
?>
