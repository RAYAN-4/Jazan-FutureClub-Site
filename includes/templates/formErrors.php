<?php
global $errors;


if (count($errors) > 0) { ?>
    <div>
        <?php  

        foreach($errors as $key => $value) { ?>
     <li class="form_message_div" > <?php echo $value;  ?> </li>
     <?php   }
        ?>
    </div>
 <?php  }

