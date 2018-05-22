<div class="grid-x grid-padding-x">
    <div class="cell">
        <?php echo validation_errors(); ?>
    </div>
</div>

<?php echo form_open('update'); ?>

<input type="hidden" name="id" value="<?= $contact['id'] ?>">

<div class="grid-x grid-padding-x">
    <div class="cell small-4">
        <label for="title">Title</label>
        <select class="" name="honorific_id">
            <?php foreach($honorifics as $honorific): ?>
                <option value="<?= $honorific['id'] ?>" <?php echo ($contact['honorific_id'] == $honorific['id']) ? 'selected="selected"' : '' ?> ><?= $honorific['name'] ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="cell">
        <label for="first_name">First name</label>
        <input type="input" name="first_name" value="<?= $contact['first_name'] ?>"/>
    </div>

    <div class="cell">
        <label for="last_name">Last name</label>
        <input type="input" name="last_name" value="<?= $contact['last_name'] ?>" />
    </div>

    <div class="cell">
        <label for="birth_date">Date of birth</label>
        <input type="input" name="birth_date" />
    </div>

    <div class="cell">
        <label for="addr_1">Address line 1</label>
        <input type="input" name="addr_1" />
    </div>

    <div class="cell">
        <label for="addr_2">Address line 2</label>
        <input type="input" name="addr_2" />
    </div>

    <div class="cell small-4">
        <label for="city_id">City</label>
        <select class="" name="city_id">
            <?php foreach($cities as $city): ?>
                <option value="<?= $city['id'] ?>" <?php echo ($contact['city_id'] == $city['id']) ? 'selected="selected"' : '' ?>><?= $city['name'] ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="cell">
        <label for="postcode">Postcode</label>
        <input type="input" name="postcode" value="<?= $contact['postcode'] ?>" />
    </div>

    <div class="cell">
        <label for="tel">Telephone</label>
        <input type="input" name="tel" />
    </div>

    <div class="cell">
        <label for="email">Email address</label>
        <input type="input" name="email" value="<?= $contact['email'] ?>" />
    </div>

    <div class="cell">
        <input type="submit" name="submit" value="Update contact" />
    </div>

</div>

</form>
