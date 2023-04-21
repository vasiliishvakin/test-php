<div>
    <?php
    if (isset($nearest)) {
        /** @var array $nearest */
        foreach ($nearest as $name => $length) {
            echo sprintf("<p>%s (%s km)</p>\n", $name, $length);
        }
    }
    ?>
</div>
