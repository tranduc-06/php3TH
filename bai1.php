<form method="POST">
<textarea name="content">
<?php
    if (isset($_POST['content'])) {
        echo $_POST['content'];
    }
?>
</textarea>
<input type="submit" name="Convert">
</form>

<textarea>
<?php
    function convertPhp($input) {
        $a = strpos($input,'$');
        $b = strpos($input,'_');
        $char = substr($input, $a, 2);
        $char1 = substr($input, $b, 2);
        $low = str_replace($char, strtolower($char), $input);
        $low1 = str_replace($char1, strtolower($char1), $low);
        
        $c = str_replace( '=', ' = ', $low1);
        $d = str_replace( '_', '', $c );

        $BehindEqual = str_replace( 'array(', '[', $d);
        $BehindEqual1 = str_replace( ')', ']', $BehindEqual);


        return $BehindEqual1;
    }

    if (isset($_POST['content'])) {
        echo convertPhp($_POST['content']);
    }
?>
</textarea>