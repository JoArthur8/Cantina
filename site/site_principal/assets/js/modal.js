var quantModal = document.getElementById('quantModal');
  quantModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var itemId = button.getAttribute('data-itemid');
    var itemName = button.getAttribute('data-itemname');
    var itemPrice = button.getAttribute('data-itemprice');

    document.getElementById('modalCodItem').value = itemId;
    document.getElementById('modalItemInfo').textContent = itemName + " — R$ " + (parseFloat(itemPrice).toFixed(2)).replace('.', ',');
    document.getElementById('modalQtd').value = 1;
  });