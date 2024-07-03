<div id="servertime" class="stime">
    <?php echo SERVER_TIME; ?>&nbsp;
    <span id="tp1"><?php echo date('H:i:s'); ?></span>
</div>
<?php
// Start a session to persist data across pages.
session_start();

// Define an array of supported languages and their respective codes.
$languages = array(
    'en' => 'English',
    'gr' => 'Ελληνικά', // Greek
	'tr' => 'Türkçe',// Turkishz
);

// Check if the 'lang' parameter is set in the URL.
if (isset($_GET['lang'])) {
    $selectedLang = $_GET['lang'];
    // Store the selected language in a session variable.
    $_SESSION['selectedLang'] = $selectedLang;
} else {
    // Default to English if 'lang' is not set.
    $selectedLang = isset($_SESSION['selectedLang']) ? $_SESSION['selectedLang'] : 'en';
}

// // Generate the language selection dropdown menu.
// echo '<div id="languages">';
// echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="get">';
// echo '<select name="lang" id="langSelect" onchange="this.form.submit()">';
// foreach ($languages as $code => $name) {
//     echo '<option value="' . $code . '"';
//     if ($selectedLang == $code) {
//         echo ' selected="selected"'; // Mark the selected language as default.
//     }
//     echo '>' . $name . '</option>';
// }
// echo '</select>';
// echo '</form>';
// echo '</div>';
?>
