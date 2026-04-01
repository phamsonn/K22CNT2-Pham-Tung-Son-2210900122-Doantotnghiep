function addCart(productId) {
  const input = document.getElementById("qty-" + productId);
  let value = input ? input.value : "";

  value = value.trim();

  if (value === "") {
    showSuccess();
    return;
  }

  if (!/^[0-9]+$/.test(value)) {
    showError();
    return;
  }

  const qty = Number(value);

  if (qty <= 0) {
    showError();
    return;
  }

  showSuccess(productId, qty);
}

function showSuccess(id, qty) {
  $.post("CartProcess.php?", { 'productID': id, 'qty': qty, }, function (data, status) {
    var result = data.split("-");

    $("#cart_amount").text(result[0]);
  });
  $('.toast').toast({ delay: 1850 });
  $('.toast').toast('show');
}

function showError() {
  alert("Số lượng sản phẩm không hợp lệ");
}