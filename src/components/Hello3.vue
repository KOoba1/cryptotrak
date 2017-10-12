<template>

 <div class="container-fluid" id="wrapper">
    <div class="content animate-panel">
    <!-- div v-if="firebaseDataLoaded" >{{ allCoins['1337']['USD'] }}</div-->
      <!-- {{ lastUpdate['.value'] }} -->
        <div class="row">
            <div class="col-lg-12">
                <div class="hpanel" id="addCoinPanel">
                    <div class="panel-heading">
                        <div class="panel-tools">
                            <a class="showhide"><i class="fa fa-chevron-up"></i></a>

                        </div>
                        Add Coins
                    </div>

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-sm-2">
                               <h5> Select a coin  <i class="fa fa-question" aria-hidden="true"></i></h5>
                               <!-- v-select v-model="selectedCoin" placeholder="Select a coin" :options="Object.keys(allCoins)"></v-select-->
                               <v-select v-model="selectedCoin" placeholder="Select a coin" :options="selectCoinList"></v-select>
                               <!-- select id="coinSelect" class="coinSelect" style="width: 100%">
                                <option></option>
                                <option value="MAID">MAID</option>
                                <option value="GNT">GNT</option>
                                <option value="ETH">ETH</option>
                                <option value="BAT">BAT</option>
                            </select !-->
                        </div>

                        <div class="col-sm-2">
                          <h5>Quantity  <i class="fa fa-question" aria-hidden="true"></i></h5>
                          <input id="qty" type="text"  name="qty" value="1">
                      </div>


                      <div class="col-sm-2">
                         <h5>Purchased Price (Optional)  <i class="fa fa-question" aria-hidden="true"></i></h5>
                         <input id="purchasedPrice" type="text"  name="purchasedPrice" value="">
                     </div>
                     <div class="col-sm-4">
                         <h5>Notes (Optional)  <i class="fa fa-question" aria-hidden="true"></i></h5>
                         <input type="text" v-model="newNote" placeholder="Some note" class="form-control">
                     </div>
                       <div class="col-sm-2">
                       <h5> Add</h5>
                       <button @click="addCoin"  id="addCoin" class="btn btn-success">Add Coin</button>
                   </div>
                 </div>


       </div> <!-- end of add coin panel body -->
   </div>
</div>
</div>

<div class="row">
   <div class="col-lg-12">
    <div class="hpanel">
        <div class="panel-heading">
            <div class="panel-tools">
                <a class="showhide"><i class="fa fa-chevron-up"></i></a>
            </div>
            My Coins
        </div>
        <div class="panel-body list">
            <div class="table-responsive project-list">
                <p v-if=" myCoins.length == 0  ">Please add a coin above</p>
                <table v-else class="table table-striped">
                    <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Symbol</th>
                            <th @click="sortByQty" >Qty</th>
                            <th>Price Paid</th>
                            <th>Current Price</th>
                            <th>Share</th>
                            <th>Total Price</th>
                            <th>Current Value</th>
                            <!--th>Gain/Loss</th-->
                            <th>Gain/Loss %</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--tr v-for="(myCoin, index) in myCoins">
                            <td><img :src="myCoin.img"  height="25px" width="25px"></img></td>
                            <td>{{ myCoin.name }}</td>
                            <td>{{ myCoin.id }}</td>
                            <td>{{ myCoin.qty }}</td>
                            <td>100%</td>
                             <td>{{ myCoin.value }}</td>
                              <td>{{ myCoin.value - myCoin.purchased }} </td>
                               <td>4%</td>
                               <td> <span @click='removeCoin(index)' class='glyphicon glyphicon-remove'></span> </td>
                        </tr-->
                        <Coin v-for="(myCoin,index) in myCoins" :coin="myCoin" :totalPortfolioValue="totalPortfolioValue" :singleCoinValue="getCoinValue(myCoin.id)" :key="index"
                        v-on:deleteCoin="removeCoin(index)">
                        ></Coin>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<div class="row">
   <div class="col-lg-12">
    <div class="hpanel">
        <div class="panel-heading">
            <div class="panel-tools">
                <a class="showhide"><i class="fa fa-chevron-up"></i></a>
            </div>
            My Portfolio
        </div>
        <div class="panel-body list">
            <div v-show="myCoins.length == 0 ">Please add a coin</div>
            <div v-show="myCoins.length != 0 ">
            <p>Total portfoilio value: {{ totalPortfolioValue  }} </p>
            <PortfolioChart :myCoins="myCoins" ></PortfolioChart>
            </div>
        </div>
    </div>
</div>
</div>

</div>
</div>

</template>
<script>
import vSelect from "vue-select"
import Coin from '@/components/Coin.vue'
import PortfolioChart from '@/components/PortfolioChart'

 import firebaseConnect from '@/firebaseConnect.js'
