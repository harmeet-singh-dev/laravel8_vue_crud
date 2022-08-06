<template>
 <header>
         <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Offcanvas navbar large">
            <div class="container-fluid">
               <a class="navbar-brand" href="dashboard">Task Details</a>
               <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="offcanvas offcanvas-end text-white bg-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
                  <div class="offcanvas-header">
                     <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Task Details</h5>
                     <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body">
                     <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                           <a class="nav-link" :href="route('topic')">Add Topic</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" aria-current="page" :href="route('speaker')">Add Speaker</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" aria-current="page" :href="route('course')">Add Course</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" aria-current="page" :href="route('course-speaker')">Add Course Speaker</a>
                        </li>
                         <li class="nav-item dropdown profileLogin ms-lg-4">
                              <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button">
                                    Log Out
                                </jet-responsive-nav-link>
                            </form>


                         </li>
                     </ul>
                  </div>
               </div>
            </div>
         </nav>
      </header>
      </template>
      <script>
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
 export default({
  components: {
            JetResponsiveNavLink,
        },
    methods: {

            logout()
            {
                this.$inertia.post(route('logout'));
            }
            }
       })
      </script>
