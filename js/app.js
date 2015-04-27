"use strict";

var app = angular.module("app", ["ngRoute", "topContent", "comments", "restangular"])
    .config(["RestangularProvider", function(rest){
        rest.setBaseUrl("http://localhost/test/api/v1/");
        rest.setFullResponse(true);
    }]);