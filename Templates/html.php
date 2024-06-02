<head>
    <title><?= SERVER_NAME ?></title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.ico"/>
    <meta name="content-language" content="<?php echo isset($_GET['lang'])?$_GET['lang']:"en";?>" />
    <link href="//cdn.legends.travian.com/gpack/2473.3/css_ltr/imports_compressed.css" rel="stylesheet" type="text/css">
        <!-- <link href="<?php echo GP_LOCATE;?>lang/en/compact.css" rel="stylesheet" type="text/css" />
    <?php if($_SESSION['lowres']==1 || isset($_GET['lowres'])){ ?>
        <link href="<?php echo GP_LOCATE;?>en/compact-lowres.css" rel="stylesheet" type="text/css" />
    <?php } ?>
    <link href="<?php echo GP_LOCATE;?>lang/en/lang.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo GP_LOCATE;?>lang/en/modal_plus.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo GP_LOCATE;?>lang/en/custom.css" rel="stylesheet" type="text/css" /> -->
    <?php /*<link href="/gpack/delusion_4.5/css/compact1.css" rel="stylesheet" type="text/css" />
    <?php /*<link href="/gpack/delusion_4.4/lang/en/modal_plus.css" rel="stylesheet" type="text/css" />*/?>
    <!-- <script src="<?php echo GP_LOCATE;?>lang/en/js/jquery.js" type="text/javascript"></script> -->
    <script type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/jquery-3.5.1.min.js"></script>
    <script type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/jquery.md5.min.js"></script>
    <script type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/d3/d3.min.js"></script>
    <script type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/d3/d3pie.min.js"></script>
    <script type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/ChartJs/Chart.min.js"></script>
    <script type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/gsap/TweenMax.min.js"></script>
    <script type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/gsap/plugins/MorphSVGPlugin.min.js"></script>
    <script type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/simplebar.min.js"></script>
    <script type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/popper.min.js"></script>
    <script type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/tippy.min.js"></script>
    <script defer="" type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/bundle/vendor.js"></script>
    <script defer="" type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/bundle/runtime.js"></script>
    <script defer="" type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/bundle/main.js"></script>
    <script type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/PixiJS/pixi.min.js"></script>
    <script type="application/javascript" src="//cdn.legends.travian.com/gpack/2473.4/js/deepmerge.js"></script>
    <script type="application/javascript">window.Travian = {};</script>
    <script type="application/javascript" src="/js/Variables.js?2473.4"></script>
    <script type="application/javascript" src="/js/en-US/Strings.js?2473.4"></script>
    <script type="text/javascript">var j$ = $.noConflict();</script>
    <?php if($_SESSION['lowres']==1 || isset($_GET['lowres'])){ ?>
        <script type="text/javascript">
        window.TravianDefaults = Object.assign(
            {"Map":{"Size":{"width":401,"height":401,"left":-200,"right":200,"bottom":-200,"top":200}}},
            false || {}
        );
        </script>
        <!-- <script type="text/javascript" src="<?php echo GP_LOCATE;?>lang/en/js/crypt-lowres.js?v=<?php echo OPENING;?>"></script> -->
    <?php }else{ ?>
        
        <script type="text/javascript" src="<?php echo GP_LOCATE;?>lang/en/js/crypt.js?v=<?php echo OPENING;?>"></script>
        <script type="text/javascript" src="//cdn.legends.travian.com/gpack/2473.3/js/crypt.js?v=<?php echo OPENING;?>"></script>
    <?php }?>
    <script type="text/javascript">
        Travian.Translation.add(
            {
                'allgemein.anleitung':  'Instructions',
                'allgemein.cancel': 'Cancel',
                'allgemein.ok': 'ОК',
                'allgemein.close':  'Close',
                'cropfinder.keine_ergebnisse': 'Nothing has been found'
            });
        Travian.applicationId = 'T4.4 Game';
        Travian.Game.version = '4.4';
        Travian.Game.worldId = 'rux18';
        Travian.Game.speed = <?=SPEED?>;

        Travian.Templates = {};
        Travian.Templates.ButtonTemplate = "<button >\n\t<div class=\"button-container addHoverClick\">\n\t\t<div class=\"button-background\">\n\t\t\t<div class=\"buttonStart\">\n\t\t\t\t<div class=\"buttonEnd\">\n\t\t\t\t\t<div class=\"buttonMiddle\"><\/div>\n\t\t\t\t<\/div>\n\t\t\t<\/div>\n\t\t<\/div>\n\t\t<div class=\"button-content\"><\/div>\n\t<\/div>\n<\/button>\n";

        Travian.Game.eventJamHtml = '&lt;a href=&quot;http://t4.answers.travian.com/index.php?aid=252#go2answer&quot; target=&quot;blank&quot; title=&quot;Help with in game events&quot;&gt;&lt;span class=&quot;c0 t&quot;&gt;0:00:0&lt;/span&gt;?&lt;/a&gt;'.unescapeHtml();

        window.addEvent('domready', function() {
            Travian.Form.UnloadHelper.message = 'There were some changes made. Are you sure you want to leave this page?';
        });
    </script>

</head>