<template>

 <div class="container-fluid" id="wrapper">
    <div class="content animate-panel">
    <div v-if="firebaseDataLoaded" >{{ allCoins['1337']['USD'] }}</div>
        <div class="row">
            <div class="col-lg-12">
                <div class="hpanel">
                    <div class="panel-heading">
                        <div class="panel-tools">
                            <a class="showhide"><i class="fa fa-chevron-up"></i></a>

                        </div>
                        Add Coins
                    </div>

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-sm-2">
                               <h5> Select a coin </h5>
                               <v-select v-model="selectedCoin" placeholder="Select a coin" :options="Object.keys(allCoins)"></v-select>
                               <!-- select id="coinSelect" class="coinSelect" style="width: 100%">
                                <option></option>
                                <option value="MAID">MAID</option>
                                <option value="GNT">GNT</option>
                                <option value="ETH">ETH</option>
                                <option value="BAT">BAT</option>
                            </select !-->
                        </div>

                        <div class="col-sm-2">
                          <h5>Qty</h5>
                          <input id="qty" type="text"  name="qty" value="1">
                      </div>


                      <div class="col-sm-2">
                         <h5>Purchased Price (Optional) </h5>
                         <input id="purchasedPrice" type="text"  name="purchasedPrice" value="">
                     </div>
                     <div class="col-sm-4">
                         <h5>Notes (Optional)</h5>
                         <input type="text" v-model="newNote" placeholder="Some note" class="form-control">
                     </div>
                       <div class="col-sm-2">
                       <h5> Add</h5>
                       <button @click="addCoin" class="btn btn-success">Add Coin</button>
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
                <p v-if="myCoins.length == 0 ">Please enter some coins</p>
                <table v-else class="table table-striped">
                    <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Symbol</th>
                            <th @click="sortByQty" >Qty</th>
                            <th>Share</th>
                            <th>Value</th>
                            <th>Gain/Loss</th>
                            <th>Gain/Loss %</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(myCoin, index) in myCoins">
                            <td><img :src="myCoin.img"  height="25px" width="25px"></img></td>
                            <td>{{ myCoin.name }}</td>
                            <td>{{ myCoin.id }}</td>
                            <td>{{ myCoin.qty }}</td>
                            <td>100%</td>
                             <td>{{ myCoin.value }}</td>
                              <td>+$10</td>
                               <td>4%</td>
                        </tr>

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
            <p>Highchart showing portfolio share goes here </p>
        </div>
    </div>
</div>
</div>

</div>
</div>

</template>
<script>
import vSelect from "vue-select"

 import firebaseConnect from '@/firebaseConnect.js'
export default {

   components: {vSelect},
     name: 'hello',
      firebase: {

    firebaseCoins: {

      source: firebaseConnect.FBApp.ref('allCoins'),
      // optionally bind as an object
      asObject: true

    }
  } ,
     data () {
        return {
           firebaseDataLoaded:false,
            selectedCoin:"",
            newNote:"",
            someValue:" old value" ,
            allCoins:{},
            coins:[{label:'Maidsafe', value:'MAID'}],
         myCoins:[ ]
     }
 } ,
 methods : {
    addCoin: function() {
      console.log(this.allCoins);
      var coinValue = -4;
      //this.$firebaseRefs.allCoins.child('SUB').once('value').then (  function (snapshot)  {
      /*  this.$firebaseRefs.allCoins.once('value').then (  function (snapshot)  {

          coinValue  = JSON.parse( snapshot.val() ) ;
          console.log(coinValue['AMS']['USD'] );
      }); */

      var rawQty = $('#qty').val() ;

      var purhcasedPrice = $('#purchasedPrice').val();
      var id = this.selectedCoin;
      var thisCoin = this.allCoins[id];
      console.log(id);
      console.log(thisCoin);
      var imgSrc = 'https://www.cryptocompare.com' + thisCoin.image;
      var coinValue = thisCoin.USD * rawQty;
      console.log(imgSrc);

     var newCoin = { "name":thisCoin.fullName ,  "id":id, "qty":rawQty , "purchased":purchasedPrice,  "note":this.newNote , "value":coinValue , "img": imgSrc } ;

      this.myCoins.push(newCoin);
      window.localStorage.setItem('myCoins', JSON.stringify(this.myCoins));
      this.selectedCoin = "";
    },
    sortByQty : function() {
      //alert('test');
      //this.myCoins.sort();

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
  console.log(this.allCoins);
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


}


}


/*
  import firebaseConnect from '@/firebaseConnect.js'

firebase() {

        return {

          allCoins: {
          source: firebaseConnect.FBApp.ref('allCoins'),

             asObject: true,

             readyCallback: function () {}
          }
        }
    }
    */
</script>