<template>

 <div class="container-fluid" id="wrapper">
    <div class="content animate-panel">

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
                               <select id="coinSelect" class="coinSelect" style="width: 100%">
                                <option></option>
                                <option value="MAID">MAID</option>
                                <option value="GNT">GNT</option>
                                <option value="ETH">ETH</option>
                                <option value="BAT">BAT</option>
                            </select>
                        </div>

                        <div class="col-sm-2">
                          <h5>Qty</h5>
                          <input id="qty" type="text"  name="qty" value="0">
                      </div>   


                      <div class="col-sm-2">
                         <h5>Purchased Price (Optional) </h5>
                         <input id="purchasedPrice" type="text"  name="purchasedPrice" value="">
                     </div>
                     <div class="col-sm-4">
                         <h5>Notes (Optional)</h5>
                         <input type="text" placeholder="Some note" class="form-control">
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
                <table class="table table-striped">
                    <thead>
                        <tr>

                            <th colspan="3">Coin</th>
                            <th>Qty</th>
                            <th>Share</th>
                            <th>Value</th>
                            <th>Gain/Loss</th>
                            <th>Gain/Loss %</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(myCoin, index) in myCoins">
                            <td><i class="fa fa-clock-o"></i> </td>
                            <td>{{ myCoin.name }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="i-checks" checked></td>
                            <td>Contract with Zender Company
                                <br/>
                                <small><i class="fa fa-clock-o"></i> Created 14.08.2015</small>
                            </td>
                            <td>
                                <span class="pie">1/5</span>
                            </td>
                            <td><strong>20%</strong></td>
                            <td>Jul 14, 2013</td>
                            <td><a href=""><i class="fa fa-check text-success"></i></a></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="i-checks"></td>
                            <td>There are many variations of passages
                                <br/>
                                <small><i class="fa fa-clock-o"></i> Created 21.07.2015</small>
                            </td>
                            <td>
                                <span class="pie">1/4</span>
                            </td>
                            <td><strong>40%</strong></td>
                            <td>Jul 16, 2013</td>
                            <td><a href=""><i class="fa fa-check text-navy"></i></a></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="i-checks" checked></td>
                            <td>Contrary to popular belief
                                <br/>
                                <small><i class="fa fa-clock-o"></i> Created 12.06.2015</small>
                            </td>
                            <td>
                                <span class="pie">0.52/1.561</span>
                            </td>
                            <td><strong>75%</strong></td>
                            <td>Jul 18, 2013</td>
                            <td><a href=""><i class="fa fa-check text-navy"></i></a></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="i-checks"></td>
                            <td>Gamma project
                                <br/>
                                <small><i class="fa fa-clock-o"></i> Created 06.03.2015</small>
                            </td>
                            <td>
                                <span class="pie">226/360</span>
                            </td>
                            <td><strong>16%</strong></td>
                            <td>Jul 22, 2013</td>
                            <td><a href=""><i class="fa fa-check text-navy"></i></a></td>
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

export default {

     name: 'hello',
     data () {
        return {
            coinName:"", 
         myCoins:[ { "name":"test" }]
     }
 } ,
 methods : {
    addCoin: function() {

      this.coinName = $('#coinSelect').val(); 
      alert(this.coinName); 
     var newCoin = { "name":this.coinName} ; 
      //var self = this; 
      //var value =  ( $.grep(this.allCoins, function(e){ return e.CoinId == self.newCoinId; }) )[0].BitcoinPrice  * this.qty  * this.bitCoinPrice;

     // var coinName  =  ( $.grep(this.allCoins, function(e){ return e.CoinId == self.newCoinId; }) )[0].CoinName ;
      
      //var newCoin = { 'coinName':coinName , 'coinId':this.newCoinId , 'qty': this.qty , 'value':this.origValue , 'notes': this.notes} ; 
      this.myCoins.push(newCoin); 
      //window.localStorage.setItem('myCoins', JSON.stringify(this.myCoins));
    }

 } ,
 mounted () {

   $("#qty").TouchSpin({
    min: 0,
    max: 1000000,
    step: 1,
    decimals: 6,
    boostat: 5,
    maxboostedstep: 10,
});

   $(".coinSelect").select2( { placeholder: "Select a coin" } );

   $("#purchasedPrice").TouchSpin({
    prefix: '$',
    min: 0 ,
    max: 100000000,
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