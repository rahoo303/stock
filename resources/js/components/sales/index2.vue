 
<script setup>
import Sidebar from '../sidebar/index.vue'
import {onMounted, ref} from 'vue'
 

let itemMasters = ref([])

onMounted(async () => {
    getItemMaster()
})

const getItemMaster = async() => {
    let response = await axios.get("/api/getItemMaster")
    console.log('response', response)
    itemMasters.value = response.data.items
}

 
 

</script>
<template>
 



<main id="main" class="main">
    <Sidebar/>
<div class="pagetitle">
  <h1>Item Page</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Sales</a></li>
      <li class="breadcrumb-item">Pages</li>
      <li class="breadcrumb-item active">Blank</li>
    </ol>
  </nav>
</div><!-- End Page Title -->




<section class="section">
    <div class="row">
    <div class="col-lg-12">
        <section class="content" id="evaluate" style="background-color:#fff; padding-bottom:50px;" v-cloak>

<div class="subjects-content">
  <h3 class="subjects-trimester-title">Self Evaluation Page</h3>

     <div class="self-evaluation-rows">
             Number of Rows: &nbsp; 
             <input type="text" name="rows" class="rows-textbox">
             <div class="btn btn-blueviolet btn-inline-block btn-create" @click="addRow">Add Row</div>
     </div>

     

     <div class="box-body box-self-evaluation">
         <table id="example2" class="table table-hover table-striped sortable">
             <thead>
                 <tr>
                     <th>Item</th>
                     <th>Price</th>
                     <th>Qty</th>
                    
                     <th>Remove</th>
                 </tr>
             </thead>
             
             <tbody>
                 <tr v-for="row in rows">
                     <td>
                       <select>
                       <option>- - - -</option><br>
                       <option value="CS101">CS101</option>
                       <option value="CS102">CS102</option>
                       </select>
                     </td>
                     <td>
                       <select>
                       <option>- - - -</option><br>
                       <option value="IP">IP</option>
                       <option value="IQ">IQ</option>
                       </select>
                     </td>
                      <td>
                       <select>
                       <option>- - - -</option><br>
                       <option value="A+">A+</option>
                       <option value="A">A</option>
                       </select>
                     </td>
                     <td><span>COURSE DESCRIPTION MADAFAKAH AUTOMATIC kaya ba?</span></td>
                     <td><button type="button" @click="removeRow(row)" class="fa fa-remove delete-button"></button></td> </tr> 
             </tbody>
          </table>   
          </div>
       </div>
     <div class="confirmation-buttons-self-evaluation">
         <div class="btn btn-blueviolet btn-inline-block btn-create">Save</div>
 </div>             
                  
</section>
     

</div>
</div>
 
</section>

</main><!-- End #main -->



 


</template>
