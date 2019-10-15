<?
define('BX_DISABLE_INDEX_PAGE', true);
global $SITE_LANG;
$SITE_LANG = 'RU';
if (\Bitrix\Main\Loader::includeModule('only.site'))
    $SITE_LANG = \Only\Site\Helper::getLang();

