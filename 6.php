<!-- Writing a Custom PHP Function
Write a function in PHP that converts a string like "camelCaseString" to "camel case string".

===========================Answer=============================== -->

<?php

    function camelToString($string) {
        $result = '';
        foreach (str_split($string) as $char) {
            if (ctype_upper($char)) {
                $result .= ' ' . strtolower($char);
            } else {
                $result .= $char;
            }
        }
        return trim($result);
    }

    echo camelToString("camelCaseString");
?>