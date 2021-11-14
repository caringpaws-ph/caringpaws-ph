$(document).ready(function(){
    // code to read selected table row cell data (values).
    $("#healthTable").on('click','.btnSelect',function(){
        // get the current row
        var currentRow1=$(this).closest("tr"); 
        var dataTitle1 = currentRow1.find("td:eq(0)").text(); // get current row title
        
        //alert(dataTitle);

        $.ajax({
            method: "POST",
            url: "https://caringpaws-ph.herokuapp.com/healthblog.php",
            data: {dataTitle1 : dataTitle1 },
            dataType: "html",
            cache: true,
            success: function(response) {
            }
        });
    });
});

$(document).ready(function(){
    // code to read selected table row cell data (values).
    $("#behaviorTable").on('click','.btnSelect2',function(){
        // get the current row
        var currentRow2=$(this).closest("tr"); 
        var dataTitle2 = currentRow2.find("td:eq(0)").text(); // get current row title
        
        //alert(dataTitle);
        $.ajax({
            method: "POST",
            url: "https://caringpaws-ph.herokuapp.com/behaviorblog.php",
            data: { dataTitle2 : dataTitle2 },
            dataType: "html",
            cache: true,
            success: function(data) {
            }
        });
    });
});

$(document).ready(function(){
    // code to read selected table row cell data (values).
    $("#nutritionTable").on('click','.btnSelect3',function(){
        // get the current row
        var currentRow3=$(this).closest("tr"); 
        var dataTitle3 = currentRow3.find("td:eq(0)").text(); // get current row title
        
        //alert(dataTitle);
        $.ajax({
            method: "POST",
            url: "https://caringpaws-ph.herokuapp.com/nutritionblog.php",
            data: { dataTitle3 : dataTitle3 },
            dataType: "html",
            cache: true,
            success: function(data) {
            }
        });
    });
});



$(document).ready(function(){
    // code to read selected table row cell data (values).
    $("#careTable").on('click','.btnSelect4',function(){
        // get the current row
        var currentRow4=$(this).closest("tr"); 
        var dataTitle4 = currentRow4.find("td:eq(0)").text(); // get current row title
        
        //alert(dataTitle);
        $.ajax({
            method: "POST",
            url: "https://caringpaws-ph.herokuapp.com/careblog.php",
            data: { dataTitle4 : dataTitle4 },
            dataType: "html",
            cache: true,
            success: function(data) {
            }
        });
    });
});



$(document).ready(function(){
    // code to read selected table row cell data (values).
    $("#breedsTable").on('click','.btnSelect5',function(){
        // get the current row
        var currentRow5=$(this).closest("tr"); 
        var dataTitle5 = currentRow5.find("td:eq(0)").text(); // get current row title
        
        //alert(dataTitle);
        $.ajax({
            method: "POST",
            url: "https://caringpaws-ph.herokuapp.com/breedsblog.php",
            data: { dataTitle5 : dataTitle5 },
            dataType: "html",
            cache: true,
            success: function(data) {
            }
        });
    });
});
