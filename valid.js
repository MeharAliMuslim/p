function validform() {
    var itemName = document.forms[0].item_name.value;
    var price = document.forms[0].price.value;
    var purchasedDate = document.forms[0].purchased_date.value;
    var reserved = document.forms[0].reserved.value;
    var sold = document.forms[0].sold.value;
    var availableStock = document.forms[0].available_stock.value;
    var summary = document.forms[0].summary.value;
    var image = document.forms[0].image.value;

    // Check if all fields are filled
    if (itemName === '' || price === '' || purchasedDate === '' || reserved === '' || sold === '' ||
        availableStock === '' || summary === '' || image === '') {
        alert('Please fill in all fields.');
        return false;
    }

    // Additional validation logic if needed

    return true;
}
