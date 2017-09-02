<template>
  <div class="hello">
    <h1>Welcome to CryptoTrak</h1>
      <h2>Bitcoin price is: {{ this.bitCoinPrice }}</h2>
       <h3 v-if="allCoins.length > 0">Your portfolio Value is: {{ this.totalValue | currency  }}</h3>
       <h4  v-if="allCoins.length > 0">Your total investment is: {{ this.initialInvestment | currency  }}</h4>
       <h4  v-if="allCoins.length > 0">Your total gain/loss is: {{ this.gainLoss | currency  }}</h4>
       <h5>Last Updated: {{ this.lastUpdated }}</h5>

       <div class="row">
        <div class="col-md-2 col-md-offset-5">

     <select id="sitePicker" data-live-search="true" class="selectpicker form-control"  data-icon-base="fa"  data-actions-box="true"  >
      <option v-for="coin in allCoins" :value="coin.CoinId" :key="coin.CoinId" >{{coin.CoinName}}</option>
    </select>
    </div>
    </div>
    <label>Qty: <input v-model="qty" type="number"></input> </label>
    <br>
    <label>Purchased Price: <input v-model="origValue" type="number"></input></label>
    <br>
      <label>Notes: <input v-model="notes" type="text"></input></label>
      <br>
    <button @click="addCoin">Add Coin</button>

    <h2>My Coins</h2>
    <div v-for="(myCoin, index) in myCoins">
      <label>Coin Name: {{ myCoin.coinName }} </label>
      <label>Qty: {{ myCoin.qty }} </label>
      <!-- label>Value: {{ myCoin.value | currency  }} </label-->
          <label>CoinId: {{ myCoin.coinId}} </label>
          <label>Original Value : {{ myCoin.value | currency }} </label>
          <label>Current Value : {{ calculateValue(myCoin.coinId, myCoin.qty) | currency }} </label>
          <label>Change in Value: {{ calculateValue(myCoin.coinId, myCoin.qty) - myCoin.value | currency }} </label>
          <br>
            <label>Notes: {{ myCoin.notes }} </label>
      <span @click='removeCoin(index)' class='glyphicon glyphicon-remove'></span>
    </div>
    <br>
    <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
   
  </div>
</template>

<script>
import Highcharts from 'Highcharts'

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
  name: 'hello',
  data () {
    return {
     allCoins:[], 
     lastUpdated:'',
     myCoins:[], 
     newCoinId:'',  
     qty:1,
     origValue:0,
     bitCoinPrice:0,
     updateBitcoinInterval: null,
     updateAllInterval:null ,
     coinValue:0,
     notes:''

    }
  } ,
  computed : {

    totalValue : function () {
      var sum = 0 ; 
      for ( var i = 0 ; i < this.myCoins.length; i++ ) {

        var myCoin = this.myCoins[i]; 
        console.log(myCoin); 
        sum += this.calculateValue(myCoin.coinId, myCoin.qty) ;  //myCoin.BitCoinPrice * myCoin.qty * this.bitCoinPrice ; 
      }
      return sum ; 
      //return this.myCoins.reduce( function ( a , b , index) { return a + b.value  } , 0 ); 
    }  ,
      initialInvestment : function () {

      return this.myCoins.reduce( function ( a , b , index) { return parseFloat(a) + parseFloat(b.value) } , 0 ); 
    }  ,
       gainLoss : function () {
        return this.totalValue - this.initialInvestment; 
    }  ,
    calculateValue : function (coinId, qty) {
      //return test; 
         var vm = this;  
      return function (coinId, qty) {
          return ( $.grep(vm.allCoins, function(e){ return e.CoinId == coinId; }) )[0].BitcoinPrice  * qty  * vm.bitCoinPrice;
      }; 

    }
  },
  methods : {
    addCoin : function() {
      this.newCoinId =  $('.selectpicker').val(); 
      var self = this; 
      var value =  ( $.grep(this.allCoins, function(e){ return e.CoinId == self.newCoinId; }) )[0].BitcoinPrice  * this.qty  * this.bitCoinPrice;

      var coinName  =  ( $.grep(this.allCoins, function(e){ return e.CoinId == self.newCoinId; }) )[0].CoinName ;
      
      var newCoin = { 'coinName':coinName , 'coinId':this.newCoinId , 'qty': this.qty , 'value':this.origValue , 'notes': this.notes} ; 
      this.myCoins.push(newCoin); 
      window.localStorage.setItem('myCoins', JSON.stringify(this.myCoins));

    } , 
    updateBitcoinPrice : function () { 

        this.$http.get('https://koobasoft.com/cryptoscrape/LatestBitcoinPrice.php').then(response => {
          this.bitCoinPrice = response.body[0].Value; 
        
        }, response => {
        console.log('some error'); 
      } 
      ); 

    } ,
    removeCoin : function(index) {
      
      this.myCoins.splice( index, 1 ); 
      window.localStorage.setItem('myCoins', JSON.stringify(this.myCoins));
    },
    updateAllCoins : function() {


    this.$http.get('https://koobasoft.com/cryptoscrape/LatestCoinData.php').then(response => {
      this.lastUpdated = response.body[0].EntryDate; 
     this.allCoins = response.body ; 
      console.log(response.body); 
    // console.log("first repsonse is: " + response.body[0] );
    // console.log("first coin is: " + this.allCoins[0]); 
     
         this.$nextTick(function() {
          $('.selectpicker').selectpicker('refresh');
        });
        
    
 } , response => {
    console.log('some error'); 
  } ); 

    } ,
    getMyCoins : function() {

      var coinData =  window.localStorage.getItem('myCoins') ;
      if (coinData != null || coinData != '' ) {
        this.myCoins = JSON.parse(coinData); 
      } else {
        console.log('no local storage')
      }

    } ,

    createPieChart(){

// Build the chart
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Portfolio Breakdown'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
      credits: {
      enabled: false
  },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                },
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Percent of portfolio: ',
        data: [
            { name: 'GNT', y: 56.33 },
        
            { name: 'Maid', y: 10.38 },
            { name: 'SJCX', y: 4.77 }
        ]
    }]
});
    }

  },
  mounted : function () {
      this.getMyCoins(); 
      this.updateBitcoinPrice(); 
      this.updateBitcoinInterval = setInterval(this.updateBitcoinPrice,60000);
      this.updateAllCoins(); 
      this.updateAllInterval = setInterval(this.updateAllCoins, 60000);

      this.createPieChart(); 
   

      /*
      var self = this; 
       $('.selectpicker').on('change', function () {
        var value = $('.selectpicker').val(); 
        self.coinValue = value; 
        //alert( value ) ; 
       });   
      */ 
    //http://koobasoft.com/cryptoscrape/LatestBitcoinPrice.php
    //http://koobasoft.com/cryptoscrape/LatestCoinData.php
  } , 
  beforeDestroy: function() {
    clearInterval(this.updateBitcoinInterval);
    clearInterval(this.updateAllInterval);
    //this.table.destroy();
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
