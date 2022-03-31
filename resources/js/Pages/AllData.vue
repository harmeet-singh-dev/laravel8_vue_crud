<template>
   <div>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                 <th>Name</th>
                  <th>City</th>
                   <th>Modify</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(data,index) in allData" :key="index" >
                <td>{{data.id}}</td>
                <td>{{data.name}}</td>
                <td>{{data.city}}</td>
                <td>
                    <button @click.prevent="edit(data.id)" class="px-5 text-indigo-900 bg-indigo-300">Edit</button>
                </td>
            </tr>
        </tbody>
    </table>

   </div>
</template>
<script>

   import axios from 'axios'
   export default {
       props:{
            'allData':{}
       },
         data() {
               return {
                  showForm:true,
                   form:  {
                       name: '',
                       gender: '',
                       hobbies: [],
                       dob: '',
                       city: '',
                       image:'',
                       '_token':document.querySelector('meta[name="csrf-token"]').content
                   }
                }

           },
             methods: {
                 edit(id){
                     window.location.href = '/update/' + id
                 },

             submit() {
              axios.post('update',this.form)
               .then(res=>{
                 console.log(res.data);
               })
           },
       },

   }
</script>
