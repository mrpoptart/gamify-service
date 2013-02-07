<div class="container">
	<h1><?php echo $heading;?></h1>
    <div>
        <form action="/create/reward" method="post">
            <fieldset>
                <label class='control-label'>What's your reward?</label>
                <input class="span6" type="text" name="reward">
                <label class='control-label'>How many points will it cost?</label>
                <div class=" input-prepend input-append">
                    <div class="btn-group">
                        <a class="btn" onmousedown="startHoldDecrease()" onmouseup="stopHoldDecrease()"><i class="icon-minus-sign"></i></a>
                    </div>
                    <span id="pointHolder" class="input-mini uneditable-input">1</span>
                    <input id="pointInput" name="points" value='1' type="hidden">
                    <div class="btn-group">
                        <a class="btn" onmousedown="startHoldIncrease()" onmouseup="stopHoldIncrease()"><i class="icon-plus-sign"></i></a>
                    </div>
                </div><span class="help-block">Rewards can be anything you want, but it works best if you pick something that's good for you and makes you feel a little guilty, or something that you always want to do, but never find time for.</span>
            </fieldset>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Reward</button>
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