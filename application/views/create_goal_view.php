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
                <input name="points" type="number" value="1" onchange="checkPoints(this)"/>
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
    function checkPoints(input)
    {
        if(input.value < 1)
        {
            input.value=1;
        }
    }
</script>