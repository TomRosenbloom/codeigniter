<?php
echo "<h2>" . $contact['first_name'] . " " . $contact['last_name'] . "</h2>";
echo $contact['email'];
?>
<p>
<a href="<?= site_url('edit/' . $contact['slug']) ?>">Edit</a>
</p>
<?php echo form_open('delete/' . $contact['id'], array('onsubmit' => "return confirm('Really delete?')")); ?>
    <input type="submit" value="delete">
</form>
