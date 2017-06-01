<template>
	<div>

		 <h2>Crytpo Trak - Market Cap</h2>
  <p>The top 10 crypto coins by market cap based on actual supply as opposed to circulating supply<sup><i class="fa fa-question-circle emphasis" title="Most exchanges display market cap based on the circulating supply which we believe is misleading. Basing a coins market cap on circulating supply is analagous to displaying Facebook's market cap minus Mark Zuckerburg's shares."></i></sup></p>            
  <table class="table table-striped table-responsive">
    <thead>
      <tr>
        <th>Coin</th>
        <th>Symbol</th>
        <th>Value</th>
        <th>Total Supply</th>
   		<th>Market Cap</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Bitcoin    <i class="cc BTC"></i></td>
        <td>BTC</td>
        <td>$2,500</td>
        <td>21,000,000</td>
        <td>$19,232,000,000</td>
      </tr>
      <tr>
        <td>Ethereum    <i class="cc ETH"></i></td>
        <td>ETH</td>
        <td>$230</td>
        <td>3,302,300</td>
        <td>$3,512,600,000</td>
      </tr>
      <tr>
        <td>Ethereum    <i class="cc GNO"></i></td>
        <td>ETH</td>
        <td>$230</td>
        <td>3,302,300</td>
        <td>$3,512,600,000</td>
      </tr>
    </tbody>
  </table>

	<!-- table class="ui celled striped table">
  <thead>
    <tr>
    <th class="right aligned" >Coin Name</th>
      <th class="right aligned">Symbol</th>
  </tr></thead>
  <tbody>
    <tr>
      <td class="collapsing">
        <i class="cc BTC"></i> BitCoin 
      </td>
      <td>Initial commit</td>
      <td class="right aligned collapsing">10 hours ago</td>
    </tr>
    <tr>
      <td>
       <i class="cc ETH"></i> Ethereum 
      </td>
      <td>Initial commit</td>
      <td class="right aligned">10 hours ago</td>
    </tr>
    <tr>
      <td>
        <i class="folder icon"></i> build
      </td>
      <td>Initial commit</td>
      <td class="right aligned">10 hours ago</td>
    </tr>
    <tr>
      <td>
        <i class="file outline icon"></i> package.json
      </td>
      <td>Initial commit</td>
      <td class="right aligned">10 hours ago</td>
    </tr>
    <tr>
      <td>
        <i class="file outline icon"></i> Gruntfile.js
      </td>
      <td>Initial commit</td>
      <td class="right aligned">10 hours ago</td>
    </tr>
  </tbody>
</table !-->
	</div>
</template>
<script>
export default {
	
	
}
</script>
<style scoped>
th {

	text-align:center;
}

sup .fa-question {
  color: blue;
  opacity: .5;
  transition: all 0.2s ease-in-out 0;
  cursor: help;
}

sup .fa-question:hover {
  color: #337ab7;
  opacity: .8;
}

</style>