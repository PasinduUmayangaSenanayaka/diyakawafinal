<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searchable Dropdown</title>
    <style>
        /* Basic styling for the dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
            width: 200px;
        }
        .dropdown input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .dropdown-list {
            position: absolute;
            background-color: white;
            border: 1px solid #ccc;
            z-index: 1;
            display: none;
            max-height: 150px;
            overflow-y: auto;
        }
        .dropdown-list div {
            padding: 8px;
            cursor: pointer;
        }
        .dropdown-list div:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="dropdown">
    <input type="text" id="searchInput" placeholder="Search..." onkeyup="filterFunction()">
    <div id="dropdownList" class="dropdown-list">
        <div onclick="selectOption('Option 1')">Option 1</div>
        <div onclick="selectOption('Option 2')">Option 2</div>
        <div onclick="selectOption('Option 3')">Option 3</div>
        <div onclick="selectOption('Option 4')">Option 4</div>
        <div onclick="selectOption('Option 5')">Option 5</div>
        <!-- Add more options as needed -->
    </div>
</div>

<script>
    function filterFunction() {
        var input, filter, dropdownList, div, i;
        input = document.getElementById("searchInput");
        filter = input.value.toLowerCase();
        dropdownList = document.getElementById("dropdownList");
        div = dropdownList.getElementsByTagName("div");

        // Show the dropdown if the input is not empty
        dropdownList.style.display = filter ? "block" : "none";

        for (i = 0; i < div.length; i++) {
            if (div[i].innerHTML.toLowerCase().indexOf(filter) > -1) {
                div[i].style.display = "";
            } else {
                div[i].style.display = "none";
            }
        }
    }

    function selectOption(option) {
        document.getElementById("searchInput").value = option; // Set the input value to the selected option
        document.getElementById("dropdownList").style.display = "none"; // Hide the dropdown after selection
    }

    // Hide the dropdown if clicking outside of it
    window.onclick = function(event) {
        if (!event.target.matches('#searchInput')) {
            document.getElementById("dropdownList").style.display = "none";
        }
    }
</script>

</body>
</html>
