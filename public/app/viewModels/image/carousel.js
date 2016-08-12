define(function (require) {
    var $ = require('jquery');
    var app = require('durandal/app');
    var dataService = require('dataService');
    var ko = require('knockout');
    var shell = require('viewModels/shell');

    var images;
    var viewModel = {};

    viewModel.activate = function (channelId) {
        var self = this;

        shell.channelId(channelId);
        shell.header('#' + channelId);

        //app.on('channelContext', function (channelId) {
            //self.nextImage();
        //});

        return dataService.getImagesFromChannel(shell.channelId(), { sort: 'random' }).done(function (response) {
            images = response;
            self.url(images[self.activeIndex()].url);
        });
    };

    viewModel.activeIndex = ko.observable(0);

    viewModel.next = function () {debugger;
        var self = this;

        if (self.activeIndex() < images.length - 1) {
            self.activeIndex(self.activeIndex() + 1);
        }

        self.url(images[self.activeIndex()].url);
    };

    viewModel.previous = function () {
        var self = this;

        if (self.activeIndex() > 0) {
            self.activeIndex(self.activeIndex() - 1);
        }

        self.url(images[self.activeIndex()].url);
    };

    viewModel.url = ko.observable();

    return viewModel;
});