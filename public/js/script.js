$(function(){

  // handle delete button click
  $('body').on('click', '.todo-delete-btn', function(e) {
    e.preventDefault();

    // get the id of the todo task
    if (confirm("Press a button!")) {
      var id = $(this).attr('data-id');
    
      // get csrf token value
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      console.log(csrf_token);
  
      // now make the ajax request
      $.ajax({
        'url': 'edit/todo/' + id,
        'type': 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrf_token }
      }).done(function() {
        console.log('Todo task deleted: ' + id);
        window.location = window.location.href;
      }).fail(function() {
        alert('something went wrong!');
      });  } else {
  txt = "You pressed Cancel!";
}

  });

});


$(function(){

  // handle delete button click
  $('body').on('click', '.url-delete-btn', function(e) {
    e.preventDefault();

    // get the id of the todo task
      if (confirm("Press a button!")) {
        var id = $(this).attr('data-ID');
      
        // get csrf token value
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        console.log(csrf_token);
    
        // now make the ajax request
        $.ajax({
          'url': 'todo/' + id,
          'type': 'DELETE',
          headers: { 'X-CSRF-TOKEN': csrf_token }
        }).done(function() {
          console.log('Todo task deleted: ' + id);
          window.location = window.location.href;
        }).fail(function() {
          alert('something went wrong!');
        });  } else {
    txt = "You pressed Cancel!";
  }


  });
  

});

$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#keyword_serch div, li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});