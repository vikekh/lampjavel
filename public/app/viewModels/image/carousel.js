define(function (require) {
    var app = require('durandal/app');
    var dataService = require('dataService');
    var ko = require('knockout');
    var shell = require('viewModels/shell');

    var viewModel = {
        activate: activate,
        images: ko.observableArray([]),
        index: ko.observable(0),
        next: next,
        previous: previous
    };

    function Image(data) {
        var self = this;

        self.id = data.id;
        self.url = data.url;
    }

    function activate(channelId) {
        shell.channelId(channelId);
        shell.header('#' + channelId);

        app.on('channelChange', function (channelId) {
            getImages();
        });

        return getImages();
    }

    function getImages() {
        viewModel.images.removeAll();

        return dataService.getImagesFromChannel(
            shell.channelId(),
            { sort: 'random' }
        ).done(function (data) {
            data.forEach(function (value, index, array) {
                viewModel.images.push(new Image(value));
            });
        }).fail(function () {});
    }

    function next() {
        stepIndex(1);
    }

    function previous() {
        stepIndex(-1);
    }

    function stepIndex(value) {
        var index = viewModel.index() + value;

        if (index >= 0 && index < viewModel.images().length) {
            viewModel.index(index);
        }
    }

    return viewModel;
});