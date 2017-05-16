<template>
  <div class="hello">
    <h1>Welcome to CryptoTrak</h1>
      <h2>Bitcoin price is: {{ this.bitCoinPrice }}</h2>
       <h3>Your portfolio Value is: {{ this.totalValue }}</h3>
     <select id="sitePicker" data-live-search="true" class="selectpicker form-control"  data-icon-base="fa"  data-actions-box="true"  >
      <option v-for="coin in allCoins" :value="coin.BitcoinPrice" :key="coin.CoinId" >{{coin.CoinName}}</option>
    </select>
    <input v-model="qty" type="number"></input>
    <input v-model="origValue" type="number"></input>
    <p>Cur value: {{ currentValue }} </p>
   
  </div>
</template>

<script>
export default {
  name: 'hello',
  data () {
    return {
     allCoins:[], 
     newCoin:'',
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

      return 5; 
    } , 
    currentValue : function() {

     // return qty * this.myCoinValue * bitCoinPrice  ; 
        return this.qty * this.coinValue * this.bitCoinPrice  ; 
    }

  },
  methods : {
    updateBitcoinPrice : function () { 

        this.$http.get('http://koobasoft.com/cryptoscrape/LatestBitcoinPrice.php').then(response => {
          this.bitCoinPrice = response.body[0].Value; 
        
        }, response => {
        console.log('some error'); 
      } 
      ); 

    } ,
    updateAllCoins : function() {


    this.$http.get('http://koobasoft.com/cryptoscrape/LatestCoinData.php').then(response => {
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

      var self = this; 
       $('.selectpicker').on('change', function () {
        var value = $('.selectpicker').val(); 
        self.coinValue = value; 
        //alert( value ) ; 
       });   

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
