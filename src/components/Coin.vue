<template>
		<tr>
                            <td><img :src="coinImage"  height="25px" width="25px"></img> </td>
                            <td> {{ coin.name }} </td>
                            <td> {{ coin.id }}  </td>
                            <td> {{ coin.qty }} </td>
                            <td> {{ costBasis | currency('$', 4)  }} </td>
                            <td> {{ singleCoinValue | currency('$', 4)  }} </td>
                            <td> {{ coinShare }}%</td>
                            <td> {{ coin.purchased | currency('$', 2)  }} </td>
                            <td> ${{ totalValue.toFixed(2) }}</td>
                            <td :class="{ isPositive : gainLossPositive, isNegative:!gainLossPositive }"> {{ gainLoss | currency }}</td>
                            <td :class="{ isPositive : gainLossPositive , isNegative:!gainLossPositive }"> {{gainLossPercent}}</td>
                            <td><span @click="$emit('deleteCoin')" class='deleteCoin glyphicon glyphicon-remove'></span></td>
                        </tr>

</template>
<script>
export default {

 props: ['totalPortfolioValue','coin', 'myIndex','singleCoinValue','coinImage'] ,
 computed : {
  coinShare : function () {
    return  (this.totalValue / this.totalPortfolioValue  * 100 ).toFixed(2); 
  },
  totalValue : function() {
    return this.coin.qty * this.singleCoinValue ; 
  },
  gainLoss : function() {
    if (this.coin.purchased == 0 ) {
      return "" ; 
    } else {
     return ((this.totalValue - this.coin.purchased).toFixed(2)) ; 
    }
  },
  gainLossPositive : function() {

    return this.gainLoss >= 0 ; 
  
  }, 
  gainLossPercent : function() {
        if (this.coin.purchased == 0 ) {
      return "" ; 
    } else {
    return (((this.totalValue - this.coin.purchased) / this.coin.purchased ) * 100).toFixed(2) + "%" ; 
  }
  },
  costBasis : function ()  {
       if (this.coin.purchased == 0 ) { 
        return "N/A" ;
       } else {
        return (this.coin.purchased / this.coin.qty).toFixed(2) ; 
      }
  }

 }

}
</script>
<style scoped>
.isPositive{
  color:green;
}
.isNegative{
  color:red;
}
.deleteCoin { cursor: pointer; cursor: hand; }
</style>