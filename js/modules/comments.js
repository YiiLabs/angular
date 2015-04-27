"use strict";

angular.module("comments", [])
.directive("commentsDirective", function(){
    return{
        restrict: 'E',
        replace: true,
        templateUrl: "partials/comments.html"
    };
})

.controller("commentsCtrl", ["$scope", "commentsService", function($scope, commentsService){
    $scope.show = true;
    $scope.showButton = true;

    var start = 0,
        end = start + 2;

    commentsService.getData($scope, start, end);

    $scope.loadMore = function(){
        end += 2;
        commentsService.getData($scope, start, end);
    }
}])

.service("commentsService", ["Restangular", function(rest){
    return{
        getData: function($scope, start, end){
            rest.all("comments").getList({start: start, end: end}).then(function(response){
                if(response.data.length === 0){
                    $scope.show = false;
                }

                $scope.comments = response.data;
            });
        }
    };
}]);