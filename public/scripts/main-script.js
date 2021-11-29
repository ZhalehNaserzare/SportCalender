$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip()

    $('#category-select').change(function() {
        const url = new URL(window.location)
        url.searchParams.set('categoryId', this.value)
        window.location = url
    })
})