function selectedPet(){
	
    var x = document.getElementById("PN").value;
    //alert(x);

    $.ajax({
        url:"https://caringpaws-ph.herokuapp.com/patient/showSelected.php",
        method: "POST",
        dataType: "html",
        data:{ x : x },
        success:function(data){
            $("#disdetails").html(data);
        }
    })
}

