define(function (require) {
    var shell = require('viewModels/shell');

    var viewModel = {
        activate: activate
    };

    function activate() {
        shell.header('Welcome!');
    }

    return viewModel;
});