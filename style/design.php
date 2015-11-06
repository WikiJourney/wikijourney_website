<?php
   header('content-type: text/css');
   ob_start('ob_gzhandler');
   header('Cache-Control: max-age=31536000, must-revalidate'); 
?>

input[type="range"] {
    position: relative;
    margin-left: 1em;
}
input[type="range"]:after,
input[type="range"]:before {
    position: absolute;
    top: 1em;
    color: #aaa;
}
input[type="range"]:before {
    left:-3em;
    content: <?php echo $_PROFILE_LANDSCAPE ?>;
} /*attr(min)*/
input[type="range"]:after {
    right: -2em;
    content: <?php echo $_PROFILE_CITY ?>;
}