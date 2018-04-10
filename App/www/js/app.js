angular.module("remedios_naturais", ["ngCordova","ionic","ionMdInput","ionic-material","ion-datetime-picker","ionic.rating","utf8-base64","angular-md5","chart.js","remedios_naturais.controllers", "remedios_naturais.services"])
	.run(function($ionicPlatform,$window,$interval,$timeout,$ionicHistory,$ionicPopup,$state,$rootScope){

		$rootScope.appName = "RemediosNaturais" ;
		$rootScope.appLogo = "data/images/header/logoremedios.png" ;
		$rootScope.appVersion = "1.0" ;

		$ionicPlatform.ready(function() {
			//required: cordova plugin add ionic-plugin-keyboard --save
			if(window.cordova && window.cordova.plugins.Keyboard) {
				cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
				cordova.plugins.Keyboard.disableScroll(true);
			}

			//required: cordova plugin add cordova-plugin-statusbar --save
			if(window.StatusBar) {
				StatusBar.styleDefault();
			}

			localforage.config({
				driver : [localforage.WEBSQL,localforage.INDEXEDDB,localforage.LOCALSTORAGE],
				name : "remedios_naturais",
				storeName : "remedios_naturais",
				description : "The offline datastore for Remedios Naturais app"
			});



		});
	})


	.filter("to_trusted", ["$sce", function($sce){
		return function(text) {
			return $sce.trustAsHtml(text);
		};
	}])

	.filter("trustUrl", function($sce) {
		return function(url) {
			return $sce.trustAsResourceUrl(url);
		};
	})

	.filter("trustJs", ["$sce", function($sce){
		return function(text) {
			return $sce.trustAsJs(text);
		};
	}])

	.filter("strExplode", function() {
		return function($string,$delimiter) {
			if(!$string.length ) return;
			var $_delimiter = $delimiter || "|";
			return $string.split($_delimiter);
		};
	})

	.filter("strDate", function(){
		return function (input) {
			return new Date(input);
		}
	})
	.filter("strHTML", ["$sce", function($sce){
		return function(text) {
			return $sce.trustAsHtml(text);
		};
	}])
	.filter("strEscape",function(){
		return window.encodeURIComponent;
	})
	.filter("strUnscape", ["$sce", function($sce) {
		var div = document.createElement("div");
		return function(text) {
			div.innerHTML = text;
			return $sce.trustAsHtml(div.textContent);
		};
	}])

	.filter("objLabel", function(){
		return function (obj) {
			var new_item = [];
			angular.forEach(obj, function(child) {
				new_item = [];
				var indeks = 0;
				angular.forEach(child, function(v,l) {
					if (indeks !== 0) {
					new_item.push(l);
				}
				indeks++;
				});
			});
			return new_item;
		}
	})
	.filter("objArray", function(){
		return function (obj) {
			var new_items = [];
			angular.forEach(obj, function(child) {
				var new_item = [];
				var indeks = 0;
				angular.forEach(child, function(v){
						if (indeks !== 0){
							new_item.push(v);
						}
						indeks++;
					});
					new_items.push(new_item);
				});
			return new_items;
		}
	})




.config(function($stateProvider, $urlRouterProvider,$sceDelegateProvider,$httpProvider,$ionicConfigProvider){
	try{
		// Domain Whitelist
		$sceDelegateProvider.resourceUrlWhitelist([
			"self",
			new RegExp('^(http[s]?):\/\/(w{3}.)?youtube\.com/.+$'),
			new RegExp('^(http[s]?):\/\/(w{3}.)?w3schools\.com/.+$'),
		]);
	}catch(err){
		console.log("%cerror: %cdomain whitelist","color:blue;font-size:16px;","color:red;font-size:16px;");
	}
	$stateProvider
	.state("remedios_naturais",{
		url: "/remedios_naturais",
			abstract: true,
			templateUrl: "templates/remedios_naturais-side_menus.html",
			controller: "side_menusCtrl",
	})

	.state("remedios_naturais.about_us", {
		url: "/about_us",
		views: {
			"remedios_naturais-side_menus" : {
						templateUrl:"templates/remedios_naturais-about_us.html",
						controller: "about_usCtrl"
					},
			"fabButtonUp" : {
						template: '',
					},
		}
	})

	.state("remedios_naturais.categorias", {
		url: "/categorias",
		cache:false,
		views: {
			"remedios_naturais-side_menus" : {
						templateUrl:"templates/remedios_naturais-categorias.html",
						controller: "categoriasCtrl"
					},
			"fabButtonUp" : {
						template: '',
					},
		}
	})

	.state("remedios_naturais.dashboard", {
		url: "/dashboard",
		views: {
			"remedios_naturais-side_menus" : {
						templateUrl:"templates/remedios_naturais-dashboard.html",
						controller: "dashboardCtrl"
					},
			"fabButtonUp" : {
						template: '',
					},
		}
	})

	.state("remedios_naturais.encontrar", {
		url: "/encontrar/:categorias",
		cache:false,
		views: {
			"remedios_naturais-side_menus" : {
						templateUrl:"templates/remedios_naturais-encontrar.html",
						controller: "encontrarCtrl"
					},
			"fabButtonUp" : {
						template: '',
					},
		}
	})

	.state("remedios_naturais.remedios_bookmark", {
		url: "/remedios_bookmark",
		cache:false,
		views: {
			"remedios_naturais-side_menus" : {
						templateUrl:"templates/remedios_naturais-remedios_bookmark.html",
						controller: "remedios_bookmarkCtrl"
					},
			"fabButtonUp" : {
						template: '',
					},
		}
	})

	.state("remedios_naturais.remedios_singles", {
		url: "/remedios_singles/:id",
		cache:false,
		views: {
			"remedios_naturais-side_menus" : {
						templateUrl:"templates/remedios_naturais-remedios_singles.html",
						controller: "remedios_singlesCtrl"
					},
			"fabButtonUp" : {
						template: '',
					},
		}
	})

	.state("remedios_naturais.slide_tab_menu", {
		url: "/slide_tab_menu",
		views: {
			"remedios_naturais-side_menus" : {
						templateUrl:"templates/remedios_naturais-slide_tab_menu.html",
						controller: "slide_tab_menuCtrl"
					},
			"fabButtonUp" : {
						template: '',
					},
		}
	})

	$urlRouterProvider.otherwise("/remedios_naturais/dashboard");
});
