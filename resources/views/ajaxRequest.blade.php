<!doctype html>
<html>
    <head>
            <title>Laravel 5.8 Ajax Request example</title>

            <meta charset="utf-8">
        
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
            <meta name="viewport" content="width=device-width, initial-scale=1">
        
            <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        
            <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        
            <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
   <body>
     <input type='text' id='search' name='search' placeholder='Enter userid 1-27'><input type='button' value='Search' id='but_search'>
     <br/>
     <input type='button' value='Fetch all records' id='but_fetchall'>
     
     <table border='1' id='userTable' style='border-collapse: collapse;'>
       <thead>
        <tr>
          <th>id.no</th>
          <th>Username</th>
          <th>Name</th>
        </tr>
       </thead>
       <tbody></tbody>
     </table>

     <!-- Script -->
     <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --> <!-- jQuery CDN -->
     {{-- <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script> --}}
     {{-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}

     <script type='text/javascript'>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
     
     $(document).ready(function(){

       // Fetch all records
       $('#but_fetchall').click(function(){
	 fetchRecords(0);
       });

       // Search by userid
       $('#but_search').click(function(){
          var userid = Number($('#search').val().trim());
				
	  if(userid > 0){
	    fetchRecords(userid);
	  }

       });

     });

     function fetchRecords(id){
       $.ajax({
         url: 'ajaxRequestPost/'+id,
         type: 'GET',
         success: function(response){

         alert(response);
         
        //    var len = 0;
        //    $('#userTable tbody').empty(); // Empty <tbody>
        //    if(response['data'] != null){
        //      len = response['data'].length;
        //    }

        //    if(len > 0){
        //      for(var i=0; i<len; i++){
        //        var id = response['data'][i].id;
        //        var username = response['data'][i].username;
        //        var name = response['data'][i].name;
        //        var email = response['data'][i].email;

        //        var tr_str = "<tr>" +
        //            "<td align='center'>" + (i+1) + "</td>" +
        //            "<td align='center'>" + username + "</td>" +
        //            "<td align='center'>" + full_name + "</td>" +
        //        "</tr>";

        //        $("#userTable tbody").append(tr_str);
        //      }
        //    }else if(response['data'] != null){
        //       var tr_str = "<tr>" +
        //           "<td align='center'>1</td>" +
        //           "<td align='center'>" + response['data'].username + "</td>" + 
        //           "<td align='center'>" + response['data'].full_name + "</td>" +
        //       "</tr>";

        //       $("#userTable tbody").append(tr_str);
        //    }else{
        //       var tr_str = "<tr>" +
        //           "<td align='center' colspan='4'>No record found.</td>" +
        //       "</tr>";

        //       $("#userTable tbody").append(tr_str);
        //    }

         }
       });
     }
     </script>
  </body>
</html>