
    // code to read selected table row cell data (values).
    $("#healthTable").on('click','.btnSelect',function(){
        // get the current row
        var currentRow1 = $(this).closest("tr"); 
        var dataTitle1 = currentRow1.find("td:eq(0)").text(); // get current row title
        
        $.ajax({
            url: "https://caringpaws-ph.herokuapp.com/healthblog.php",
            method: "POST",
            dataType: "html",
            data: {dataTitle1 : dataTitle1 },
            success: function(data) {
            }
        })
    });


    // code to read selected table row cell data (values).
    $("#behaviorTable").on('click','.btnSelect2',function(){
        // get the current row
        var currentRow2 = $(this).closest("tr"); 
        var dataTitle2 = currentRow2.find("td:eq(0)").text(); // get current row title
        
        $.ajax({
            url: "https://caringpaws-ph.herokuapp.com/behaviorblog.php",
            method: "POST",
            dataType: "html",
            data: { dataTitle2 : dataTitle2 },
            success: function(data) {
            }
        })
        
    });



    // code to read selected table row cell data (values).
    $("#nutritionTable").on('click','.btnSelect3',function(){
        // get the current row
        var currentRow3 = $(this).closest("tr"); 
        var dataTitle3 = currentRow3.find("td:eq(0)").text(); // get current row title

        $.ajax({
            url: "https://caringpaws-ph.herokuapp.com/nutritionblog.php",
            method: "POST",
            dataType: "html",
            data: { dataTitle3 : dataTitle3 },
            success: function(data) {
            }
        })
    });




    // code to read selected table row cell data (values).
    $("#careTable").on('click','.btnSelect4',function(){
        // get the current row
        var currentRow4 = $(this).closest("tr"); 
        var dataTitle4 = currentRow4.find("td:eq(0)").text(); // get current row title

        $.ajax({
            url: "https://caringpaws-ph.herokuapp.com/careblog.php",
            method: "POST",
            dataType: "html",
            data: { dataTitle4 : dataTitle4 },
            success: function(data) {
            }
        })
    });




    // code to read selected table row cell data (values).
    $("#breedsTable").on('click','.btnSelect5',function(){
        // get the current row
        var currentRow5=$(this).closest("tr"); 
        var dataTitle5 = currentRow5.find("td:eq(0)").text(); // get current row title

        $.ajax({
            url: "https://caringpaws-ph.herokuapp.com/breedsblog.php",
            method: "POST",
            dataType: "html",
            data: { dataTitle5 : dataTitle5 },
            cache: true,
            success: function(data) {
            }
        })
    });

