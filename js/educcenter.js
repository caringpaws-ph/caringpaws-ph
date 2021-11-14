const items = document.querySelectorAll(".accordion button");

function toggleAccordion() {
  const itemToggle = this.getAttribute('aria-expanded');
  
  for (i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
  }
  
  if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
  }
}

items.forEach(item => item.addEventListener('click', toggleAccordion));

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

$(document).ready(function(){var delay = 5000;
    // code to read selected table row cell data (values).
    $("#healthTable").on('click','.btnSelect',function(){
        // get the current row
        var currentRow1=$(this).closest("tr"); 
        var dataTitle1 = currentRow1.find("td:eq(0)").text(); // get current row title
        
        //alert(dataTitle);

        $.ajax({
            type: "POST",
            url: "https://caringpaws-ph.herokuapp.com/healthblog.php",
            data: {dataTitle1 : dataTitle1 },
            cache: true,
            success: function(response) {
                setTimeout(continueExecution, 10000);
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
            type: "POST",
            url: "https://caringpaws-ph.herokuapp.com/behaviorblog.php",
            data: { dataTitle2 : dataTitle2 },
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
            type: "POST",
            url: "https://caringpaws-ph.herokuapp.com/nutritionblog.php",
            data: { dataTitle3 : dataTitle3 },
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
            type: "POST",
            url: "https://caringpaws-ph.herokuapp.com/careblog.php",
            data: { dataTitle4 : dataTitle4 },
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
            type: "POST",
            url: "https://caringpaws-ph.herokuapp.com/breedsblog.php",
            data: { dataTitle5 : dataTitle5 },
            cache: true,
            success: function(data) {
            }
        });
    });
});
