define(function (require) {
    var $ = require('jquery');
    var app = require('durandal/app');
    var dataService = require('dataService');
    var ko = require('knockout');
    var shell = require('viewModels/shell');

    var viewModel = {};

    viewModel.activate = function (channelId) {
        var self = this;

        shell.channelId(channelId);
        shell.header('#' + channelId);

        app.on('channelContext', function (channelId) {
            self.nextImage();
        });

        return self.nextImage();
    };

    viewModel.imageUrl = ko.observable();

    viewModel.nextImage = function () {
        var self = this;

        return dataService.getNextImage(shell.channelId()).done(function (response) {
            self.imageUrl(response.url);
        });
    };

    return viewModel;
});