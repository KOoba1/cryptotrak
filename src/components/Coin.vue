<template>
	<div>
		<tr>
                            <td><img :src="myCoin.img"  height="25px" width="25px"></img></td>
                            <td>{{ myCoin.name }}</td>
                            <td>{{ myCoin.id }}</td>
                            <td>{{ myCoin.qty }}</td>
                            <td>100%</td>
                             <td>{{ myCoin.value }}</td>
                              <td>{{ myCoin.value - myCoin.purchased }} </td>
                               <td>4%</td>
                               <td> <span @click='removeCoin(index)' class='glyphicon glyphicon-remove'></span> </td>
                        </tr>


	</div>
</template>
<script>
export default {


}
</script>