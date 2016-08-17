define(function (require) {
    var shell = require('viewModels/shell');

    return {
        activate: function () {
            shell.header('Welcome!')
        }
    };
});