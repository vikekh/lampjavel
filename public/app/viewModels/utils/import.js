define(function (require) {
    var $ = require('jquery');
    var app = require('durandal/app');
    var dataService = require('dataService');
    var ko = require('knockout');
    var shell = require('viewModels/shell');

    var data;

    var viewModel = {
        activate: activate,
        inputChangeHandler: inputChangeHandler
    };

    function activate(channelId) {
        var self = this;

        shell.channelId(channelId);
        shell.header('Import');
    }

    function addFile(file) {
        var reader = new FileReader();

        reader.readAsText(file);

        reader.onload = function () {
            var images = parse(reader.result);

            data = images;
            doImport();
        }
    }

    function addFiles(files) {
        for (var i = 0; i < files.length; i++) {
            addFile(files[i]);
        }
    }

    function doImport() {
        for (var i = 0; i < data.length; i++) {
            dataService.createImage({ url: data[i] }).done(function (data) {
                dataService.addImageToChannel(shell.channelId(), data.id);
            });
        }
    }

    function inputChangeHandler(item, event) {
        addFiles(event.currentTarget.files);
    }

    function parse(content) {
        return content.trim().split(/\s*[\r\n]+\s*/g);
    }

    return viewModel;
});