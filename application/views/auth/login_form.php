<div class="container">
    <form action="/auth/login" method="post">
        <fieldset>
            <legend>Login to Gamify</legend>
            <p>Gamification is a theory of productiveness. By creating and tracking goals and rewards your incentive and mindfulness about tasks increases.</p>
            <p>This system is designed to be an easy-to-use interface for gamifying your life.</p>
            <?php
            echo validation_errors();
            $fields=array("login", "password");
            foreach($fields as $field):?>
                <div class="control-group<?php echo isset($errors[$field])?" error":""?>">
                    <label><?php echo ucwords(str_replace("_"," ",$field));?></label>
                    <input type="<?php echo preg_match("/password/", $field)?"password":"text" ?>" class="span5" name="<?php echo $field;?>" value="<?php echo @$_POST[$field];?>">
                    <?php if(isset($errors[$field])): ?>
                        <span class="help-block"><?php echo $errors[$field];?></span>
                    <?php endif;?>
                </div>
            <?php endforeach; ?>
            <label class="checkbox">
                <input type="checkbox" name="remember" value="1"> Remember me
            </label>
            <input type="hidden" id="timezone_offset" value="" name="timezone_offset"/>
        </fieldset>
        <button type="submit" class="btn btn-primary">Log In</button>
        <a href="/auth/register" class="btn">Register</a>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $("#timezone_offset").attr("value",new Date().getTimezoneOffset());
    })
</script>