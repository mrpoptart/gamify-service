<div class="container">
	<h1><?php echo $heading;?></h1>
    <div>
        <form action="/create/reward" method="post">
            <fieldset>
                <label class='control-label'>What's your reward?</label>
                <input class="span6" type="text" name="reward" placeholder="suggestion: <?php echo $suggestion;?>">
                <label class='control-label'>How many points will it cost?</label>
                <input type="number" value="1" name="points" onchange="checkPoints(this)"/>
                <span class="help-block">Rewards can be anything you want, but it works best if you pick something that's good for you and makes you feel a little guilty, or something that you always want to do, but never find time for.</span>
            </fieldset>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Reward</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function checkPoints(input)
    {
        if(input.value < 1)
        {
            input.value=1;
        }
    }
</script>