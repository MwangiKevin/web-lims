angular.module('bootcards').run(['$templateCache', function($templateCache) {
  'use strict';

  $templateCache.put('bootcards-card/bootcards-card.tmpl.html',
    "<div class=\"panel panel-default\">\n" +
    "\t<div class=\"panel-heading clearfix\">\n" +
    "\t\t<h3 class=\"panel-title pull-left\" ng-bind=\"title\"></h3>\n" +
    "\t\t<!--a class=\"btn btn-default pull-right\" href=\"#\">\n" +
    "\t\t\t<i class=\"fa fa-check\"></i>\n" +
    "\t\t\tButton\n" +
    "\t\t</a-->\n" +
    "\t</div>\n" +
    "\t<div class=\"panel-body\" ng-transclude>\n" +
    "\n" +
    "\t</div>\n" +
    "\t<div class=\"panel-footer\">\n" +
    "\t\t<small>Footer</small>\n" +
    "\t</div>\n" +
    "</div>"
  );


  $templateCache.put('bootcards-chart/bootcards-chart.tmpl.html',
    "<div class=\"panel panel-default bootcards-chart\">\n" +
    "\t<div class=\"panel-heading\">\n" +
    "\t\t<h3 class=\"panel-title\">Chart Card Heading</h3>\n" +
    "\t</div>\n" +
    "\t<div class=\"bootcards-chart-canvas\"></div>\n" +
    "\t<div class=\"panel-footer\">\n" +
    "\t\t<small>Built with Bootcards - Chart Card</small>\n" +
    "\t</div>\n" +
    "</div>\n"
  );


  $templateCache.put('bootcards-file/bootcards-file.tmpl.html',
    "<div class=\"panel panel-default bootcards-file\">\n" +
    "\t<div class=\"panel-heading\">\n" +
    "\t\t<h3 class=\"panel-title\">File Card Heading</h3>\n" +
    "\t</div>\n" +
    "\t<div class=\"list-group\">\n" +
    "\t\t<div class=\"list-group-item\">\n" +
    "\t\t\t<a href=\"#\">\n" +
    "\t\t\t\t<i class=\"icon-file-pdf\"></i>\n" +
    "\t\t\t</a>\n" +
    "\t\t\t<h4 class=\"list-group-item-heading\">\n" +
    "\t\t\t\t<a href=\"#\">\n" +
    "\t\t\t\t\tFile Name Goes Here\n" +
    "\t\t\t\t</a>\n" +
    "\t\t\t</h4>\n" +
    "\t\t\t<p class=\"list-group-item-text\"><strong>PDF</strong></p>\n" +
    "\t\t\t<p class=\"list-group-item-text\"><strong>3.2Mb</strong></p>\n" +
    "\t\t</div>\n" +
    "\t\t<div class=\"list-group-item\">\n" +
    "\t\t\t<p class=\"list-group-item-text\"><strong>Added by John Smith on 5 March 2014</strong></p>\n" +
    "\t\t</div>\n" +
    "\t\t<div class=\"list-group-item\">\n" +
    "\t\t\t<p class=\"list-group-item-text\">MediaFile card description lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum commodo, nulla ut porta interdum, mi mi venenatis felis, vitae pellentesque ante eros at enim.</p>\n" +
    "\t\t</div>\n" +
    "\t</div>\n" +
    "\t<div class=\"panel-footer\">\n" +
    "\t\t<div class=\"btn-group btn-group-justified\">\n" +
    "\t\t\t<div class=\"btn-group\">\n" +
    "\t\t\t\t<button class=\"btn btn-default\">\n" +
    "\t\t\t\t\t<i class=\"fa fa-arrow-down\"></i>\n" +
    "\t\t\t\t\tDownload\n" +
    "\t\t\t\t</button>\n" +
    "\t\t\t</div>\n" +
    "\t\t\t<div class=\"btn-group\">\n" +
    "\t\t\t\t<button class=\"btn btn-default\">\n" +
    "\t\t\t\t\t<i class=\"fa fa-star\"></i>\n" +
    "\t\t\t\t\tFavorite\n" +
    "\t\t\t\t</button>\n" +
    "\t\t\t</div>\n" +
    "\t\t\t<div class=\"btn-group\">\n" +
    "\t\t\t\t<button class=\"btn btn-default\">\n" +
    "\t\t\t\t\t<i class=\"fa fa-envelope\"></i>\n" +
    "\t\t\t\t\tEmail\n" +
    "\t\t\t\t</button>\n" +
    "\t\t\t</div>\n" +
    "\t\t</div>\n" +
    "\t</div>\n" +
    "</div>"
  );


  $templateCache.put('bootcards-form/bootcards-form.tmpl.html',
    "<div class=\"panel panel-default\">\n" +
    "\t<div class=\"panel-heading clearfix\">\n" +
    "\t\t<h3 class=\"panel-title pull-left\">Form Card Title</h3>\n" +
    "\t\t<div class=\"btn-group pull-right\">\n" +
    "\t\t\t<button class=\"btn btn-danger\">\n" +
    "\t\t\t\t<i class=\"fa fa-times\"></i>\n" +
    "\t\t\t\tCancel\n" +
    "\t\t\t</button>\n" +
    "\t\t\t<button class=\"btn btn-success\">\n" +
    "\t\t\t\t<i class=\"fa fa-check\"></i>\n" +
    "\t\t\t\tSave\n" +
    "\t\t\t</button>\n" +
    "\t\t</div>\n" +
    "\t</div>\n" +
    "\t<div class=\"modal-body\">\n" +
    "\t\t<form class=\"form-horizontal\">\n" +
    "\t\t\t<div class=\"form-group\">\n" +
    "\t\t\t\t<label class=\"col-xs-3 control-label\">Name</label>\n" +
    "\t\t\t\t<div class=\"col-xs-9\">\n" +
    "\t\t\t\t\t<input type=\"text\" class=\"form-control\" value=\"John Smith\">\n" +
    "\t\t\t\t</div>\n" +
    "\t\t\t</div>\n" +
    "\t\t\t<div class=\"form-group\">\n" +
    "\t\t\t\t<label class=\"col-xs-3 control-label\">Occupation</label>\n" +
    "\t\t\t\t<div class=\"col-xs-9\">\n" +
    "\t\t\t\t\t<select class=\"form-control\">\n" +
    "\t\t\t\t\t\t<option>Designer</option>\n" +
    "\t\t\t\t\t\t<option selected>Developer</option>\n" +
    "\t\t\t\t\t\t<option>Salesman</option>\n" +
    "\t\t\t\t\t</select>\n" +
    "\t\t\t\t</div>\n" +
    "\t\t\t</div>\n" +
    "\t\t\t<div class=\"form-group\">\n" +
    "\t\t\t\t<label class=\"col-xs-3 control-label\">Description</label>\n" +
    "\t\t\t\t<div class=\"col-xs-9\">\n" +
    "\t\t\t\t\t<textarea class=\"form-control\" rows=\"6\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam mauris tellus, vehicula ut tellus id, suscipit dapibus tortor. Integer viverra turpis ac fringilla hendrerit. Sed faucibus posuere felis et pellentesque. Cras varius tortor vitae molestie tempor. Proin ut viverra elit, ac gravida tortor.</textarea>\n" +
    "\t\t\t\t</div>\n" +
    "\t\t\t</div>\n" +
    "\t\t</form>\n" +
    "\t</div>\n" +
    "\t<div class=\"panel-footer\">\n" +
    "\t\t<small>Built with Bootcards - Form Card</small>\n" +
    "\t</div>\n" +
    "</div>"
  );


  $templateCache.put('bootcards-list/bootcards-list.tmpl.html',
    "<div class=\"bootcards-list\">\n" +
    "\t<div class=\"panel panel-default\">\n" +
    "\t\t<div class=\"list-group\">\n" +
    "\n" +
    "\t\t\t<a class=\"list-group-item\" href=\"#\" data-index=\"{{$index}}\" ng-repeat=\"item in ngModel\">\n" +
    "\t\t\t\t<img src=\"http://placehold.it/100\" ng-src=\"{{item.image}}\" class=\"img-rounded pull-left\"/>\n" +
    "\t\t\t\t<h4 class=\"list-group-item-heading\">{{item.heading}}</h4>\n" +
    "\n" +
    "\t\t\t\t<p class=\"list-group-item-text\">{{item.text}}</p>\n" +
    "\t\t\t</a>\n" +
    "\n" +
    "\n" +
    "\t\t</div>\n" +
    "\t</div>\n" +
    "</div>\n" +
    "\n" +
    "\n"
  );


  $templateCache.put('bootcards-media/bootcards-media.tmpl.html',
    "<div class=\"panel-body\">\n" +
    "\tMedia card description lorem ipsum dolor est compendium\n" +
    "</div>\n" +
    "<img src=\"http://www.teamstudio.com/Portals/218295/images/istock_000001242290small.jpg\" class=\"img-responsive\"/>\n" +
    "<div class=\"panel-footer\">\n" +
    "\t<div class=\"btn-group btn-group-justified\">\n" +
    "\t\t<div class=\"btn-group\">\n" +
    "\t\t\t<button class=\"btn btn-default\">\n" +
    "\t\t\t\t<i class=\"fa fa-arrow-down\"></i>\n" +
    "\t\t\t\tDownload\n" +
    "\t\t\t</button>\n" +
    "\t\t</div>\n" +
    "\t\t<div class=\"btn-group\">\n" +
    "\t\t\t<button class=\"btn btn-default\">\n" +
    "\t\t\t\t<i class=\"fa fa-star\"></i>\n" +
    "\t\t\t\tFavorite\n" +
    "\t\t\t</button>\n" +
    "\t\t</div>\n" +
    "\t\t<div class=\"btn-group\">\n" +
    "\t\t\t<button class=\"btn btn-default\">\n" +
    "\t\t\t\t<i class=\"fa fa-envelope\"></i>\n" +
    "\t\t\t\tEmail\n" +
    "\t\t\t</button>\n" +
    "\t\t</div>\n" +
    "\t</div>\n" +
    "</div>\n"
  );


  $templateCache.put('bootcards-summary/bootcards-summary.tmpl.html',
    "<div class=\"row\">\n" +
    "\t<div class=\"col-xs-6 col-sm-4\">\n" +
    "\t\t<a class=\"bootcards-summary-item\" href=\"#\">\n" +
    "\t\t\t<i class=\"fa fa-3x fa-users\"></i>\n" +
    "\t\t\t<h4>Contacts <span class=\"label label-info\">432</span></h4>\n" +
    "\t\t</a>\n" +
    "\t</div>\n" +
    "\t<div class=\"col-xs-6 col-sm-4\">\n" +
    "\t\t<a class=\"bootcards-summary-item\" href=\"#\">\n" +
    "\t\t\t<i class=\"fa fa-3x fa-building-o\"></i>\n" +
    "\t\t\t<h4>Companies <span class=\"label label-info\">98</span></h4>\n" +
    "\t\t</a>\n" +
    "\t</div>\n" +
    "\t<div class=\"col-xs-6 col-sm-4\">\n" +
    "\t\t<a class=\"bootcards-summary-item\" href=\"#\">\n" +
    "\t\t\t<i class=\"fa fa-3x fa-clipboard\"></i>\n" +
    "\t\t\t<h4>Notes <span class=\"label label-danger\">54</span></h4>\n" +
    "\t\t</a>\n" +
    "\t</div>\n" +
    "\t<div class=\"col-xs-6 col-sm-4\">\n" +
    "\t\t<a class=\"bootcards-summary-item\" href=\"#\">\n" +
    "\t\t\t<i class=\"fa fa-3x fa-files-o\"></i>\n" +
    "\t\t\t<h4>Files <span class=\"label label-info\">65</span></h4>\n" +
    "\t\t</a>\n" +
    "\t</div>\n" +
    "\t<div class=\"col-xs-6 col-sm-4\">\n" +
    "\t\t<a class=\"bootcards-summary-item\" href=\"#\">\n" +
    "\t\t\t<i class=\"fa fa-3x fa-check-square-o\"></i>\n" +
    "\t\t\t<h4>Tasks <span class=\"label label-warning\">109</span></h4>\n" +
    "\t\t</a>\n" +
    "\t</div>\n" +
    "</div>\n"
  );


  $templateCache.put('bootcards-table/bootcards-table.tmpl.html',
    "<div class=\"table-responsive\">\n" +
    "\t<table class=\"table table-hover\">\n" +
    "\t\t<thead>\n" +
    "\t\t\t<tr class=\"active\"><th>Name</th><th>Forecast</th><th>Quota</th></tr>\n" +
    "\t\t</thead>\n" +
    "\t\t<tbody>\n" +
    "\t\t\t<tr><td>Guy Bardsley</td><td>2750</td><td>4000</td></tr>\n" +
    "\t\t\t<tr><td>Adam Callahan</td><td>3300</td><td>4000</td></tr>\n" +
    "\t\t\t<tr><td><strong>Total</strong></td><td><strong>6050</strong></td><td><strong>8000</strong></td></tr>\n" +
    "\t\t</tbody>\n" +
    "\t</table>\n" +
    "</div>\n"
  );

}]);
