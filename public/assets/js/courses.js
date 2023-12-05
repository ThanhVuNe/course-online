// Function to handle the event of changing the sort value
function handleSortChange() {
    var selectedSort = document.getElementById("sort-select").value;
    
    // Get the current URL
    var currentURL = window.location.href;

    // Check if the URL has a "sort" parameter
    if (currentURL.indexOf('?') === -1) {
        // If the URL has no parameters, add the "sort" parameter to the URL
        window.location.href = currentURL + '?sort=' + selectedSort;
    } else {
        // If the URL already has parameters
        if (currentURL.includes('sort=')) {
            // Replace the old sort value with the new value
            var newURL = currentURL.replace(/sort=[^&]+/, 'sort=' + selectedSort);
            window.location.href = newURL;
        } else {
            window.location.href = currentURL + '&sort=' + selectedSort;
        }
    }
}
