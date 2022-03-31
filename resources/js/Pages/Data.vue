<template>
   <div>
      <form @submit.prevent="submit">
         <label for="fname"> Name:</label>
         <input type="text" id="fname" v-model="form.name"><br>

         <label for="fname"> Select Gender:</label><br>

         <label for="html">MALE</label>
         <input type="radio" id="html" name="gender" value="male" v-model="form.gender"><br>

         <label for="css">FEMALE</label>
         <input type="radio"  name="gender"  id="css" v-model="form.gender" value="female"><br>

         <label for="cars">Multi Select Hobbies:</label>
         <select v-model="form.hobbies" id="cars" multiple>
            <option value="dancing">Dancing</option>
            <option value="singing">Singing</option>
            <option value="playing">Playing</option>
         </select>
         <br>

         <label for="cars">DOB:</label>
         <input type="date"  v-model="form.dob" ><br>

         <select v-model="form.city" id="cars" >
            <option value="Carnival">Carnival</option>
            <option value="Mojo">Mojo</option>
            <option value="Vakao">Vakao</option>
         </select>
         <br>


          <input type="file" ref="file">
         <br>
         <input type="submit" value="Click Here">
      </form>
   </div>
</template>
<script>

   import axios from 'axios'
   export default {
         data() {
               return {

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

             submit() {
                 let formData = new FormData();
                 formData.append('name', this.form.name);
                 formData.append('gender', this.form.gender);
                 formData.append('hobbies', this.form.hobbies);
                 formData.append('dob', this.form.dob);
                 formData.append('city', this.form.city);
                 if (this.$refs.file.files[0]) {
                     formData.append('image', this.$refs.file.files[0]);
                 }

                 axios.post('/store', formData, {
                     headers: {
                         'Content-Type': 'multipart/form-data'
                     },
                 }).then(res=>{
                     console.log(res.data);
                 });
             },
       },

   }
</script>
