function submitOrder() {
    $.post("order.php", function (data) {

        if (data === "true") {
            $('.toast-success').toast({ delay: 1800 }).toast('show');
            document.getElementById("submit-order").disabled = true;
            setTimeout(() => window.location = 'index.php', 1300);
        }

        else if (data.startsWith("http")) {
            window.location.href = data;
        }

        else {
            $('.toast-fail').toast({ delay: 1800 }).toast('show');
        }
    });
}
function refresh() {
    window.open('index.php', '_self')
}
document.querySelector('#submit-order').addEventListener("click", function () {
    submitOrder()
});