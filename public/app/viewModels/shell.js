define(['plugins/router', 'durandal/app', 'knockout'], function (router, app, ko) {
    return {
        channelId: ko.observable('lampjavel'),

        router: router,

        activate: function () {
            router.map([
                {
                    route: ':channelId',
                    title: 'Home',
                    moduleId: 'viewModels/home',
                    nav: true,
                    hash: 'index'
                }
            ]).buildNavigationModel();
            
            return router.activate('#index/' + this.channelId());
        }
    };
});