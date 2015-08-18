/* 
 * This plugin is created by Md Riad Hossain
 * Goal is to make some regular needed Javascript things that save time and toil.
 */
(function ( $ ) {
    $.fn.colorful = function(){
        //alert(this.text());
        this.css("color","rgb("+ Math.floor((Math.random() * 255) + 1) +","+ Math.floor((Math.random() * 255) + 1) +","+ Math.floor((Math.random() * 255) + 1) +")");
        return this;
    };

    $.fn.bdt = function( options ){
        var nStr = this.text();
        nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
        var settings = $.extend({
            bdt_sign: 'BDT'
        }, options );
        return this.text(x1 + x2 + '.00'+settings.bdt_sign);
    };
    
    $.fn.calculate = function(options){
        var total = 0;
        this.each(function(){
            total = total + parseInt($(this).text());
        });
        
        var settings = $.extend({
            target_id: 'total',
            money:true
        });
        if($('#' + settings.target_id).length == 0){
            return alert('Sorry no target id defined to draw result.');
        }
        $('#' + settings.target_id).text(total)
        if(settings.money){
            $('#' + settings.target_id).bdt();
        }
    }
}(jQuery));
