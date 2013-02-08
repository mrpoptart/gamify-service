<div class="container">
	<h1><?php echo $heading;?></h1>
    <div>
        <form action="/create/reward" method="post">
            <fieldset>
                <label class='control-label'>What's your reward?</label>
                <input class="span6" type="text" name="reward" placeholder="suggestion: <?php echo $suggestion;?>">
                <label class='control-label'>How many points will it cost?</label>
                <ul class="inline">
                    <li><span id="pointHolder" class="uneditable-input" style="min-width: 3em;">1</span></li>
                    <li><input name="points" width="100%" id="slider" type="text" data-slider="true" data-slider-step="1" data-slider-range="1,50"></li>
                </ul>
                </div><span class="help-block">Rewards can be anything you want, but it works best if you pick something that's good for you and makes you feel a little guilty, or something that you always want to do, but never find time for.</span>
            </fieldset>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Reward</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $("#slider").bind("slider:changed", function (event, data) {
        // The currently selected value of the slider
        $("#pointHolder").html(data.value);
    });
</script>