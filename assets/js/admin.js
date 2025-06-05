jQuery(document).ready(function($) {
    // Show/hide priority field based on featured checkbox
    $('#cps_featured').on('change', function() {
        if ($(this).is(':checked')) {
            $('#cps_priority').closest('.cps-meta-field').show();
        } else {
            $('#cps_priority').closest('.cps-meta-field').hide();
        }
    }).trigger('change');
    
    // Make featured column sortable
    $('.wp-list-table .column-featured').on('click', function() {
        var order = $(this).hasClass('sorted-asc') ? 'desc' : 'asc';
        window.location.href = window.location.href.replace(
            /&order=.*?(&|$)/i, 
            ''
        ) + '&orderby=featured&order=' + order;
    });
});