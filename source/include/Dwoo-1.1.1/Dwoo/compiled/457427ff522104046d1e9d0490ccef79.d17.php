<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><h1><?php echo $this->scope["title"];?></h1>
<?php echo $this->scope["content"];
 /* end template body */
return $this->buffer . ob_get_clean();
?>