 <template>
       <header-componant />
      <section class="taskSection pt-4 pb-4">
         <div class="container">
            <div class="card my-5 border-0">
               <div class="card-body p-0">
                  <!-- Nested Row within Card Body -->
                  <div class="row">
                     <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                     <div class="col-lg-6 offset-lg-3 o-hidden  shadow">
                        <div class="p-5">
                           <div class="text-center">
                              <h1 class="h4 text-gray-900 mb-4">Add Course Speaker</h1>
                           </div>
                           <form class="user" @submit.prevent="submit">
                              <div class="form-group row mb-3">

                                  <div class="col-sm-12 mb-3 mb-3">
                                  <select class="form-control form-control-user" v-model="form.course" aria-label="Default select example">
            <option value="">Please Select Course</option>
             <option v-for="coursedata in course" :key="coursedata.id" :value="coursedata.id">{{coursedata.name}} </option>
          </select></div>
           <div class="col-sm-12 mb-3 mb-3">
            <select class="form-control form-control-user" v-model="form.speaker" aria-label="Default select example">
            <option value="">Please Select Speaker</option>
             <option v-for="speakerdata in speaker" :key="speakerdata.id" :value="speakerdata.id">{{speakerdata.name}} </option>
          </select>

                                       </div>
                                       </div>
                              <div class="form-group row">

                                 <div class="col-sm-6">
                                   <button :type="submit" class="btn btn-primary btn-user btn-block">
                                    Add Course Speaker
                                    </button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
</template>
<script>
import Header from '@/Pages/Header.vue'
 export default({
     props: {
    course: {},
    speaker: {},
  },
     data() {
        return {
          form:{
                    course:'',
                    speaker:'',
                },
                errors:{},
        }
    },
      components: {
       HeaderComponant: Header,
    },
    methods: {
           submit() {
              this.errors = {};
              axios.post('course-speaker/create',this.form)
              .then(res=>{
                  console.log(res);
                  this.form={};
                  Toast.fire({
                    icon:'success',
                    title:'Course is Added !'
                 })
              }).catch((error) => {
                  this.errors = error.response.data.errors
             });
           },
            logout()
            {
                this.$inertia.post(route('logout'));
            }
            }
       })
</script>

