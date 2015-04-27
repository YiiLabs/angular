"use strict";

angular.module("topContent", [])
.directive("topContentDirective", function(){
    return {
        restrict: 'E',
        templateUrl: "partials/content.html",
        replace: true
    };
})

.controller("topContentCtrl", ["$scope", "topContentService", function($scope, topContentService){
    topContentService.getData($scope);

    $scope.zoomImage = function(){
        $('.images').click(function(){
            var imgSrc = $(this).find('.image-inn img').attr("src");

            $('.big-image img').attr({src: imgSrc});
            $('.big-image').fadeIn('slow');
        });

        $('.big-image').click(function(){
            $(this).fadeOut();
        });
    }
}])

.service("topContentService", ["$http", function($http){
    return{
        getData: function($scope){
            $http.get("data/main.json").success(function(data){
                $scope.data = data[0];
            });
        }
    };
}]);