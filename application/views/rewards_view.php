<?php
/*function get_time($seconds)
{
    $time_formats = array(
        array(-172800, round($seconds/-86400).' days ago'),
        array(-86400, 'yesterday'),
        array(-7200, round($seconds/-3600).' hours ago'),
        array(-3600, '1 hour ago'),
        array(-120, round($seconds/-60).' minutes ago'),
        array(-60, '1 minute ago'),
        array(61, '1 minute'),
        array(121, round($seconds/120).' minutes'),
        array(3601, '1 hour'),
        array(7201, round($seconds/7200).' hours'),
        array(86401, 'tomorrow'),
        array(172801, round($seconds/172800).' days'),
    );
    $i = 0;
    $match = $time_formats[$i][0];
    while($match < $seconds)
    {
        $i++;
        $match = $time_formats[$i][0];
    }
    return $time_formats[$i][1];
}
function relativeTime($time) {

    $d[0] = array(1,"second");
    $d[1] = array(60,"minute");
    $d[2] = array(3600,"hour");
    $d[3] = array(86400,"day");
    $d[4] = array(604800,"week");
    $d[5] = array(2592000,"month");
    $d[6] = array(31104000,"year");

    $w = array();

    $return = "";
    $now = time();
    $diff = ($now-$time);
    $secondsLeft = $diff;

    for($i=6;$i>-1;$i--)
    {
        $w[$i] = intval($secondsLeft/$d[$i][0]);
        $secondsLeft -= ($w[$i]*$d[$i][0]);
        if($w[$i]!=0)
        {
            $return.= abs($w[$i]) . " " . $d[$i][1] . (($w[$i]>1)?'s':'') ." ";
        }

    }

    $return .= ($diff>0)?"ago":"left";
    return $return;
}*/
?>
<div class="container">
	<h1>Rewards for <?php echo $this->tank_auth->get_username() ?></h1>
    <h4 id="pointsLeft">You have <?php echo $points; ?> point<?php echo $points==1?"":"s" ?></h4>
    <table id="goalsTable" class="table table-border tablesorter table-striped">
        <thead>
            <tr>
                <th></div>Reward<div class="icon-arrow-down"/></th>
                <th class="span1">Points<div class="icon-arrow-down"/></th>
                <th class="span2 centered">Claimed?<div class="icon-arrow-down"/></th>
            </tr>
        </thead>
        <?php foreach($rewards as $reward): ?>
        <tr>
            <td><?php echo $reward->reward; ?></td>
            <td><?php echo $reward->points; ?>&nbsp;Point<?php echo $reward->points==1?"":"s" ?></td>
            <td id="form<?php echo $reward->id;?>" class="span2">
            <?php if($reward->rewarded_date != ''):?>
                <p class="btn btn-disabled span2">Claimed!</p>
            <?php else: ?>
                <a onclick="done(<?php echo $reward->id; ?>)" class="btn btn-primary span2">Claim</a>
            <?php endif; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<script type="text/javascript">
    var rewards={
        <?php foreach($rewards as $reward): ?>
        <?php echo $reward->id;?>:<?php echo $reward->points;?>,
        <?php endforeach; ?>
    },
    points=<?php echo $points;?>;
    $(document).ready(function()
        {
            $("#goalsTable").tablesorter();
        }
    );
    function done(val)
    {
        var pointCost = rewards[val];
        if(pointCost <= points)
        {
            points-=pointCost;
            $('#form'+val).html('<p class="btn btn-primary span2 disabled">Claiming...</p>');
            $.post('/ajax/reward', {reward:val}, function(data) {
                $('#form'+val).html(data);
            });
            $("#pointsLeft").html("You have "+points+" point"+(points==1?"":"s"));
        }
        else
        {
            alert("You only have "+points+" points and you need "+pointCost+" points.\nFinish a goal first.");
        }
    }
</script>