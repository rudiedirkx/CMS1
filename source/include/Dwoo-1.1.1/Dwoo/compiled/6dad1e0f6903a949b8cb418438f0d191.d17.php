<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html>
<html>

<head>
<title>Example|<?php echo $this->readVarInto(array (  1 =>   array (    0 => '->',  ),  2 =>   array (    0 => 'title',  ),  3 =>   array (    0 => '',    1 => '',  ),), $this->scope["this"], false);?></title>
</head>

<body>

<h1><?php echo $this->readVarInto(array (  1 =>   array (    0 => '->',  ),  2 =>   array (    0 => 'title',  ),  3 =>   array (    0 => '',    1 => '',  ),), $this->scope["this"], false);?></h1>
<?php echo $this->readVarInto(array (  1 =>   array (    0 => '->',  ),  2 =>   array (    0 => 'content_1',  ),  3 =>   array (    0 => '',    1 => '',  ),), $this->scope["this"], false);?>


<?php if (ifsetor((isset($this->scope["oele"]) ? $this->scope["oele"] : null), 0) == ifsetor((isset($this->scope["boele"]) ? $this->scope["boele"] : null), -1)) {
?>
Yup!
<?php 
}?>


</body>

</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>