$('.itemName').select2({
    placeholder: 'Select an User Buy or Sell',
    ajax: {
        url: 'selectSearchU',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});
$('.itemMediator').select2({
    placeholder: 'Select an Mediator',
    ajax: {
        url: 'selectSearchM',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});