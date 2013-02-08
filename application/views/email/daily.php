<html>
<head>
    <style>
        body
        {
            font-family : sans-serif;
        }
    </style>
</head>
<body>
<h1>Gamify for <?php echo $user->username; ?></h1>
<p>This is an automated message sent to you by
    <a href="<?php echo base_url(); ?>"><?php echo $_SERVER['SERVER_NAME']; ?></a>
    and will be the only email you receive from us today. </p>
<!--<?php print_r($user)?>-->
<p>The following goals are due today:</p>
<table width="100%" cellpadding="5" cellspacing="0" style="border:1px solid">
    <thead style="background-color:#DDD">
    <th align="left" style="padding-right:10px;">Goal</th>
    <th width="100" align="left">Value</th>
    </thead>

    <?php foreach ($user->goals as $i => $user_goal):?>
    <tr style='<?php echo ( ($i % 2) ? '' : 'background-color:#eee' ) ?>'>
    <td align='left' style='padding-right:10px'><?php echo $user_goal->goal;?></td>
    <td align='left'><?php echo $user_goal->points;?>&nbsp;Point<?php echo $user_goal->points==1?"":"s";?></td>
    </tr>
    <?php
        $this->Db_model->notify($user_goal->goal_id);
        endforeach;
    ?>
</table>
<p><a href='<?php echo base_url(); ?>subscription/unsubscribe?user_id=<?php echo $user->user_id; ?>&verify=<?php echo $user->password; ?>'>Click here if you'd like to unsubscribe</a></p>
</html>