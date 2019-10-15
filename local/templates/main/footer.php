<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
    </div><!-- END barba-container-->
</div><!-- END barba-wrapper-->
<div class="footer container-fluid">
    <div class="row">
        <div class="footer__col col-8 col-md-3">
            <?$APPLICATION->IncludeComponent(
                'only:elements.detail',
                'copyright',
                [
                    'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('MAIN','MAIN'),
                    'ELEMENT_CODE' => 'main',
                    'SET_META_TAGS' => 'N'
                ],
                $component
            );
            ?>
        </div>
        <div class="footer__col col-4 col-md-3">
            <a class="footer__link" href="tel:<?=$APPLICATION->GetPageProperty('TES_PHONE_VALUE')?>"><?=$APPLICATION->GetPageProperty('TES_PHONE_PRINT')?></a>
            <a class="footer__link footer__link-youtube" href="<?=$APPLICATION->GetPageProperty('TES_YOUTUBE')?>" target="_blank">
            <svg class="youtube" viewBox="0 0 165.1 69.65"><g id="Layer_2" data-name="Layer 2"><g id="OBJECTS"><path class="cls-1" d="M116.1,69.65c-8.32-.19-17.34-.33-26.35-.64a99.08,99.08,0,0,1-11.42-1A11.19,11.19,0,0,1,69,60.64a26.71,26.71,0,0,1-1.72-6.81A190.75,190.75,0,0,1,66.77,20a36.35,36.35,0,0,1,2-10.52,11.79,11.79,0,0,1,10.73-8C86.11.84,92.81.56,99.49.31,111-.11,122.41-.07,133.87.22c5.48.14,11,.43,16.44.7a15.22,15.22,0,0,1,7.28,2c3,1.82,4.63,4.6,5.63,7.87a41,41,0,0,1,1.39,9.13,198.83,198.83,0,0,1,.11,26.29,52.28,52.28,0,0,1-1.32,10.94,23.4,23.4,0,0,1-2.18,5.55A11.4,11.4,0,0,1,152,68.29c-4.82.45-9.66.7-14.49.87C130.62,69.4,123.71,69.48,116.1,69.65Zm6.54-43.87V24.73c0-4.1,0-8.2,0-12.3,0-.57-.13-.79-.74-.77-1.48.05-3,.05-4.45,0-.7,0-.92.17-.92.9,0,6.47,0,12.94,0,19.41l0,23.5c0,1,0,1,1,1h3.93c1.27,0,1.11.13,1.13-1.17,0-.63,0-1.26,0-1.81A32,32,0,0,0,125.86,56c3.46,2,7.15.52,8.06-3.38a26,26,0,0,0,.59-5.43c.08-4.92.11-9.83,0-14.75a28.22,28.22,0,0,0-.73-5.86,5,5,0,0,0-7.47-3.43A31.78,31.78,0,0,0,122.64,25.78ZM105.28,53c0,1,0,1.88,0,2.76,0,.5.15.7.68.69q2.52,0,5,0c.57,0,.7-.22.7-.74q0-16,0-31.94c0-.61-.23-.75-.78-.73-1.56,0-3.12,0-4.67,0-1,0-1,0-1,1q0,11.71,0,23.42a4.86,4.86,0,0,1-3.13,3.8A1.24,1.24,0,0,1,100.46,50c0-.44,0-.89,0-1.33q0-12.35,0-24.68c0-.67-.18-.9-.87-.88-1.55.05-3.11.06-4.67,0-.74,0-.89.24-.89.93,0,8.5,0,17,0,25.49A20,20,0,0,0,94.37,53c.45,2.68,2.16,4.09,4.69,3.95a6.67,6.67,0,0,0,4-1.85C103.8,54.44,104.48,53.76,105.28,53Zm45.07-8.35c0,.78,0,1.45,0,2.11a14.32,14.32,0,0,1-.28,2.78,2.23,2.23,0,0,1-2.23,1.72,2.36,2.36,0,0,1-2.54-1.52,3.85,3.85,0,0,1-.35-1.36c-.05-2.46-.06-4.93-.07-7.4,0-.06.06-.12.11-.22h.88l10,0c.95,0,1,0,1-1,0-2.13.07-4.25,0-6.37a22,22,0,0,0-.44-4c-1.68-7.66-10.16-8.44-14.29-5.06A9.8,9.8,0,0,0,138.56,32c-.16,4.91-.13,9.83-.13,14.74a11.73,11.73,0,0,0,1.11,5.1c1.65,3.46,4.74,5.19,8.9,5a8.18,8.18,0,0,0,7.22-4.54c1.23-2.27,1.07-4.78,1.1-7.24,0-.12-.28-.35-.43-.36C154.39,44.65,152.44,44.66,150.35,44.66ZM81.11,18.24c0,.34,0,.6,0,.87l0,16.38q0,10,0,19.94c0,1,0,1,1,1h4.59c1.11,0,1.12,0,1.12-1.13l0-35.65V18.21h1.26c1.75,0,3.51,0,5.26,0,.58,0,.77-.18.76-.77,0-1.65,0-3.31,0-5,0-.53-.12-.75-.71-.73-1.43,0-2.86,0-4.29,0-5.07,0-10.13.05-15.2.05-.56,0-.79.13-.77.75,0,1.13,0,2.27,0,3.41,0,.71-.21,1.71.16,2.05s1.38.19,2.11.2C78,18.25,79.53,18.24,81.11,18.24Z"/><path class="cls-1" d="M54.92,23H61.1V56.3H55V52.8c-.58.56-1,1-1.47,1.44-1.44,1.36-3,2.56-5.09,2.57a3.71,3.71,0,0,1-3.93-2.75A15.63,15.63,0,0,1,43.92,50c-.09-8.85-.11-17.69-.15-26.54,0-.12,0-.24,0-.43h6.07c0,.27,0,.55,0,.83q0,12.75.11,25.5a6.06,6.06,0,0,0,0,.74c.13,1,.88,1.61,1.84,1.2a8.44,8.44,0,0,0,2.06-1.49A3.41,3.41,0,0,0,55,47C55,39.34,55,31.7,54.92,24.07Z"/><path class="cls-1" d="M22.71,11.78C21.6,15.46,20.53,19,19.46,22.6q-2.28,7.54-4.55,15.1a3.84,3.84,0,0,0-.15,1.17c0,5.51.06,11,.09,16.52v.88H8.4v-.81c0-5.53,0-11.07-.1-16.6a6.58,6.58,0,0,0-.4-1.94Q4.09,24.77.24,12.62L0,11.82c2.19,0,4.29,0,6.38,0,.19,0,.46.37.53.61,1,3.6,2,7.2,2.94,10.79.52,1.9,1,3.79,1.7,5.7.33-1.25.66-2.5,1-3.75,1.08-4.24,2.16-8.47,3.21-12.71.13-.53.31-.73.87-.73C18.61,11.8,20.61,11.78,22.71,11.78Z"/><path class="cls-1" d="M21.69,39.6c0-2.54-.07-5.09,0-7.62a14,14,0,0,1,.67-3.7,7.25,7.25,0,0,1,6.1-5.36c3.52-.53,6.66.17,8.85,3.27A10.55,10.55,0,0,1,39,31.5c.13,1.62.14,3.25.15,4.88,0,3.56.07,7.11,0,10.67a16.18,16.18,0,0,1-.5,3.73,8.24,8.24,0,0,1-8,6.13,8.33,8.33,0,0,1-8.28-6,25.09,25.09,0,0,1-.65-5.12c-.11-2,0-4.1,0-6.15Zm11.46.33h-.09c0-2.59,0-5.19,0-7.78a7.79,7.79,0,0,0-.29-2,2.51,2.51,0,0,0-4.82.13,7.68,7.68,0,0,0-.25,1.9q0,7.66.1,15.34a8,8,0,0,0,.31,2.18,2.36,2.36,0,0,0,2.45,1.76,2.31,2.31,0,0,0,2.32-1.82,8.36,8.36,0,0,0,.27-2.11C33.17,45,33.15,42.45,33.15,39.93Z"/><path class="cls-1" d="M122.64,39.64c0-3.09,0-6.17,0-9.26a1.37,1.37,0,0,1,.65-1.3,4.29,4.29,0,0,1,2.6-.92,1.83,1.83,0,0,1,1.92,1.43,7.35,7.35,0,0,1,.32,2q0,7.89,0,15.78a8.6,8.6,0,0,1-.33,2.19,2.13,2.13,0,0,1-2.92,1.58,7.46,7.46,0,0,1-.89-.35,2.11,2.11,0,0,1-1.41-2.22c.11-3,0-6,0-9Z"/><path class="cls-1" d="M150.47,35.67c-1.84,0-3.51,0-5.18,0a.65.65,0,0,1-.4-.45c0-1.73,0-3.46.21-5.16.15-1.4,1-1.92,2.61-1.91s2.33.51,2.48,1.87C150.39,31.84,150.38,33.71,150.47,35.67Z"/></g></g>
            </svg>
            </a>
        </div>
        <div class="footer__col col-4 col-md-2 justify-content-end">
            <div>design by <a href='https://onlydigital.ru/' target='_blank' class='footer__link'>Only</a>.</div>
        </div>
    </div>
