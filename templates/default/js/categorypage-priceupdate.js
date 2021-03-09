function changedInput(number) {
  var id= number.id;
  var amount = $(number).val();
  var price = $("#category-price-" + number.id).val();
  var totalPrice = amount*price;
  if (totalPrice < 0){
    totalPrice = 0;
  }
  $("#product-" + number.id).html(totalPrice.toFixed(2));
  $("#priceValue").html(totalPrice.toFixed(2));
}


$( document ).ready(function() {
  $( ".quantity" ).change(function() {
    var number = this;
    changedInput(number);
  });

  $(".quantity").keyup(function(){
    var number = this;
    changedInput(number);
  });
});
