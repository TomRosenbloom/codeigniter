<div class="grid-x grid-padding-x">
    <div class="cell">
        <?php echo validation_errors(); ?>
    </div>
</div>

<?php echo form_open('create'); ?>

<div class="grid-x grid-padding-x">
    <div class="cell small-4">
        <label for="title">Title</label>
        <select class="" name="honorific_id">
            <option value="">Select title</option>
            <?php foreach($honorifics as $honorific): ?>
                <option value="<?= $honorific['id'] ?>" >
                    <?= $honorific['name'] ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-4">
        <label for="first_name">First name</label>
        <input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>"/>
    </div>

    <div class="cell small-4">
        <label for="last_name">Last name</label>
        <input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>"/>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-3">
        <label for="birth_date">Date of birth</label>
        <input type="text" name="birth_date" value="<?php echo set_value('birth_date'); ?>"/>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-8">
        <label for="addr_1">Address line 1</label>
        <input type="text" name="addr_1" value="<?php echo set_value('addr_1'); ?>"/>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-8">
        <label for="addr_2">Address line 2</label>
        <input type="text" name="addr_2" value="<?php echo set_value('addr_2'); ?>"/>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-4">
        <label for="city_id">City</label>
        <select class="" name="city_id">
            <option value="">Select city</option>
            <?php foreach($cities as $city): ?>
                <option value="<?= $city['id'] ?>"><?= $city['name'] ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="cell small-4">
        <label for="postcode">Postcode</label>
        <input type="text" name="postcode" value="<?php echo set_value('postcode'); ?>"/>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-4">
        <label for="tel">Telephone</label>
        <input type="text" name="tel" value="<?php echo set_value('tel'); ?>"/>
    </div>

    <div class="cell small-4">
        <label for="email">Email address</label>
        <input type="text" name="email" value="<?php echo set_value('email'); ?>"/>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell">
        <input type="submit" class="button" name="submit" value="Create contact" />
    </div>

</div>

</form>