</div>
<? $APPLICATION->IncludeComponent(
    'bitrix:menu',
    'sandwich',
    Array(
        'ALLOW_MULTI_SELECT' => 'N',
        'CHILD_MENU_TYPE' => 'left',
        'DELAY' => 'N',
        'MAX_LEVEL' => '2',
        'MENU_CACHE_GET_VARS' => array(''),
        'MENU_CACHE_TIME' => '3600',
        'MENU_CACHE_TYPE' => 'A',
        'MENU_CACHE_USE_GROUPS' => 'Y',
        'ROOT_MENU_TYPE' => 'top',
        'USE_EXT' => 'Y'
    )
); ?>
<div class="cookie-message container-fluid hidden" rel="noindex">
    <div class="row">
        <div class="col-8 col-md-5 justify-content-md-center col-xxl-4 offset-xxl-1 d-flex align-items-center cookie-message__text-col">
            <div class="cookie-message__text">Для улучшения произоводительности, мы&nbsp;используем на&nbsp;сайте файлы
                cookie
            </div>
        </div>
        <div class="col-8 col-md-3 justify-content-center col-xxl-2 justify-content-xxl-start d-flex align-items-center">
            <a class="link cookie-message__btn-accept">
                <svg class="link__icon">
                    <use xlink:href="#arrow-right"></use>
                </svg>
                Хорошо, я согласен</a></div>
    </div>
</div>
<div class="preloader">
    <div class="preloader__top-space"></div>
    <div class="preloader__content container-fluid">
        <div class="preloader__content">
            <div class="preloader__title-1">
                <div class="preloader__title-1-word">
                    <div class="preloader__title-1-text">Таврида</div>
                </div>
                <div class="preloader__title-1-word">
                    <div class="preloader__title-1-text">Энерго</div>
                </div>
                <div class="preloader__title-1-word">
                    <div class="preloader__title-1-text">Строй</div>
                </div>
                <div class="preloader__counter">
                    <div class="preloader__title-1-text">0</div>
                </div>
            </div>
        </div>
    </div>
    <div class="preloader__bottom-space"></div>
</div>
<?\Only\Site\Helper::setDataNamespase();?>
<?\Only\Site\Helper::setPageNavigation();?>
<script src="https://www.google.com/recaptcha/api.js?render=explicit"></script>
<? \Only\Site\Helper::loadJsFolder('/js/', ['common']); ?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(30794901, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/30794901" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-90350022-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-90350022-1');
</script>
<!-- // Google Analytics -->

</body>
</html>

