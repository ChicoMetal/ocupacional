 function guargar_ajax(form,urlsend,method){
    var ok=false;
      alert("asdas"+ok);
    var dataString = $("#form").serialize();
    $.ajax({
        type:  method,
        url:   urlsend,
        data:  dataString,
        success: function(data){
           ok =true;
           alert("aaaa"+ok);
        }
    });

    return ok;

}