function getval(something){
  localStorage.setItem("storageName",something.value);
  location.href = something.value;
  //document.getElementById('sort-select').value = something.value;
}

$( document ).ready(function() {
  var exist = false;
  for (i = 0; i < document.getElementById("sort-select").length; ++i){
    if (document.getElementById("sort-select").options[i].value == localStorage.getItem("storageName")){
      exist = true;
    }
  }
  if(exist) {
    document.getElementById('sort-select').value = localStorage.getItem("storageName");
  }
});
