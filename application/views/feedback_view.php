<div class="container">
    <h1>Send Feedback</h1>
    <div>
        <form action="/feedback" method="post">
            <fieldset>
                <label class='control-label'>Email Address</label>
                <input class="span6" type="text" name="email" value="<?php echo set_value('email'); ?>">
                <?php echo form_error('email', '<p class="label label-important">', '</p>'); ?>
                <label class='control-label'>Message</label>
                <textarea rows="4" class="span6" type="text" name="message"><?php echo set_value('message'); ?></textarea>
                <?php echo form_error('message', '<p class="label label-important">', '</p>'); ?>
            </fieldset>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Send Feedback</button>
            </div>
        </form>
    </div>
    <?php
    echo $this->session->flashdata('feedback');
    $this->session->set_flashdata('feedback', '');
    ?>
</div>