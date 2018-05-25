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
                            <a href="<?= site_url('contact/'.$contact->slug); ?>">
                                <?= $contact->first_name . " " . $contact->last_name; ?>
                            </a>
                        </td>
                        <td><?= $contact->city ?? '' ?></td>
                        <td><?= isset($contact->postcode) ? $contact->postcode : '' ?></td>
                        <td><?= isset($contact->email) ? $contact->email : '' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
