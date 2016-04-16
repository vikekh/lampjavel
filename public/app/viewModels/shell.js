define(['plugins/router', 'durandal/app', 'knockout'], function (router, app, ko) {
    return {
        channelId: ko.observable('lampjavel'),

        router: router,

        activate: function () {
            router.map([
                {
                    route: '',
                    title: 'Home',
                    moduleId: 'viewModels/home',
                    nav: true
                }
            ]).buildNavigationModel();
            
            return router.activate();
        }
    };
});