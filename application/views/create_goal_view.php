<div class="container" data-role="content">
	<h1><?php echo $heading;?></h1>
    <div data-role="fieldcontain">
        <form action="/goals" method="post">
            <fieldset data-role="controlgroup">
                <label class='control-label'>What's your goal?</label>
                <div class="control-group<?php echo form_error('goal')==""?"":" error"; ?>">
                    <div class="input-append">
                        <input id="goal" class="span6" type="text" name="goal" placeholder="suggestion: <?php echo $suggestion; ?>">
                        <span class="add-on" onclick="getSuggestion()" title="Get a new suggestion"><i class="icon-refresh"></i></span>
                        <span class="add-on" onclick="applySuggestion()" title="Use this suggestion"><i class="icon-ok"></i></span>
                    </div>
                    <?php echo form_error('goal')==''?'':'<span class="help-block">Goal is required</span>'; ?>
                </div>
                <label class='control-label'>When is it due?<?php echo $subscribed?" We'll send you a reminder that morning":" We won't remind you unless you <a href='/subscription'>re-subscribe</a>";?>.</label>
                <div class="control-group<?php echo form_error('due_date')==""?"":" error"; ?>">
                    <input class="span6" type="text" name="due_date" data-datepicker-format="yyyy-mm-dd" data-datepicker-nodefault="false" />
                    <?php echo form_error('due_date')==''?'':'<span class="help-block">Due date is required</span>'; ?>
                </div>
                <label class='control-label'>How many points is it worth?</label>
                <div class="control-group<?php echo form_error('points')==""?"":" error"; ?>">
                    <input class="span6" name="points" type="number" value="1" onchange="checkPoints(this)"/>
                    <?php echo form_error('points')==''?'':'<span class="help-block">Points are required</span>'; ?>
                </div>
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
        $.get("http://gamify.morganengel.com/ajax/get_goal_suggestion",function(result){
            suggestion = result;
            $("#goal").attr("value", "");
            $("#goal").attr("placeholder", "suggestion: "+suggestion);
        })
    }
    function applySuggestion()
    {
        $("#goal").attr("value", suggestion);
    }
</script>