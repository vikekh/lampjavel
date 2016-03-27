define(['plugins/router', 'durandal/app'], function (router, app) {
    return {
        router: router,
        activate: function () {
            router.map([
                {
                    route: '',
                    title: 'Lampja:vel',
                    moduleId: 'viewModels/home',
                    nav: true
                }
            ]).buildNavigationModel();
            
            return router.activate();
        }
    };
});