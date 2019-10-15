<?php
/**
 * Created by PhpStorm.
 * User: a123
 * Date: 29.06.2018
 * Time: 10:01
 */

namespace Only\Site;


class Helper
{
    public static function loadCssFolder($sPath)
    {
        $arFiles = self::loadFolderFiles($sPath);
        foreach ($arFiles as $sFile) {
            echo sprintf('<link href="%s%s" rel="stylesheet">', $sPath, $sFile);
        }
    }

    public static function loadJsFolder($sPath, $arOrder = [])
    {
        $arFiles = self::loadFolderFiles($sPath, $arOrder);

        foreach ($arFiles as $sFile) {
            echo sprintf('<script type="text/javascript" src="%s%s"></script>', $sPath, $sFile);
        }
    }

    protected static function loadFolderFiles($sPath, $arOrder = [])
    {
        $arFiles = preg_grep('/^([^.])/', scandir($_SERVER['DOCUMENT_ROOT'] . $sPath));

        if (!empty($arOrder)) {

            $arFilesForSort = $arFiles;

            $arFiles = [];
            foreach ($arOrder as $iKey => $sName) {
                $arFiles[] = reset(preg_grep('/' . $sName . '\..*?\.?js/', $arFilesForSort));
            }

            $arFiles = array_filter($arFiles);
        }
        return $arFiles;
    }

    public static function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) === 'XMLHTTPREQUEST');
    }

    public static function showHead($sLang = false, $bXhtmlStyle = true)
    {
        global $APPLICATION;
        //echo '<meta http-equiv="Content-Type" content="text/html; charset=' . LANG_CHARSET . '"' . ($bXhtmlStyle ? ' /' : '') . '>' . "\n";

        if (!$sLang) {
            $APPLICATION->ShowMeta("robots", false, $bXhtmlStyle);
            $APPLICATION->ShowMeta("keywords", false, $bXhtmlStyle);
            $APPLICATION->ShowMeta("description", false, $bXhtmlStyle);
            $sTitle = $APPLICATION->GetProperty('title', false, $bXhtmlStyle);
            $APPLICATION->SetTitle($sTitle);

        } else {
            $APPLICATION->ShowMeta("robots_" . $sLang, 'robots', $bXhtmlStyle);
            $APPLICATION->ShowMeta("keywords_" . $sLang, 'keywords', $bXhtmlStyle);
            $APPLICATION->ShowMeta("description_" . $sLang, 'description', $bXhtmlStyle);
            $sTitle = $APPLICATION->GetProperty('title_' . $sLang, 'title', $bXhtmlStyle);
            $APPLICATION->SetTitle($sTitle);

        }
        global $USER;
        if ($USER->IsAdmin()) {
            $APPLICATION->ShowLink("canonical_" . $sLang, null, $bXhtmlStyle);
            $APPLICATION->ShowCSS(true, $bXhtmlStyle);
            $APPLICATION->ShowHeadStrings();
            $APPLICATION->ShowHeadScripts();
        }
    }

    public static function getLang($sDefaultLang = 'ru')
    {
        if (!empty($_COOKIE['ONLY_SITE_LANG']))
            return $_COOKIE['ONLY_SITE_LANG'];

        return $sDefaultLang;
    }

    public static function setLang($sLang)
    {
        setcookie('ONLY_SITE_LANG', $sLang, time() + 86400 * 30, '/');

        return true;
    }

    public static function setBarbaID()
    {
        global $APPLICATION;
        $APPLICATION->AddViewContent('BARBA_START', sprintf('<div id="fullpage" class="barba-container" data-namespace="%s">', $APPLICATION->GetPageProperty('BARBA_ID')));
    }
    public static function setDataNamespase(){
        global $APPLICATION;
        $APPLICATION->AddViewContent('BARBA_NAMESPASE', '<div id="fullpage" class="barba-container '.$APPLICATION->GetPageProperty('BARBA_INNER').'" data-namespace="'.$APPLICATION->GetPageProperty('BARBA_NAMESPASE').'">');
    }
    public static function setPageNavigation(){
        global $APPLICATION;
        if ($APPLICATION->GetPageProperty('PAGE_NAVIGATION')==true){
            $sNavigationHTML = '
            <div class="page-navigation product-tail__navigation page-navigation_fixed page-navigation_hide">
                <div class="page-navigation__wrapper">
                    <div class="page-navigation__anchors"></div>
                </div>
            </div>';
        }else{
            $sNavigationHTML ='';
        }
        $APPLICATION->AddViewContent('PAGE_NAVIGATION', $sNavigationHTML);
    }
}
