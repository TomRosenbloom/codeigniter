

<?php echo validation_errors(); ?>

<?php echo form_open('create'); ?>

    <label for="title">Title</label>
    <select class="" name="title_id">
        <option value="1">Mr</option>
        <option value="2">Ms</option>
    </select>

    <label for="first_name">First name</label>
    <input type="input" name="first_name" /><br />

    <label for="last_name">Last name</label>
    <input type="input" name="last_name" /><br />

    <label for="birth_date">Date of birth</label>
    <input type="input" name="birth_date" /><br />

    <label for="addr_1">Address line 1</label>
    <input type="input" name="addr_1" /><br />

    <label for="addr_2">Address line 2</label>
    <input type="input" name="addr_2" /><br />

    <label for="city_id">City</label>
    <input type="input" name="city_id" /><br />

    <label for="postcode">Postcode</label>
    <input type="input" name="postcode" /><br />

    <label for="tel">Telephone</label>
    <input type="input" name="tel" /><br />

    <label for="email">Email address</label>
    <input type="input" name="email" /><br />

    <input type="submit" name="submit" value="Create contact" />

</form>
