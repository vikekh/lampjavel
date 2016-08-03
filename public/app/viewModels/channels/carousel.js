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

        //app.on('channelContext', function (channelId) {
            //self.nextImage();
        //});

        return self.nextImage();
    };

    viewModel.activeIndex = ko.observable(0);

    viewModel.items = ko.observableArray([]);

    viewModel.next = function () {
        var self = this;

        if (self.activeIndex() === self.items().length - 1) {
            self.nextImage();
        }

        self.activeIndex(self.activeIndex() + 1);
    };

    viewModel.nextImage = function () {
        var self = this;

        return dataService.getNextImage(shell.channelId()).done(function (response) {
            self.items.push(response);
        });
    };

    viewModel.previous = function () {
        if (self.activeIndex() > 0) {
            self.activeIndex(self.activeIndex() - 1);
        }
    };

    return viewModel;
});