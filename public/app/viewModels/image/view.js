define(function (require) {
    var ko = require('knockout');

    var viewModel = {};

    viewModel.activate = function (url) {
        var self = this;

        self.url(url);
    };

    viewModel.url = ko.observable();

    return viewModel;
});