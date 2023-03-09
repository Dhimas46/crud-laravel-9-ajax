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
  numeral.register('locale', 'id', {
      delimiters: {
          thousands: '.',
          decimal: ','
      },
      abbreviations: {
          thousand: 'ribu',
          million: 'juta',
          billion: 'miliar',
          trillion: 'triliun'
      },
      currency: {
          symbol: 'Rp'
      }
  });
  </script>
    <script type="text/javascript">
    $(document).ready(function() {
    $('#add-product-form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "{{url('api/product')}}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              if (response.success) {
                           Swal.fire({
                               icon: 'success',
                               type: 'success',
                               title: 'Success!',
                               text: 'Tambah Data Product Berhasil'
                           })
                               .then (function() {
                                 $('#addModal').modal('hide');
                                  location.reload();
                               });

                       } else {
                           console.log(response.success);
                           Swal.fire({
                               type: 'error',
                               title: 'Error!',
                               text: 'silahkan coba lagi!'
                           });
                       }
                       console.log(response);
                   },
            error: function(response) {
                alert(response.responseJSON.message);
            }
        });
    });
});

//GetData
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
      numeral.locale('id');
      $.ajax({
      url: "{{url('api/product')}}",
      type: 'GET',
      success: function(response) {
          var products = response.products;
          var productList = $('#product-list');
          var no = 1;
          // loop through products data and append to table body
          $.each(products, function(index, product) {
              var tr = '<tr>' +
                           '<td>' + no++ + '</td>' +
                           '<td>' + product.name + '</td>' +
                           '<td>' + product.quantity + '</td>' +
                           '<td>' + numeral(product.harga).format('$ 0,0.00') + '</td>' +
                           '<td class="text-center">' +
                                '<button class="btn btn-success btn-sm btn-edit" data-id="' + product.id + '">Edit</button>' +
                                '<button id="btn-hapus" class=" btn btn-danger btn-sm ml-2 delete-btn" data-id="' + product.id + '">Delete</button>' +
                                '<button class=" btn btn-primary btn-sm ml-2 details-btn" data-id="' + product.id + '">Details</button>' +
                            '</td>' +
                        '</tr>';
              productList.append(tr);
          });
      }
  });
//get data edit
  $(document).on("click", ".btn-edit", function () {
    var productId = $(this).data('id');
    $.ajax({
        url: "api/product/edit/" + productId,
        type: "GET",
        dataType: "json",
        success: function(response) {
            // set nilai pada modal
            $("#updateModal #up_id").val(response.id);
            $("#updateModal #up_name").val(response.name);
            $("#updateModal #up_quantity").val(response.quantity);
            $("#updateModal #up_harga").val(response.harga);
            // tampilkan modal
            $("#updateModal").modal("show");
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
});

//proses update data
$('#update-product').on('submit', function(e) {
  e.preventDefault();
    var id = $('#up_id').val();
    let name = $('#up_name').val();
    let quantity = $('#up_quantity').val();
    let harga = $('#up_harga').val();

    var data = {
      id: id,
      name: name,
      quantity: quantity,
      harga: harga
    };
    $.ajax({
        url: "{{url('api/product/update')}}/" +id,
        type: 'POST',
        data: data,
        success: function(response) {
          if (response.success) {
                       $('.table').load(location.href+'  .table');
                       Swal.fire({
                           icon: 'success',
                           type: 'success',
                           title: 'Success!',
                           text: 'Update Data Product Berhasil!'
                       })
                           .then (function() {
                             $('#loading').show();
                             $('#updateModal').modal('hide');
                              location.reload();
                           });

                   } else {
                       console.log(response.success);
                       Swal.fire({
                           type: 'error',
                           title: 'Error!',
                           text: 'silahkan coba lagi!'
                       });
                   }
                   console.log(response);
               },
        error: function(response) {
            alert(response.responseJSON.message);
        }
    });
});

//details
     $(document).on('click', '.details-btn', function() {
       var id = $(this).attr('data-id');

       $.ajax({
             url: 'api/product/' + id,
             type: 'GET',
             success: function(response) {
               $("#detailsModal #name").val(response.name);
               $("#detailsModal #quantity").val(response.quantity);
               $("#detailsModal #harga").val(response.harga);
              $("#detailsModal").modal("show");
                  },
             error: function(xhr, status, error) {
                 console.log(xhr.responseText);
                 // Lakukan tindakan lain jika terjadi kesalahan saat menghapus data
             }
         });
    });


$(document).on('click', '.delete-btn', function() {
    var id = $(this).attr('data-id');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      confirmButtonColor: '#00a65a',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
      showCancelButton: true,
    }).then((result) =>{
      if (result.isConfirmed) {

          $.ajax({
                url: 'api/product/' + id,
                type: 'DELETE',
                processData: false,
                success: function(response) {
                  if (response.success) {
                               $('.table').load(location.href+'  .table');
                               Swal.fire({
                                   icon: 'success',
                                   type: 'success',
                                   title: 'Success!',
                                   text: 'Delete Data Product Berhasil'
                               })
                                   .then (function() {
                                       window.location.href = "{{url('products')}}";
                                   });

                           } else {
                               console.log(response.success);
                               Swal.fire({
                                   type: 'error',
                                   title: 'Error!',
                                   text: 'silahkan coba lagi!'
                               });
                           }
                           console.log(response);
                       },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // Lakukan tindakan lain jika terjadi kesalahan saat menghapus data
                }
            });
          }
        })
      });
    });
    </script>