export default {

   components: {vSelect, Coin, PortfolioChart},
     name: 'hello',
      firebase: {
    lastUpdate: {
      source: firebaseConnect.FBApp.ref('lastUpdate'),
      asObject:true
    },
    firebaseCoins: {

      source: firebaseConnect.FBApp.ref('allCoins'),
      // optionally bind as an object
      asObject: true

    }
  } ,
  computed : {
    selectCoinList : function() {
      var retVal = [];
      var self = this;
      Object.keys(this.allCoins).forEach(function(key,index) {
      var label =  self.allCoins[key].fullName + " (" +  key + ")";
      retVal.push({"label":label , "value":key } );
    });

      return retVal ;
    } ,
    totalPortfolioValue : function ( ) {
      if (Object.keys(this.allCoins).length === 0 && this.allCoins.constructor === Object ) {
           return 0 ;       } //make sure data is ready
      var totalVal = 0;
      var self = this;
      this.myCoins.forEach(function(coin) {
       var thisVal = coin.qty * self.allCoins[coin.id]['USD'] ;
       totalVal += thisVal ;
      });

      return totalVal ;
    }

  } ,

     data () {
        return {
           firebaseDataLoaded:false,
            selectedCoin:"",
            newNote:"",
            allCoins:{},
            myCoins:[ ]
     }
 } ,
 methods : {
    getCoinValue : function(coinId) {
       if (Object.keys(this.allCoins).length === 0 && this.allCoins.constructor === Object ) {
           return 0 ;       } //make sure data is ready
      return this.allCoins[coinId]['USD'];

    },
    addCoin: function() {

      var coinValue = -4;
      //this.$firebaseRefs.allCoins.child('SUB').once('value').then (  function (snapshot)  {
      /*  this.$firebaseRefs.allCoins.once('value').then (  function (snapshot)  {

          coinValue  = JSON.parse( snapshot.val() ) ;
          console.log(coinValue['AMS']['USD'] );
      }); */

      var rawQty = $('#qty').val() ;

      var purhcasedPrice = $('#purchasedPrice').val();
      //  var id = this.selectedCoin;
      var id = this.selectedCoin.value;

      var thisCoin = this.allCoins[id];

      var imgSrc = 'https://www.cryptocompare.com' + thisCoin.image;
      var coinValue = thisCoin.USD * rawQty;

      /*   the "value" property is only used for the chart , this should likely be refactored to be updated anytime the coin value is updated (loop through all coins and update their values instead of passing the singleCoinValue to the coin in the for loop" */
     var newCoin = { "name":thisCoin.fullName ,  "id":id, "qty":rawQty ,
     "value":coinValue,  "purchased":purhcasedPrice,  "note":this.newNote ,  "img": imgSrc } ;

      this.myCoins.push(newCoin);

      $('#purchasedPrice').val('');
      $('#qty').val(1)  ;
      this.newNote = '' ; 
      window.localStorage.setItem('myCoins', JSON.stringify(this.myCoins));
      this.selectedCoin = "";
      toastr.options = {
          "debug": false,
          "positionClass": "toast-top-center",
          "onclick": null,
          "fadeIn": 300,
          "fadeOut": 1000,
          "timeOut": 2000,
          "extendedTimeOut": 1000
      }
      toastr.success('Coin Added')

    },
    sortByQty : function() {
      //alert('test');
      //this.myCoins.sort();

    } ,
      removeCoin : function(index) {

      this.myCoins.splice( index, 1 );
      window.localStorage.setItem('myCoins', JSON.stringify(this.myCoins));
      toastr.options = {
          "debug": false,
          "positionClass": "toast-top-center",
          "onclick": null,
          "fadeIn": 300,
          "fadeOut": 1000,
          "timeOut": 2000,
          "extendedTimeOut": 1000
      }
      toastr.error('Coin removed')
    },
     getMyCoins : function() {

      var coinData =  window.localStorage.getItem('myCoins') ;
      if (coinData != null && coinData != '' ) {
        //different browsers treat local storage differently, keep this in mind if page doesn't load
        this.myCoins = JSON.parse(coinData);

      } else {
        console.log('no local storage');
      }

    }

 } ,
 created() {
  var self = this;
    this.$firebaseRefs.firebaseCoins.once('value').then (  function (snapshot)  {

          self.allCoins  = JSON.parse( snapshot.val() ) ;
          self.firebaseDataLoaded = true;
          //console.log(coinValue['AMS']['USD'] );
      });
  //this.someValue = "new value" ;
  //alert(this.someValue); // one possiblity is to load all data  into memory on page load and store it in a local object then use that local object to get all coin info
  // example :    MAID : { "name":"Maid safe" , ID:"MAID" , Price:23, Image Location: " etc" } , GNT : { "name":"Maid safe" , ID:"MAID" , Price:23, Image Location: " etc" }
 } ,

 mounted () {


    $('body').on('keypress',  function(args) {
     if (args.keyCode == 13) {
        $("#addCoin").click();
           return false;
        }
    });


  this.getMyCoins();

   $("#qty").TouchSpin({
    min: 0,
    max: 1000000,
    step: 1,
    forcestepdivisibility:'none',
    decimals: 0,
    boostat: 5,
    maxboostedstep: 10,
});

   $(".coinSelect").select2( { placeholder: "Select a coin" } );

   $("#purchasedPrice").TouchSpin({
    prefix: '$',
    min: 0 ,
    max: 100000000,
    forcestepdivisibility:'none',
    step:1,
    decimals:2,
    boostat:5,
    maxboostedstep:10
});

   $('.bootstrap-touchspin-down').each(function (i) { $(this).attr('tabindex', -1); });
    $('.bootstrap-touchspin-up').each(function (i) { $(this).attr('tabindex', -1); });
}


}


</script>

<style >
.toast-top-center {
    top: 80px;

}
</style>