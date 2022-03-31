<template>
   <div>
      <form @submit.prevent="submit">
         <label for="fname"> Name:</label>
         <input type="text" id="fname" v-model="form.name"><br>

         <label for="fname"> Select Gender:</label><br>

         <label for="html">MALE</label>
         <input type="radio" id="html" value="male" v-model="form.gender" :checked="detail.gender === 'male'"><br>

         <label for="css">FEMALE</label>
         <input type="radio"  name="gender"  id="css" v-model="form.gender" value="female" :checked="detail.gender === 'female'"><br>

         <label for="cars">Multi Select Hobbies:</label>
         <select v-model="form.hobbies" id="hobbies" multiple>
            <option value="dancing">Dancing</option>
            <option value="singing">Singing</option>
            <option value="playing">Playing</option>
         </select>
         <br>

         <label for="cars">DOB:</label>
         <input type="date"  v-model="form.dob" ><br>

         <select v-model="form.city" id="cars">
            <option value="Carnival">Carnival</option>
            <option value="Mojo">Mojo</option>
            <option value="Vakao">Vakao</option>
         </select>
         <br>

          <img :src="'/storage/' + this.detail.image" alt="">
          <input type="file" ref="file">
         <br>
         <input type="submit" value="Click Here">
      </form>
   </div>
</template>
<script>

   import axios from 'axios'
   export default {
         props: {
            'detail': {},
         },
         data() {
               return {

                   form:  {
                       name: this.detail.name,
                       gender: this.detail.gender,
                       hobbies: this.detail.hobbies,
                       dob: this.detail.dob,
                       city: this.detail.city,
                       '_token':document.querySelector('meta[name="csrf-token"]').content
                   }
                }

           },
             methods: {

                 submit: function () {
                     let formData = new FormData();
                     formData.append('name', this.form.name);
                     formData.append('gender', this.form.gender);
                     formData.append('hobbies', this.form.hobbies);
                     formData.append('dob', this.form.dob);
                     formData.append('city', this.form.city);
                     if (this.$refs.file.files[0]) {
                         formData.append('image', this.$refs.file.files[0]);
                     }

                     axios.post('/update/' + this.detail.id, formData, {
                         headers: {
                             'Content-Type': 'multipart/form-data'
                         },
                     });
                 },
       },

   }
</script>
