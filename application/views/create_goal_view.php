<div class="container" data-role="content">
	<h1><?php echo $heading;?></h1>
    <div data-role="fieldcontain">
        <form action="/create/goal" method="post">
            <fieldset data-role="controlgroup">
                <label class='control-label'>What's your goal?</label>
                <input class="span6" type="text" name="goal" placeholder="suggestion: <?php echo $suggestion; ?>">
                <label class='control-label'>When is it due?<?php echo $subscribed?" We'll send you a reminder that morning":" We won't remind you unless you <a href='/subscription'>re-subscribe</a>";?>.</label>
                <input class="span6" type="text" name="due_date" data-datepicker-format="yyyy-mm-dd" data-datepicker-nodefault="false" />
                <label class='control-label'>How many points is it worth?</label>
                <ul class="inline">
                    <li><span id="pointHolder" class="uneditable-input" style="min-width: 3em;">1</span></li>
                    <li><input name="points" width="100%" id="slider" type="text" data-slider="true" data-slider-step="1" data-slider-range="1,20"></li>
                </ul>
                <span class="help-block">
                    One point should be the minimum you can do for any goal. This is also the minimum reward.
                    <br>
                    For example, one point, one small treat.
                </span>
            </fieldset>
            <button type="submit" class="btn btn-primary">Create Goal</button>
        </form>
    </div>
</div>

<script type="text/javascript">
    $("#slider").bind("slider:changed", function (event, data) {
        // The currently selected value of the slider
        $("#pointHolder").html(data.value);
    });
</script>