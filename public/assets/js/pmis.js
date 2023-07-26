$(function() {

    // setup ajax for laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#state").on('change', function(){

        // var selectedState = $(this).children("option:selected").val();
        var sid = $(this).val();
        $("#lga_id").empty();
        if (sid!=0) {
            $.get('/state/'+sid+'/lgas', function(data){
                var length =0;
                if(data!=null) length = data.length
                for(var i=0;i<length;i++){
                    var id = data[i].id;
                    var name = data[i].name;
                    var option = "<option value='"+id+"'>"+name+"</option>";
                     $("#lga_id").append(option);
                }
            }).fail(function(data){
                alert("error: "+data)
            });
        }
    });

    $("#faculty").on('change', function(){

        var fid = $(this).val();
        $("#department_id").empty();
        if(fid!=0){
            $.get('/faculty/'+fid+'/departments', function(data){

                var length =0;
                if(data!=null) length = data.length
                for(var i=0;i<length;i++){
                    var id = data[i].id;
                    var name = data[i].name;
                    var option = "<option value='"+id+"'>"+name+"</option>";

                     $("#department_id").append(option);
                }
            }).fail(function(data){
                alert("error: "+data)
            });
        }
    });

    $('#saveBtn----').on('click', function(e){
        e.preventDefault();

        $(this).html('Saving..');

        $.ajax({
          data: $('#nokForm').serialize(),
          url: "{{ route('ajaxposts.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

            //   $('#postForm').trigger("reset");
            //   $('#ajaxModelexa').modal('hide');
            //   table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#savedata').html('Save Changes');
          }
      });

    });

});
