define(function (require) {
    var ko = require('knockout');

    var viewModel = {
        activate: activate,
        url: ko.observable()
    }

    function activate(url) {
        var self = this;

        viewModel.url(url);
    }
});