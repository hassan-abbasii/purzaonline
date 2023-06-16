// Get the input field and table
var input = document.getElementById("myInput");
var table = document.getElementById("myTable");

// Get all the rows in the table body
var rows = table.getElementsByTagName("tr");

// Attach an event listener to the input field
input.addEventListener("keyup", function() {
    // Get the user input and convert to lowercase
    var filter = input.value.toLowerCase();

    // Loop through all the rows in the table body
    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];

        // Get the columns in the row
        var columns = row.getElementsByTagName("td");

        // Assume the row should be displayed
        var display = true;

        // Loop through the columns in the row
        for (var j = 0; j < columns.length; j++) {
            var column = columns[j];

            // If the column contains the filter, display the row
            if (column.innerHTML.toLowerCase().indexOf(filter) > -1) {
                display = true;
                break;
            }

            // Otherwise, hide the row
            display = false;
        }

        // Show or hide the row based on the display variable
        if (display) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    }
});
