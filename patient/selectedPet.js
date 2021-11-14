function selectedPet(){
	
    var x = document.getElementById("PN").value;
    //alert(x);

    $.ajax({
        url:"https://caringpaws-ph.herokuapp.com/caringpaws/patient/showSelected.php",
        method: "POST",
        data:{ x : x },
        success:function(data){
            $("#disdetails").html(data);
        }
    })
}

