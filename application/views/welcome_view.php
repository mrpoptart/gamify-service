<div class="container">
	<h1><?php echo $heading;?></h1>

    <p>Gamification is a theory of productiveness. By creating and tracking goals and rewards your incentive and mindfulness about tasks increases.</p>
    <p>This system is designed to be an easy-to-use interface for gamifying your life.</p>
    <?php if(!$this->tank_auth->is_logged_in()):?>
        <?php echo anchor('/auth/login', 'Login');?> or <?php echo anchor('/auth/register', 'Register');?>
    <?php endif;?>
</div>