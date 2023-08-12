<script setup>
import Sidebar from '../sidebar/index.vue'
import {onMounted, ref} from 'vue'

 
let username = ref([])
let password = ref([])

onMounted(async () => {
   
    logout();
    
})

 
 

const logout = async() => {
    const cred = {
       'logout' : 'true'
    }
 
    try {
    const response = await axios.post('/api/logout', cred, {
        headers: {
            Authorization: `Bearer ${localStorage.getItem('usersession')}`
        }
    });
 
    localStorage.removeItem('usersession');
    window.location="/login"
    return response.data;
  } catch (error) {
    console.error(error);
    alert(error.response.data.message);
   
   
  }
  
}

</script>