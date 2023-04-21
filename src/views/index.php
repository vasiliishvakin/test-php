<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test</title>
    <script
            src="https://code.jquery.com/jquery-3.6.4.js"
            integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
            crossorigin="anonymous"></script>

    <script src="/js/places.js"></script>
</head>
<body>

<div class="form" style="border: 1px solid black;">
    <form id="search" method="GET" , enctype="multipart/form-data" action="/">
        <input type="hidden" name="action">
        <select name="place" id="place">
            <option>Please select place</option>
            <?php
            /** @var array $places */
            foreach ($places as $id => $place) {
                echo sprintf("<option value=%s>%s</option>", $id, $place["name"]);
            }
            ?>
        </select>

        <input type="text" name="length" id="length">
    </form>
</div>
<div class="results" id="results" style="border: 1px solid black;">
    <?php
    if (isset($nearest)) {
        /** @var array $nearest */
        foreach ($nearest as $name=>$length) {
            echo sprintf("<p>%s</p>\n", $name);
        }
    }
    ?>
</div>

</body>
</html>



