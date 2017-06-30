<?php
function smarty_modifier_truncate_utf($string, $length = 80, $etc = '...', $break_words = false, $middle = false)
{
     if ($length == 0)
          return '';

      if (strlen($string) > $length) {
          $length -= min($length, strlen($etc));
          for($i = 0; $i < $length ; $i++) {
     $strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
    }
    return $strcut.$etc;  
        
      } else {
          return $string;
      }
}
?>

