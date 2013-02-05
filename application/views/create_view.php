<div class="container">
	<h1><?php echo $heading;?></h1>
    <div>
        <form action="/create" method="post">
            <fieldset>
                <label class='control-label'>What's your goal?</label>
                <input class="span6" type="text" name="goal">
                <label class='control-label'>When is it due?</label>
                <input class="span6" type="text" name="due_date" data-datepicker-format="yyyy-mm-dd" data-datepicker-nodefault="false" />
                <label class='control-label'>What's your reward?</label>
                <div class="input-append">
                    <input class="span4" id="appendedDropdownButton" name="reward" type="text">
                    <div class="btn-group">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            Suggestions
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a onclick="suggest(this)">A Cookie</a></li>
                            <li><a onclick="suggest(this)">1 hour of video games</a></li>
                            <li><a onclick="suggest(this)">Bubble bath</a></li>
                            <li><a onclick="suggest(this)">1 chapter of a book</a></li>
                            <li><a onclick="suggest(this)">Dinner out</a></li>
                            <li class="divider"></li>
                            <li><a onclick="suggest(this)">1 Point</a></li>
                            <li><a onclick="suggest(this)">2 Points</a></li>
                            <li><a onclick="suggest(this)">3 Points</a></li>
                        </ul>
                    </div>
                </div><span class="help-block">Rewards can be anything you want, but it works best if you pick something that's good for you and makes you feel a little guilty, or something that you always want to do, but never find time for.</span>
            </fieldset>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Goal</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function suggest(val)
    {
        $("#appendedDropdownButton").attr("value",val.innerHTML);
    }
</script>