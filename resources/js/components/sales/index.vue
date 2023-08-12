<script setup>
   import Sidebar from '../sidebar/index.vue'
   import {onMounted, ref} from 'vue'
   
   let itemMasters = ref([])
   let salesData = ref([])
   let customer = ref()
   let bill_date = ref()
   let bill_no = ref()
   let mobile = ref()
 
   
   onMounted(async () => {
       getItemMaster()
   })
   
   const getItemMaster = async() => {
       let response = await axios.get("/api/getItemMaster", {
        headers: {
            Authorization: `Bearer ${localStorage.getItem('usersession')}`
        }
    })
       console.log('response', response)
       itemMasters.value = response.data.items
   }
   

 


   
</script>
<template>
   <main id="main" class="main">
   <Sidebar/>
      <div class="pagetitle">
         <h1>Sales</h1>
         <nav>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="/home">Home</a></li>
               <li class="breadcrumb-item">Pages</li>
               <li class="breadcrumb-item active">Sales</li>
            </ol>
         </nav>
      </div>
      <!-- End Page Title -->
      <section class="section">
        <div class="row">
            <div class="col-lg-6">

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Customer  </h5>

    <!-- General Form Elements -->
    <form>
      <div class="row mb-3">
        <label for="inputText" class="col-sm-2 col-form-label">  Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="customer_name" v-model="customer"  />
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputEmail" class="col-sm-2 col-form-label">Mobile</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" v-model="mobile" id="mobile" />
        </div>
      </div>
    
 
       
      

    </form><!-- End General Form Elements -->

  </div>
</div>

</div>
<div class="col-lg-6">

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Bill Details</h5>

    <!-- General Form Elements -->
    
    <div class="row mb-3">
        <label for="inputDate" class="col-sm-2 col-form-label">Bill No</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" v-model="bill_no" id="bill_no">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputDate" class="col-sm-2 col-form-label">Bill Date</label>
        <div class="col-sm-10">
          <input type="date" class="form-control" v-model="bill_date" id="bill_date" />
        </div>
      </div>
     
       
      

    

  </div>
</div>

</div>
             
        </div>
        <hr>
         <div class="row">
            <div  class="col-lg-12">
               
               <button class="btn btn-sm btn-primary" @click="addTextbox"> <i class="bi bi-plus"></i>Add More</button>
               <!-- Table with hoverable rows -->
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item </th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr v-for="(textbox, index) in textboxes" :key="index">
                        <td>{{ index+1 }}</td>
                        <td>
                           <select name="itmselect" class="itmselect form-control" :index="index" @change="itemchange(index);">
                              <option>Select</option>
                              <option :value="item.id" :price="item.price"  v-for="item in itemMasters" :key="item.id" v-if="itemMasters.length > 0" >
                                 {{ item.name }} 
                              </option>
                           </select>
                        </td>
                        <td>
                           <input type="text" class="form-control" readonly  :id="textbox.txtboxname" v-model="textbox.price" @keypress="calculate()" />
                        </td>
                        <td>  <input type="number" class="form-control"  :id="textbox.txtboxnameQty" v-model="textbox.qty" @keypress="calculate()"  @keydown="calculate()" @keyup="calculate()" @change="calculate()" @blur="calculate()" /> </td>
                        <td>
                           <button class="btn btn-sm btn-danger" @click="removeTextbox(index);"><i class="bi bi-trash"></i></button>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="3"> <label style="font-weight:bold">Total Amount</label></td>
                        <td style="font-weight:bold"> <input type="text" id="total" style="font-weight: bold;text-align: right;" class="form-control"  v-model="total" /> </td>
                     </tr>
                  </tbody>
               </table>

        
               <button @click="submitData()" style="float: right;" type="button" class="btn btn-lg btn-success">Submit</button>
               <!-- End Table with hoverable rows -->
            </div>
         </div>
      </section>
      <a href="/" class="back-to-top d-flex align-items-center justify-content-center">
   <i class="bi bi-arrow-up-short">
   </i></a>
   </main>
   <!-- End #main -->
   
</template>
<script>
   var total = 0.00;
   let customer = ref()
   let salesData = ref([])
   
   let bill_date = ref()
   let bill_no = ref()
   let mobile = ref()
   export default {
    
     data() {
       
       return {
           
         textboxes: [{ value: '', qty : 1, id : 'price_1' }],
         textboxesQty: [{ value: '', qty : 1, id : 'qty_1' }],
       };
     },
     methods: {
       addTextbox() {
           let iindex = this.textboxes.length
           let txtboxname = "price_"+iindex
           let txtboxnameQty = "qty_"+iindex
           this.textboxes.push({ value: '', qty : 1, id : txtboxname, txtboxnameQty: txtboxnameQty, price: '' });
           salesData.value = this.textboxes
       },
       removeTextbox(index) {
         this.textboxes.splice(index, 1);
         this.calculate();
         salesData.value = this.textboxes
       },
       itemchange(index) {
           var options = event.target.options
           if (options.selectedIndex > -1) {
               var price = options[options.selectedIndex].getAttribute('price');
               var item_id = options[options.selectedIndex].getAttribute('value');
               this.textboxes[index].price = price
               this.textboxes[index].item_id = item_id
           }
         this.calculate();
         salesData.value = this.textboxes
       },
       calculate() {
      
               this.total = 0;
               let i = 0;
               let q = this.textboxes[i].qty;
               q = (q == undefined || q == "") ? 0 : q;
               for (i=0; i< this.textboxes.length; i++) {
                   this.total =  this.total + (this.textboxes[i].price * this.textboxes[i].qty);
               }
     
               if (this.total !== undefined) {
                   this.total = (this.total).toFixed(2);  
               }
            
       },
       qtyChange() {
           this.calculate();
       },
       async submitData() {
        const saleDetails = {
            customer : document.getElementById("customer_name").value,
            bill_date : document.getElementById("bill_date").value,
            mobile : document.getElementById("mobile").value,
            amount : document.getElementById("total").value,
            sale_items : this.textboxes
        }

         for(let j = 0; j<  this.textboxes.length; j++) {
            if (this.textboxes[j].item_id === undefined || this.textboxes[j].item_id == "") {
                alert("Please select item")
                return false;
            }
         }
        
        try {
            const response = await axios.post('/api/createSales', saleDetails, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usersession')}`
            }
            });
            alert(response.data.message)
            return response.data;
        } catch (error) {
            console.log(error.response.data);
            alert(error.response.data.message);
           
        }
   
 
       }
       
     }
   };

   
</script>