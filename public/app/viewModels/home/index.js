define(['durandal/app', 'jquery', 'knockout', 'dataService', 'viewModels/shell'], function (app, $, ko, dataService, shell) {
    return {
        activate: function () {
            shell.header('Welcome!')
        }
    };
});