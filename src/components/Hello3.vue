<template>
    <div>
       <div id="wrapper">
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
                        <div></div>
                        <div class="panel-body">

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
                            <a class="closebox"><i class="fa fa-times"></i></a>
                        </div>
                        My Coins
                    </div>
                    <div class="panel-body list">
                        <div class="table-responsive project-list">
                            <table class="table table-striped">
                                <thead>
                                <tr>

                                    <th colspan="2">Project</th>
                                    <th>Completed</th>
                                    <th>Task</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
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

        </div>
    </div>
</div>
</template>
<script>

  
    export default {

       name: 'hello',
       data () {
        return {
           myCoins:[]
          }
        } ,

   
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