<script src="{{asset('template')}}/plugins/jquery/jquery.min.js"></script>
<script src="{{asset('template')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
  </body>
</html>


<script type="text/javascript">
$(document).ready(function() {
  
  $.ajax({
  url: "{{url('api/users')}}",
  type: 'GET',
  success: function(response) {
      var users = response.users;
      var userList = $('#user-list');
      var no = 1;
      console.log(response)
      // loop through products data and append to table body
      $.each(users, function(index, user) {
          var tr = '<tr>' +
                       '<td>' + no++ + '</td>' +
                       '<td>' + user.name + '</td>' +
                       '<td>' + user.email + '</td>' +
                       '<td class="text-center">' +
                            '<button class="btn btn-success btn-sm btn-edit" data-id="' + user.id + '">Edit</button>' +
                            '<button id="btn-hapus" class=" btn btn-danger btn-sm ml-2 delete-btn" data-id="' + user.id + '">Delete</button>' +
                        '</td>' +
                    '</tr>';
          userList.append(tr);
        });
      }
    })
  });

</script>
