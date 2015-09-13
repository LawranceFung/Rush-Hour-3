$(function(){
  var form = $(".license_form");
  $(".license_form").sumbit(function(event){
    event.preventDefault();
    var data = form.serialize();
    $.getJSON("/tickets", data, function(data){
      //TODO: finish the callback;
      console.log("Success handler called.")
    });
  })
})
