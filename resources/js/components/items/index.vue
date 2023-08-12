
<script setup>
import Sidebar from '../sidebar/index.vue'
import {onMounted, ref} from 'vue'

let itemMasters = ref([])
let itemname = ref([])
let price = ref([])
let stock = ref([])

onMounted(async () => {
    getItemMaster()
})

const getItemMaster = async() => {
    let response = await axios.get("/api/getItemMaster",{
        headers: {
            Authorization: `Bearer ${localStorage.getItem('usersession')}`
        }
    });
    console.log('response', response)
    itemMasters.value = response.data.items
}

const searchItem = async() => {
    let response = await axios.get("/api/searchItem?s="+searchItemText.value, {
        headers: {
            Authorization: `Bearer ${localStorage.getItem('usersession')}`
        }
    });
    console.log('response', response)
    itemMasters.value = response.data.items
}

const save = async() => {
    const item = {
        name : itemname.value,
        price : price.value,
        stock : stock.value,
    }
 
    try {
    const response = await axios.post('/api/items', item, {
        headers: {
            Authorization: `Bearer ${localStorage.getItem('usersession')}`
        }
    });
    alert(response.data.message);
    itemname.value = ""
    price.value = ""
    stock.value = ""
    searchItem();
    return response.data;
  } catch (error) {
    console.error(error);
    alert('Failed to store item');
  }
  searchItem();
  this.$refs.anyName.reset();
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
      <li class="breadcrumb-item active">Item master</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Item master</h5>

                <!-- General Form Elements -->
                <form>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Item name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" v-model="itemname">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" v-model="price">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Stock</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" v-model="stock">
                    </div>
                </div>
                
                    <button type="button" name="submit" id="submit" class="btn btn-sm btn-primary " @click="save()">Submit</button>
                 

                
                </form><!-- End General Form Elements -->

            </div>
        </div>

</div>

<div  class="col-lg-6" style="height: 400px; overflow-y: scroll;">
       <!-- Table with hoverable rows -->
       <input type="text" class="form-control" name="searchItemText" id="searchItemText" placeholder="Search" v-model="searchItemText" @keyup="searchItem()" />
       <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <!-- <th scope="col">Action</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in itemMasters" :key="item.id" v-if="itemMasters.length > 0" >
                    <th scope="row">{{ item.id }}</th>
                    <th>{{ item.name }}</th>
                    <td>{{ item.price }}</td>
                    <td>{{ item.stock }}</td>
                    <!-- <td> 
                        <a class="btn btn-sm btn-primary">Edit</a>
                        <a class="btn btn-sm btn-danger">Delete</a>
                    </td> -->
                     
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
