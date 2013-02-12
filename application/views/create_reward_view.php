<div class="container">
	<h1><?php echo $heading;?></h1>
    <div>
        <form action="/rewards" method="post">
            <fieldset>
                <label class='control-label'>What's your reward?</label>
                <div class="control-group<?php echo form_error('reward')==""?"":" error"; ?>">
                    <div class="input-append">
                        <input id="reward" class="span6" type="text" name="reward" placeholder="suggestion: <?php echo $suggestion;?>">
                        <span class="add-on" onclick="getSuggestion()" title="Get a new suggestion"><i class="icon-refresh"></i></span>
                        <span class="add-on" onclick="applySuggestion()" title="Use this suggestion"><i class="icon-ok"></i></span>
                    </div>
                    <?php echo form_error('reward')==''?'':'<span class="help-block">Reward is required</span>'; ?>
                </div>
                <label class='control-label'>How many points will it cost?</label>
                <input class="span6" type="number" value="1" name="points" onchange="checkPoints(this)"/>
                <span class="help-block">Rewards can be anything you want, but it works best if you pick something that's good for you and makes you feel a little guilty, or something that you always want to do, but never find time for.</span>
            </fieldset>
            <button type="submit" class="btn btn-primary">Create Reward</button>
        </form>
    </div>
</div>

<script type="text/javascript">
    var suggestion="<?php echo $suggestion; ?>";

    function checkPoints(input)
    {
        if(input.value < 1)
        {
            input.value=1;
        }
    }
    function getSuggestion()
    {
        $.get("http://gamify.morganengel.com/ajax/get_reward_suggestion",function(result){
            suggestion = result;
            $("#reward").attr("value", "");
            $("#reward").attr("placeholder", "suggestion: "+suggestion);
        })
    }
    function applySuggestion()
    {
        $("#reward").attr("value", suggestion);
    }
</script>