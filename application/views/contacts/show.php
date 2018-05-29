<div class="grid-x grid-padding-x">
  <div class="cell">
      <h2><?= $contact['first_name'] . " " . $contact['last_name'] ?></h2>
  </div>
  <div class="cell">
      Status: <?php echo($contact['status'] == 1) ? 'active' : 'inactive' ?>
  </div>
  <div class="cell">
      Email address: <?= $contact['email'] ?>
  </div>
  <div class="cell">
      &nbsp;
  </div>
  <div class="cell">
      <a href="<?= site_url('edit/' . $contact['id']) ?>"><button type="button" class="success button">Edit</button></a>
      <?php if ($contact['status'] == 1) { ?>
          <a href="<?= site_url('confirm_deactivate/' . $contact['id']) ?>"><button type="button" class="warning button">Deactivate</button></a>
      <?php } else { ?>
          <a href="<?= site_url('confirm_reactivate/' . $contact['id']) ?>"><button type="button" class="warning button">Reactivate</button></a>
      <?php } ?>
      <a href="<?= site_url('confirm_delete/' . $contact['id']) ?>"><button type="button" class="alert button">Delete</button></a>
  </div>
</div>
