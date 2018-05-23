<div class="grid-x grid-padding-x">
    <div class="cell">
        <?php echo validation_errors(); ?>
    </div>
</div>

<?php echo form_open('create'); ?>

<?php $this->load->view('contacts/_form'); ?>

<div class="grid-x grid-padding-x">
    <div class="cell">
        <input type="submit" class="button" name="submit" value="Create contact" />
    </div>

</div>

</form>

<script>
$(function(){
    $('#dob').datepicker({
        changeMonth: true,
        changeYear: true,
        format: 'mm-dd-yyyy',
        disableDblClickSelection: true
    });
});
</script>
