(function(){
    var app = angular.module('shop', []);
    app.controller('shopController', function(){
        this.items = product;
    });
    
    var product = [
        {name: 'Coca Cola',
        price: 25,
        description: 'World Famous Soft Drinks.',
        isSold: true},{name: 'Coca Cola',
        price: 43,
        description: 'World Famous Soft Drinks.',
        isSold: true},{name: 'Coca Cola',
        price: 54,
        description: 'World Famous Soft Drinks.',
        isSold: true}
    ]
})();
