<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/css/places.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="/js/places.js"></script>

    <script>
        $( function() {
            $( "#slider" ).slider({
                range: true,
                min: 0,
                max: 10000,
                values: [ 0, 10000 ],
                slide: function( event, ui ) {
                    $( "#length" ).val( ui.value );
                    update_nearest();
                }
            });
        } );
    </script>

</head>
<body>

<div class="form" style="border: 1px solid black;">
    <form id="search" method="GET" enctype="multipart/form-data">
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
            <div id="slider"></div
    </form>
</div>
<div class="results" id="results" style="border: 1px solid black;">
    <?php
    if (isset($nearest)) {
        /** @var array $nearest */
        foreach ($nearest as $name => $length) {
            echo sprintf("<p>%s</p>\n", $name);
        }
    }
    ?>
</div>

</body>
</html>



