
<script setup>
import Sidebar from '../sidebar/index.vue'
import {onMounted, ref} from 'vue'

let salesList = ref([])
 
onMounted(async () => {
    getSales()
})

const getSales = async() => {
    let response = await axios.get("/api/getSales", {
        headers: {
            Authorization: `Bearer ${localStorage.getItem('usersession')}`
        }
    });
    salesList.value = response.data.sales
}
 

</script>
<template>
 



<main id="main" class="main">
    <Sidebar/>
<div class="pagetitle">
  <h1>Item Page</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item">Pages</li>
      <li class="breadcrumb-item active">Sales List</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
    

<div  class="col-lg-12" style="height: 400px; overflow-y: scroll;">
       <!-- Table with hoverable rows -->
       
       <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Bill No</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Bill Date</th>
                    <th scope="col">Amount</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in salesList" :key="item.id" v-if="salesList.length > 0" >
                    <th scope="row">{{ item.id }}</th>
                    <th>{{ item.customer_name }}</th>
                    <th>{{ item.mobile }}</th>
                    <td>{{ item.bill_date }}</td>
                    <td>{{ item.amount ?? '-' }}</td>
                  
                     
                  </tr>
                  <tr v-else><td colspan="4">No data found</td></tr>
                  
               
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

</div>
</div>
</section>
<a href="/" class="back-to-top d-flex align-items-center justify-content-center">
<i class="bi bi-arrow-up-short">
    </i></a>
</main><!-- End #main -->






</template>
