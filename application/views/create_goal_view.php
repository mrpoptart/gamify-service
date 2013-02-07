<div class="container">
	<h1><?php echo $heading;?></h1>
    <div>
        <form action="/create/goal" method="post">
            <fieldset>
                <label class='control-label'>What's your goal?</label>
                <input class="span6" type="text" name="goal">
                <label class='control-label'>When is it due?</label>
                <input class="span6" type="text" name="due_date" data-datepicker-format="yyyy-mm-dd" data-datepicker-nodefault="false" />
                <label class='control-label'>How many points is it worth?</label>
                <div class=" input-prepend input-append">
                    <div class="btn-group">
                        <a class="btn" onmousedown="startHoldDecrease()" onmouseup="stopHoldDecrease()"><i class="icon-minus-sign"></i></a>
                    </div>
                    <span id="pointHolder" class="input-mini uneditable-input">1</span>
                    <input id="pointInput" name="points" value='1' type="hidden">
                    <div class="btn-group">
                        <a class="btn" onmousedown="startHoldIncrease()" onmouseup="stopHoldIncrease()"><i class="icon-plus-sign"></i></a>
                    </div>
                </div>
                <span class="help-block">
                    One point should be the minimum you can do for any goal. This is also the minimum reward.
                    <br>
                    For example, one point, one small treat.
                </span>
            </fieldset>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Goal</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var value= 1,
        holdUp=false,
        holdDown=false,
        interval=300;
    timeout;
    function adjust(val)
    {
        value += val;
        $("#pointInput").attr("value", value);
        $("#pointHolder").html(value);
    }
    function startHoldIncrease()
    {
        holdUp=true;
        holdIncrease();
    }
    function stopHoldIncrease()
    {
        holdUp=false;
        clearTimeout(timeout);
        interval = 300;
    }
    function holdIncrease()
    {
        if(holdUp)
        {
            adjust(1);
            interval-=interval>25?25:0;
            timeout = setTimeout(holdIncrease,interval)
        }
    }
    function startHoldDecrease()
    {
        holdDown=true;
        holdDecrease();
    }
    function stopHoldDecrease()
    {
        holdDown=false;
        clearTimeout(timeout);
        interval = 300;
    }
    function holdDecrease()
    {
        if(holdDown && value>1)
        {
            adjust(-1);
            interval-=interval>25?25:0;
            timeout = setTimeout(holdDecrease,interval)
        }
    }

</script>