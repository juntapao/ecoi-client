<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#regions').DataTable({
            "order": [[ 0, "desc" ]]
        });
        $('#areas').DataTable({
            "order": [[ 0, "desc" ]]
        });
        $('#branch').DataTable({
            "order": [[ 0, "desc" ]]
        });
        $('#role').DataTable({
            "order": [[ 0, "desc" ]]
        });
        $('#user').DataTable({
            "order": [[ 0, "desc" ]]
        });
        $('#coi_a').DataTable({
            "order": [[ 0, "desc" ]]
        });

        // ===================
        //   Excel generate
        // ===================

        // $('#generate').attr('disabled', true);

        // $("#datefrom").change(function(){
        //     if($('#datefrom').val() > $('#dateto').val()){
        //         $('#dateto').val('');
        //     }
        //     if($('#datefrom').val() && $('#dateto').val()){
        //         $('#generate').removeAttr('disabled');
        //     } 
        //     else $('#generate').attr('disabled', true);
        // });
        // $("#dateto").change(function(){
        //     if($('#datefrom').val() > $('#dateto').val()){
        //         $('#dateto').val('');
        //     }
        //     if($('#datefrom').val() && $('#dateto').val()){
        //         $('#generate').removeAttr('disabled');
        //     } 
        //     else $('#generate').attr('disabled', true);
        // });
        //======================================================================


        // $('#spouse_parents').html('Select Civil Status');
        // $('#child_siblings').html('Select Civil Status');
    
        // $('#post').click(function(){
        //     confirm("Sure want to POST?");
        // });
    
        function validateDays() {
            if (document.getElementById('single').checked == true){
                alert("qwe");
            } else if (document.getElementById('married').checked == true){
                alert("asd");
            }else {
                alert("zxc");
            }
        }
    
        // if ($('#confo').val() === 'Single'){
        //     document.getElementById("single").checked = true;
        //     $('#spouse_parents').html('Parents');
        //     $('#child_siblings').html('Siblings');
        // } else if ($('#confo').val() === 'Married'){
        //     document.getElementById("married").checked = true;
        //     $('#spouse_parents').html('Spouse');
        //     $('#child_siblings').html('Children');
        // }else{
    
        // }

        // $("#dateofbirth").click(function(){
        //     $("#dateofbirth").datepicker({minDate: '-30Y',dateFormat: 'dd/mm/yy', maxDate: '-18Y' });
        // });
        $("#dateofbirths").blur(function(){
            // date.setFullYear( date.getFullYear() - 18 );
            var date = new Date();
            var yearmin = date.getFullYear() - 18 ;
            var yearmax = date.getFullYear() - 70 ;
            var dbirth = new Date($("#dateofbirth").val());
            var yearofbirth = dbirth.getFullYear();
            if ( (yearofbirth < yearmax) || (yearofbirth > yearmin)){
                $("#dateofbirth").val('');
                alert('Invalid input!');
            }
            
        });
        $("#dateofbirth1").blur(function(){
            // date.setFullYear( date.getFullYear() - 18 );
            var date = new Date();
            var yearmin = date.getFullYear() - 18 ;
            var yearmax = date.getFullYear() - 70 ;
            var dbirth = new Date($("#dateofbirth").val());
            var yearofbirth = dbirth.getFullYear();
            if ( (yearofbirth < yearmax) || (yearofbirth > yearmin)){
                $("#dateofbirth").val('');
                alert('Invalid input!');
            }
            
        });
        $("#dateofbirth2").blur(function(){
            // date.setFullYear( date.getFullYear() - 18 );
            var date = new Date();
            var yearmin = date.getFullYear() - 18 ;
            var yearmax = date.getFullYear() - 70 ;
            var dbirth = new Date($("#dateofbirth").val());
            var yearofbirth = dbirth.getFullYear();
            if ( (yearofbirth < yearmax) || (yearofbirth > yearmin)){
                $("#dateofbirth").val('');
                alert('Invalid input!');
            }
            
        });
        $("#dateofbirth3").blur(function(){
            // date.setFullYear( date.getFullYear() - 18 );
            var date = new Date();
            var yearmin = date.getFullYear() - 1 ;
            var yearmax = date.getFullYear() - 21 ;
            var dbirth = new Date($("#dateofbirth").val());
            var yearofbirth = dbirth.getFullYear();
            if ( (yearofbirth < yearmax) || (yearofbirth > yearmin)){
                $("#dateofbirth").val('');
                alert('Invalid input!');
            }
            
        });
        $("#dateofbirth4").blur(function(){
            // date.setFullYear( date.getFullYear() - 18 );
            var date = new Date();
            var yearmin = date.getFullYear() - 1 ;
            var yearmax = date.getFullYear() - 21 ;
            var dbirth = new Date($("#dateofbirth").val());
            var yearofbirth = dbirth.getFullYear();
            if ( (yearofbirth < yearmax) || (yearofbirth > yearmin)){
                $("#dateofbirth").val('');
                alert('Invalid input!');
            }
            
        });
        $("#dateofbirth5").blur(function(){
            // date.setFullYear( date.getFullYear() - 18 );
            var date = new Date();
            var yearmin = date.getFullYear() - 1 ;
            var yearmax = date.getFullYear() - 21 ;
            var dbirth = new Date($("#dateofbirth").val());
            var yearofbirth = dbirth.getFullYear();
            if ( (yearofbirth < yearmax) || (yearofbirth > yearmin)){
                $("#dateofbirth").val('');
                alert('Invalid input!');
            }
            
        });
        $("#dateofbirth6").blur(function(){
            // date.setFullYear( date.getFullYear() - 18 );
            var date = new Date();
            var yearmin = date.getFullYear() - 1 ;
            var yearmax = date.getFullYear() - 21 ;
            var dbirth = new Date($("#dateofbirth").val());
            var yearofbirth = dbirth.getFullYear();
            if ( (yearofbirth < yearmax) || (yearofbirth > yearmin)){
                $("#dateofbirth").val('');
                alert('Invalid input!');
            }
            
        });
    
        $('#single').click(function(){
            $('#spouse_parents').html('Parents');
            $('#child_siblings').prev().html('Siblings');
            // $('#birth_spouse_parents').html('(1 - 21 yrs. old)');
            // $('#birth_child_siblings').html('(18 - 70 yrs. old)');
        });
    
        $('#married').click(function(){
            $('#spouse_parents').html('Spouse');
            $('#child_siblings').prev().html('Children');
            // $('#birth_spouse_parents').html('(1 - 21 yrs. old)');
            // $('#birth_child_siblings').html('(18 - 70 yrs. old)');
            // $("#guardian").prop('required',false);
            // $("#dateofbirth1").prop('required',false);
        });
        
        //=================
        //      Branch
        //=================
        
        //add
        $('#adds').click( function () {
            // $('#add h5').html('Create new Branch');
            $('#commandbranch').val('add_branch');
            $('#add').modal('show');
        });
        $('#addregions').click( function () {
            $('#addregion h5').html('Create new Region');
            $('#commandregion').val('add_region');
            $('#addregion').modal('show');
        });
        $('#addareas').click( function () {
            $('#addarea h5').html('Create new Area');
            $('#commandarea').val('add_area');
            $('#addarea').modal('show');
        });
        //edit
        $('#edit_region').click( function () {
            $('#command_edit_region').val('edit_region');
        });
        $('#edit_area').click( function () {
            $('#command_edit_area').val('edit_area');
        });
        $('#edit_branch').click( function () {
            $('#command_edit_branch').val('edit_branch');
        });
        //delete
        $('#delete_region').click( function () {
            $('#command_delete_region').val('delete_region');
        });
        $('#delete_area').click( function () {
            $('#command_delete_area').val('delete_area');
        });
        $('#delete_branch').click( function () {
            $('#command_delete_branch').val('delete_branch');
        });

        $('#region_branch_name').change(function(){
            var id = $('#region_branch_name').val();
            //$('#area_branch_name').append('<option value="' + region + '">' + region + '</option>');
            $.ajax({
                url: 'branch/getArea/'+id,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    $('#area_branch_name').empty();
                    $('#area_branch_name').append('<option selected>-Select Area-</option>');
                    for(var i=0; i < response.length; i++){
                        $('#area_branch_name').append('<option value="' + response[i].area_name + '">' + response[i].area_name + '</option>');
                        // alert(response);
                    }
                    // alert(response.length);
                }
            });
        });

        //=========================================================
        //              BRANCH EDIT
        //=========================================================
        $('#region_branch_name_edit').change(function(){
            var region = $('#region_branch_name_edit').val();
            // alert(id);
            //$('#area_branch_name').append('<option value="' + region + '">' + region + '</option>');
            $.ajax({
                url: 'getArea_edit/'+region,
                type: 'GET',
                dataType: 'json',
                data: {region:region},
                success: function(response){
                    $('#area_branch_name_edit').empty();
                    $('#area_branch_name_edit').append('<option selected>-Select Area-</option>');
                    for(var i=0; i < response.length; i++){
                        $('#area_branch_name_edit').append('<option value="' + response[i].area_name + '">' + response[i].area_name + '</option>');
                        // alert(response);
                    }
                    // alert(response);
                }
            });
        });
        //===========================================

        $('#tranadd').click( function(){
            var date = new Date();
            var dateIssued = date.getFullYear() + '-' + padLeft(date.getMonth() + 1, '0', 2) + '-' + padLeft(date.getDate(), '0', 2);
            $('#date_issued').val(dateIssued);
        });
    
        (function() {
        'use strict';
        window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
        }
        form.classList.add('was-validated');
        }, false);
        });
        }, false);
        })();


        $('.selectpicker').selectpicker();

    });
    </script>
    
    