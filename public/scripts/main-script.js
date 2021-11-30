$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip()

    $('#category-select').change(function() {
        const url = new URL(window.location)
        url.searchParams.set('categoryId', this.value)
        window.location = url
    })

    $('#create-category-btn').click(function() {
        const categoryName = prompt("How should the category be called?");
        if (categoryName.length > 0) {
            $.post('./api/add-category.php',
                {'name': categoryName}, function(data) {
                    window.location.reload();
                }
            );
        }
    });

    $('#create-team-btn').click(function() {
        const teamName = prompt("How should the team be called?");
        const homecity = prompt("What city is the teams origin?");
        if (teamName.length > 0) {
            $.post('./api/add-team.php',
                {'name': teamName, 'homecity': homecity}, function(data) {
                    window.location.reload();
                }
            );
        }
    });

    $('#create-location-btn').click(function() {
        const locationName = prompt("How should the location be called?");
        if (locationName.length > 0) {
            $.post('./api/add-location.php',
                {'name': locationName}, function(data) {
                    window.location.reload();
                }
            );
        }
    });
})