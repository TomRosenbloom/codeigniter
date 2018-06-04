<?php //echo "<pre>"; var_dump($contacts); echo "</pre>"; ?>
<?php if($this->session->flashdata('message')) { ?>
<div class="grid-x grid-padding-x">
    <div class="callout success">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
</div>
<?php } ?>
<div class="grid-x grid-padding-x">
    <div class="cell">
        <p>
            <a href="<?= site_url('create'); ?>">Add a new contact</a>
        </p>
    </div>
</div>
<div class="grid-x grid-padding-x">
    <div class="cell">
        <?= $links; ?>
    </div>
</div>
<div class="grid-x grid-padding-x">
    <div class="cell">
        <table id="contactsTable">
            <thead>
                <tr>
                    <th colspan="3" width="60">&nbsp;</th>
                    <th><a href="<?= site_url('/' . 'last_name') ?>">Name</a></th>
                    <th>Title</th>
                    <th>Date of birth</th>
                    <th>City</th>
                    <th><a href="<?= site_url('/' . 'postcode') ?>">Postcode</a></th>
                    <th>Telephone</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr <?php echo ($contact->status == 0) ? 'class="deactivated"' : '' ?> >
                        <td class="iconCell">
                            <a href="<?= site_url('edit/' . $contact->id) ?>">
                                <i class="fas fa-user-edit fa-lg" title="Edit contact <?= $contact->first_name . " " .  $contact->last_name ?>"></i>
                            </a>
                        </td>
                        <td class="iconCell">
                            <?php if($contact->status == 1) { ?>
                                <a href="<?= site_url('confirm_deactivate/' . $contact->id) ?>">
                                    <i class="fas fa-user-minus fa-lg" title="Deactivate contact <?= $contact->first_name . " " .  $contact->last_name ?>"></i>
                                </a>
                            <?php } else { ?>
                                <a href="<?= site_url('confirm_reactivate/' . $contact->id) ?>">
                                    <i class="fas fa-user-plus fa-lg" title="Reactivate contact <?= $contact->first_name . " " .  $contact->last_name ?>"></i>
                                </a>
                            <?php } ?>
                        </td>
                        <td class="iconCell">
                            <a href="<?= site_url('confirm_delete/' . $contact->id) ?>">
                                <i class="fas fa-user-times fa-lg" title="Delete contact <?= $contact->first_name . " " .  $contact->last_name ?>"></i>
                            </a>
                        </td>
                        <td>
                            <a href="<?= site_url('contact/'.$contact->id); ?>">
                                <?= $contact->first_name . " " . $contact->last_name; ?>
                            </a>
                        </td>
                        <td><?= isset($contact->honorific) ? $contact->honorific : '' ?></td>
                        <td><?= isset($contact->birth_date) && $contact->birth_date != 0 ? $contact->birth_date : 'not entered' ?></td>
                        <td><?= isset($contact->city_name) ? $contact->city_name : '' ?></td>
                        <td><?= isset($contact->postcode) ? $contact->postcode : '' ?></td>
                        <td><?= isset($contact->tel) && !empty($contact->tel) ? $contact->tel : 'not entered' ?></td>
                        <td><?= isset($contact->email) && !empty($contact->email) ? $contact->email : 'not entered' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
