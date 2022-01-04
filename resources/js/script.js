
$(function(){

    // handle delete button click
    $('body').on('click', '.todo-delete-btn', function(e) {
      e.preventDefault();
  
      // get the id of the todo task
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
      });
  
    });
  
  });
  $(function(){

    // handle delete button click
    $('body').on('click', '.url-delete-btn', function(e) {
      e.preventDefault();
  
      // get the id of the todo task
      var id = $(this).attr('data-ID');
        
      // get csrf token value
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      console.log(csrf_token);
  
      // now make the ajax request
      $.ajax({
        'url': 'urledit/todo/' + id,
        'type': 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrf_token }
      }).done(function() {
        console.log('Todo task deleted: ' + id);
        window.location = window.location.href;
      }).fail(function() {
        alert('something went wrong!');
      });
  
    });
  
  });

  $(function(){
   
    // handle delete button click
    $('body').on('click', '#favorBtn', function(e) {
      e.preventDefault();
  
      // get the id of the todo task
      var sitename = document.getElementById('sitename').innerText;
        console.log(sitename);
      // get csrf token value
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      console.log(csrf_token);
  
      // now make the ajax request
      // $.ajax({
      //   'url': 'edit/todo/' + id,
      //   'type': 'DELETE',
      //   headers: { 'X-CSRF-TOKEN': csrf_token }
      // }).done(function() {
      //   console.log('Todo task deleted: ' + id);
      //   window.location = window.location.href;
      // }).fail(function() {
      //   alert('something went wrong!');
      // });   
    });

  });

