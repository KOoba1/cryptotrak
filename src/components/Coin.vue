<template>
		<tr>
                            <td><img :src="coin.img"  height="25px" width="25px"></img> </td>
                            <td> {{ coin.name }} </td>
                            <td> {{ coin.id }}  </td>
                            <td> {{ coin.qty }} </td>
                            <td> {{ coinShare }}%</td>
                            <td> ${{ totalValue.toFixed(2) }}</td>
                            <td :class="{ isPositive : gainLossPositive, isNegative:!gainLossPositive }"> {{ gainLoss }}</td>
                            <td :class="{ isPositive : gainLossPositive , isNegative:!gainLossPositive }"> {{gainLossPercent}}%</td>
                            <td><span @click="$emit('deleteCoin')" class='glyphicon glyphicon-remove'></span></td>
                        </tr>

</template>
<script>
export default {

 props: ['totalPortfolioValue','coin', 'myIndex','singleCoinValue'] ,
 computed : {
  coinShare : function () {
    return  (this.totalValue / this.totalPortfolioValue  * 100 ).toFixed(2); 
  },
  totalValue : function() {
    return this.coin.qty * this.singleCoinValue ; 
  },
  gainLoss : function() {
    if (this.coin.purchased == 0 ) {
      return "N/A" ; 
    } else {
     return ((this.totalValue - this.coin.purchased).toFixed(2)) ; 
    }
  },
  gainLossPositive : function() {

    return this.gainLoss >= 0 ; 
  
  }, 
  gainLossPercent : function() {
        if (this.coin.purchased == 0 ) {
      return "N/A" ; 
    } else {
    return (((this.totalValue - this.coin.purchased) / this.coin.purchased ) * 100).toFixed(2); 
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
</style>