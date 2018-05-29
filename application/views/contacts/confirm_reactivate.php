<?php echo form_open(); ?>

<input type="hidden" name="id" value="<?= $contact['id'] ?>">

<div class="grid-x grid-padding-x">
    <div class="cell">
        <p>
            Reactivate <?= $contact['first_name'] ?>?
        </p>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell">
        <input type="submit" class="button" name="submit" value="Cancel" />
        <input type="submit" class="warning button" name="submit" value="Reactivate" />
    </div>
</div>

</form>
