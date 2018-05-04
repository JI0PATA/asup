$(document).ready(function() {

    $('#button__download_excel').on('click', _ => {
        $.ajax({
            url: '/downloadTableExcel?'+location.search.substr(1),
            success: _ => {
                $('#link__download_excel')[0].click();
            }
        });
    });
});