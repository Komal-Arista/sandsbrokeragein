
jQuery(document).ready(function($) {
    $('#search').on('keyup', function() {
        var searchQuery = $(this).val();
        if (searchQuery == "") {
            $("#search-results").html("");
         } else {
            if( searchQuery.length > 2) {
                $('#search-results').show();
                $.ajax({
                    url: ajax_search_params.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'search_sandsbrokerage',
                        search: searchQuery
                    },
                    success: function(response) {
                        $('#search-results').html(response);
                    }
                });
            }
         }
    });

    // Handle the "clear" button click
    const searchInput = document.querySelector('input[type="search"]');
    searchInput.addEventListener('search', function(event) { 
        $('#search-results').hide();
     });
});
