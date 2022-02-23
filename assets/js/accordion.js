$( function() {
    let icons = {
    header: "ui-icon-circle-plus",
    activeHeader: 'ui-icon-circle-minus'
    };
    $( "#event_box" ).accordion({
    icons: icons,
    collapsible: true
    });
} );