document.addEventListener('DOMContentLoaded', function () {

    // Find the "Lookup Country" button by its ID
    var lookupCountryButton = document.getElementById('lookupcntry');

    // Find the "Lookup City" button by its ID
    var lookupCityButton = document.getElementById('lookupcity');

    // Find the input field by its ID
    var countryInput = document.getElementById('country');

    // Attach click event listener to the "Lookup Country" button
    lookupCountryButton.addEventListener('click', function () {
        performLookup('country');
    });

    // Attach click event listener to the "Lookup City" button
    lookupCityButton.addEventListener('click', function () {
        performLookup('city');
    });

    // Attach a keypress event listener to the input field
    countryInput.addEventListener('keypress', function (event) {
        // Check if the pressed key is "Enter"
        if (event.key === 'Enter') {
            // Determine which button was clicked last and perform the lookup accordingly
            if (lastClickedButton === 'country') {
                performLookup('country');
            } else {
                performLookup('city');
            }
        }
    });

    // Variable to track the last clicked button
    var lastClickedButton = 'country';

    // Function to perform the lookup
    function performLookup(lookupType) {
        // Update the last clicked button
        lastClickedButton = lookupType;

        // Get the value entered by the user
        var countryValue = countryInput.value.trim();

        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define the callback function to handle the response
        xhr.onload = function () {
            // Find the result div by its ID
            var resultDiv = document.getElementById('result');
            // Update the result div with the response from the server
            resultDiv.innerHTML = xhr.responseText;
        };

        // Construct the URL with the country and lookup type parameters
        var url = 'world.php?country=' + encodeURIComponent(countryValue) + '&lookup=' + encodeURIComponent(lookupType);

        // Open a GET request to the server
        xhr.open('GET', url, true);

        // Send the request
        xhr.send();
    }

});
