<template>
	<div>
	</div>
</template>
<script>
var Highcharts = require('highcharts');

Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
    return {
        radialGradient: {
            cx: 0.5,
            cy: 0.3,
            r: 0.7
        },
        stops: [
            [0, color],
            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
        ]
    };
});

export default {
	props:['myCoins'], 
	data : function () {

		return {
			target:null
		}

	},
	methods : {

		drawChart : function() {
		var myData = [] ; 
		this.myCoins.forEach( function(coin) {
			myData.push({ "name":coin.name , "y":coin.value} );
		}) ; 
		
 	this.target = Highcharts.chart(this.$el, {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    credits: {
      enabled: false
     },
    title: {
        text: 'My Coin Portfolio'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
          
        }
    },
    series: [{
        name: 'Coins', 
        data : myData 
        /*
        data: [
            { name: 'Water', y: 56.33 },
            { name: 'Body Fat', y: 24.03, sliced: true, selected: true },
            { name: 'Lean Mass', y: 10.38 }
        ] */
    }]
});
		}

	},
	mounted  : function( ) {
		//this.drawChart();
	},
	 watch: {
	 	myCoins : function() {
	 		this.drawChart();
	 	}
	 },
	beforeDestroy: function() {
    	this.target.destroy();
	}
}

</script>
