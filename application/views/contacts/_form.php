
<div class="grid-x grid-padding-x">
    <div class="cell small-2">
        <label for="title">Title</label>
        <select class="" name="honorific_id">
            <option value="">Select title</option>
            <?php foreach($honorifics as $honorific): ?>
                <option value="<?= $honorific['id'] ?>"
                    <?php
                    // this is pretty horrible, I'm sure there's a better way...
                    echo (isset($contact['honorific_id']) && $contact['honorific_id'] == $honorific['id']) || ($this->input->post('honorific_id') == $honorific['id']) ? 'selected="selected"' : ''
                    ?>
                    >
                    <?= $honorific['name'] ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-4">
        <label for="first_name">First name</label>
        <input type="text" name="first_name" value="<?php echo isset($contact['first_name']) ? $contact['first_name'] : set_value('first_name') ?>"/>
    </div>

    <div class="cell small-4">
        <label for="last_name">Last name</label>
        <input type="text" name="last_name" value="<?php echo isset($contact['last_name']) ? $contact['last_name'] : set_value('last_name') ?>"/>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-3">
        <label for="birth_date">Date of birth</label>
        <input type="text" name="birth_date" value="<?php echo isset($contact['birth_date']) ? $contact['birth_date'] : set_value('birth_date') ?>" id="dob" />
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-8">
        <label for="addr_1">Address line 1</label>
        <input type="text" name="addr_1" value="<?php echo isset($contact['addr_1']) ? $contact['addr_1'] : set_value('addr_1') ?>"/>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-8">
        <label for="addr_2">Address line 2</label>
        <input type="text" name="addr_2" value="<?php echo isset($contact['addr_2']) ? $contact['addr_2'] : set_value('addr_2') ?>"/>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-4">
        <label for="city_id">City</label>
        <select class="" name="city_id">
            <option value="">Select city</option>
            <?php foreach($cities as $city): ?>
                <option value="<?= $city['id'] ?>"
                    <?php
                    // this is pretty horrible, I'm sure there's a better way...
                    echo (isset($contact['city_id']) && $contact['city_id'] == $city['id']) || ($this->input->post('city_id') == $city['id']) ? 'selected="selected"' : ''
                    ?>
                    >
                    <?= $city['name'] ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-4">
        <label for="postcode">Postcode</label>
        <input type="text" name="postcode" value="<?php echo isset($contact['postcode']) ? $contact['postcode'] : set_value('postcode') ?>"/>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-4">
        <label for="tel">Telephone</label>
        <input type="text" name="tel" value="<?php echo isset($contact['tel']) ? $contact['tel'] : set_value('tel') ?>"/>
    </div>
</div>

<div class="grid-x grid-padding-x">
    <div class="cell small-4">
        <label for="email">Email address</label>
        <input type="text" name="email" value="<?php echo isset($contact['email']) ? $contact['email'] : set_value('email') ?>"/>
    </div>
</div>
