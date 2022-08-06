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
                              <h1 class="h4 text-gray-900 mb-4">Add Topic</h1>
                           </div>
                           <form class="user" @submit.prevent="submit">
                              <div class="form-group row mb-3">
                                 <div class="col-sm-12 mb-3 mb-3">
                                    <input type="text" class="form-control form-control-user" v-model="form.name" placeholder="Enter your Topic">
                                    <div v-if="errors && errors.name" class="font-medium text-red-600">{{ errors.name[0] }}</div>
                                    </div>

                              </div>
                              <div class="form-group row">

                                 <div class="col-sm-6">
                                   <button :type="submit" class="btn btn-primary btn-user btn-block">
                                    Add Topic
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
     data() {
        return {
          form:{
                    name:'',
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
              axios.post('topic/create',this.form)
              .then(res=>{
                  console.log(res);
                  this.form={};
                  Toast.fire({
                    icon:'success',
                    title:'Topic is Added !'
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

