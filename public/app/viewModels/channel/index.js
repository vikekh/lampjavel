define(function (require) {
    var dataService = require('dataService');
    var ko = require('knockout');
    var shell = require('viewModels/shell');

    var viewModel = {
        activate: activate,
        channels: ko.observableArray([])
    };

    function Channel(data) {
        this.id = ko.observable(data.id);
        this.imagesCount = ko.observable(data.imagesCount);
        this.isPublic = ko.observable(data.isPublic === 1);
    }

    function activate(channelId) {
        var self = this;

        shell.header('Channels');

        return getChannels();
    }

    function getChannels() {
        viewModel.channels.removeAll();

        dataService.getChannels().done(function (data, textStatus, jqXhr) {
            data.forEach(function (value, index, array) {
                viewModel.channels.push(new Channel(value));
            });
        })
    }

    return viewModel;
});