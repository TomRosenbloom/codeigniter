<div class="grid-x grid-padding-x">
    <div class="cell">
        <?php echo validation_errors(); ?>
    </div>
</div>

<?php echo form_open('update'); ?>

<input type="hidden" name="id" value="<?= $contact['id'] ?>">

<?php $this->load->view('contacts/_form'); ?>

<div class="grid-x grid-padding-x">
    <div class="cell">
        <input type="submit" class="button" name="submit" value="Update contact" />
    </div>
</div>

</form>
