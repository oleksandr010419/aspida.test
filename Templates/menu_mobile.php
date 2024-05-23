<?php
if(isset($_GET['lang'])){

    if(count($_GET)==1){
        $_SERVER['QUERY_STRING']= preg_replace('/lang='.$_GET['lang'].'/','',$_SERVER['QUERY_STRING']);
    }else{
        $_SERVER['QUERY_STRING']= preg_replace('/&lang='.$_GET['lang'].'/','',$_SERVER['QUERY_STRING']);
    }
}
if(count($_GET) && isset($_GET['lang'])){
    if($_GET['lang']!='ru'){
        $linken='?'.$_SERVER['QUERY_STRING'].'&lang=ru';
    }else{$linken='?'.$_SERVER['QUERY_STRING'];}
    if($_GET['lang']!='ru'){
        $linkru='?'.$_SERVER['QUERY_STRING'].'&lang=ru';
    }else{$linkru='?'.$_SERVER['QUERY_STRING'];}
}elseif(!count($_GET)){
    $linkru='?lang=ru';
    $linken='?lang=ru';
}else{
    $linkru='?'.$_SERVER['QUERY_STRING'].'&lang=ru';
    $linken='?'.$_SERVER['QUERY_STRING'].'&lang=ru';

}
?>
<nav id="mobileMenu">
	<ul>
		<li>
			<a class="mainpage" href="https://www.aspidanetwork.com/international" target="_blank"><?=HOME?></a>
		</li>
		<li>
			<a class="login <?php if($_SERVER['PHP_SELF'] == "/login.php") { echo ' active'; } ?>" href="/login.php"><?=SIGN6?></a>
		</li>
		<li>
			<a class="register <?php if($_SERVER['PHP_SELF'] == "/anmelden.php") { echo ' active'; } ?>" href="anmelden.php" target="_blank"><?=SIGN5?></a>
		</li>
	</ul>

	<svg viewBox="0 0 217.28 10.2" class="divider">
    <path d="M78.66 7.51L0 5.1l78.66-2.41a18.49 18.49 0 0 0-.49 2.42 14.58 14.58 0 0 0 .49 2.4z"></path>
    <path d="M75.94 6.08l-32.69-1 32.69-1a5.76 5.76 0 0 0-.27 1 4.64 4.64 0 0 0 .27 1zM139 7.51l78.32-.69L139 2.69a14.63 14.63 0 0 1 .74 2.56 9.31 9.31 0 0 1-.74 2.26z"></path>
    <path d="M141.86 6.08l32.69-1-32.69-1a5.76 5.76 0 0 1 .27 1 4.64 4.64 0 0 1-.27 1zM84.82 5.1a2.31 2.31 0 1 1-4.6 0 2.31 2.31 0 1 1 4.6 0zM132.9 5.1a2.32 2.32 0 1 0 4.61 0 2.32 2.32 0 1 0-4.61 0zM104.142 5.095l5.099-5.098 5.098 5.098-5.098 5.098z"></path>
    <path d="M42.23 4.96h128.66v.27H42.23z"></path>
	</svg>

	<p class="copyright">© 2004 - 2021 Aspidanetwork Games GmbH</p>
</nav>