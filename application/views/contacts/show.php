<div class="grid-x grid-padding-x">
  <div class="cell">
      <h2><?= $contact['first_name'] . " " . $contact['last_name'] ?></h2>
  </div>
  <div class="cell small-2">
      Email address:
  </div>
  <div class="cell small-4">
      <?= $contact['email'] ?>
  </div>
  <div class="cell">
      &nbsp;
  </div>
  <div class="cell">
      <button type="button" class="success button"><a href="<?= site_url('edit/' . $contact['slug']) ?>">Edit</a></button>
      <?php echo form_open('delete/' . $contact['id'], array('onsubmit' => "return confirm('Really delete?')", 'style' => "display: inline")); ?>
          <input type="submit" value="delete" class="alert button">
      </form>
  </div>
</div>
