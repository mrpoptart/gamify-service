<div class="container">
    <form action="/auth/register" method="post">
        <fieldset>
            <legend>Register for Gamify</legend>
            <?php
            echo validation_errors();
            $fields=array("username", "email", "password", "confirm_password");
            foreach($fields as $field):?>
            <div class="control-group<?php echo isset($errors[$field])?" error":""?>">
                <label><?php echo ucwords(str_replace("_"," ",$field));?></label>
                <input type="<?php echo preg_match("/password/", $field)?"password":"text" ?>" class="span5" name="<?php echo $field;?>" value="<?php echo @$_POST[$field];?>">
                <?php if(isset($errors[$field])): ?>
                    <span class="help-block"><?php echo $errors[$field];?></span>
                <?php endif;?>
            </div>
            <?php endforeach; ?>
        </fieldset>
        <button type="submit" class="btn">Submit</button>
    </form>
</div>