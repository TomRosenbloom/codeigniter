<div class="grid-x grid-padding-x">
    <div class="cell">
        <p>
            <a href="<?php echo site_url('create'); ?>">Add a new contact</a>
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
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>City</th>
                    <th>Postcode</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td>
                            <a href="<?php echo site_url('contact/'.$contact->slug); ?>">
                                <?php echo $contact->first_name . " " . $contact->last_name; ?>
                            </a>
                        </td>
                        <td><?= $contact->city ?? '' ?></td>
                        <td><?= isset($contact->postcode) ? $contact->postcode : '' ?></td>
                        <td><?php echo isset($contact->email) ? $contact->email : '' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
