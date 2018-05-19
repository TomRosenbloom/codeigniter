

<?php foreach ($contacts as $contact): ?>

        <h3><?php echo $contact['first_name'] . " " . $contact['last_name']; ?></h3>
        <div class="main">
                <?php echo $contact['email']; ?>
        </div>
        <p><a href="<?php echo site_url('contacts/'.$contact['slug']); ?>">View contact</a></p>

<?php endforeach; ?>
