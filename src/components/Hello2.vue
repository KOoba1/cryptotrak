<template>
  <div class="hello">
    <h1>Welcome to CryptoTrak</h1>
      <h2>Bitcoin price is: {{ this.bitCoinPrice }}</h2>
       <h3>Your portfolio Value is: {{ this.totalValue }}</h3>
       <h5>Last Updated: {{ this.lastUpdated }}</h5>
     <select id="sitePicker" data-live-search="true" class="selectpicker form-control"  data-icon-base="fa"  data-actions-box="true"  >
      <option v-for="coin in allCoins" :value="coin.CoinId" :key="coin.CoinId" >{{coin.CoinId}}</option>
    </select>
    <label>Qty: <input v-model="qty" type="number"></input> </label>
    <br>
    <label>Purchased Price: <input v-model="origValue" type="number"></input></label>
    <button @click="addCoin">Add Coin</button>
    <h2>My Coins</h2>
    <div v-for="myCoin in myCoins">
      <label>Coin Name: {{ myCoin.coinName }} </label>
      <label>Qty: {{ myCoin.qty }} </label>
      <label>Value: {{ myCoin.value}} </label>
    </div>   
  </div>
</template>

<script>
export default {
  name: 'hello',
  data () {
    return {
     allCoins:[], 
     lastUpdated:'',
     myCoins:[], 
     newCoinName:'',  
     qty:1,
     origValue:0,
     bitCoinPrice:0,
     updateBitcoinInterval: null,
     updateAllInterval:null ,
     coinValue:0

    }
  } ,
  computed : {

    totalValue : function () {

      return this.myCoins.reduce( function ( a , b , index) { return a + b.value  } , 0 ); 
    } 

  },
  methods : {
    addCoin : function() {
      this.newCoinName =  $('.selectpicker').val(); 
      var self = this; 
      var value =  ( $.grep(this.allCoins, function(e){ return e.CoinId == self.newCoinName; }) )[0].BitcoinPrice  * this.qty  * this.bitCoinPrice;
      var newCoin = { 'coinName':this.newCoinName ,  'qty': this.qty , 'value':value} ; 
      this.myCoins.push(newCoin); 

    } , 
    updateBitcoinPrice : function () { 

        this.$http.get('https://koobasoft.com/cryptoscrape/LatestBitcoinPrice.php').then(response => {
          this.bitCoinPrice = response.body[0].Value; 
        
        }, response => {
        console.log('some error'); 
      } 
      ); 

    } ,
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

    }

  },
  mounted : function () {
      this.updateBitcoinPrice(); 
      this.updateBitcoinInterval = setInterval(this.updateBitcoinPrice,60000);
      this.updateAllCoins(); 
      this.updateAllInterval = setInterval(this.updateAllCoins, 60000);

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
