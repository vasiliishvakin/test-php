$(document).ready(function () {
    $("#place").change(function() {
        update_nearest();
    });
    $("#length").change(function() {
        update_nearest();
    });
});

function update_nearest() {
    let place = $("#place").val();
    let length = $("#length").val();
    if (place <= 0 || length <= 0) {
        return false;
    }

    let api = "/?place=" + place + "&length=" + length;

    $("#results").load(api);
}