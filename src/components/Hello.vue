<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <h2>Welcome to CryptoTrak</h2>
    <ul>
      <li><a href="https://vuejs.org" target="_blank">Core Docs</a></li>

    </ul>
   
  </div>
</template>

<script>
export default {
  name: 'hello',
  data () {
    return {
      msg: 'CryopTrak'
    }
  } ,
  mounted : function () {
 this.$http.get('http://koobasoft.com/cryptoscrape/LatestBitcoinPrice.php').then(response => {

    console.log( response.body ) ;
    
 } , response => {
    console.log('some error'); 
  } ); 
    //http://koobasoft.com/cryptoscrape/LatestBitcoinPrice.php
    //http://koobasoft.com/cryptoscrape/LatestCoinData.php
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
