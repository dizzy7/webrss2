$(function () {
    $(".unsibscribe-link").on('click', function () {
        var link = this;
        if (prevent) {
            bootbox.confirm('Удалить?', function (result) {
                if (result) {
                    window.location.href = link.href;
                }
            });
        }
    });

});