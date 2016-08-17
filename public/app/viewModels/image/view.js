define(function (require) {
    var ko = require('knockout');

    return {
        activate: function (url) {
            var self = this;

            self.url(url);
        },

        url: ko.observable()
    };
});