<template>
 <header-componant />

 <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
<sidebar-componant />

    <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
        <div class="mobile-sidebar-header d-md-none">
            <div class="header-logo">
                <a href="index.html"><img src="/custom_folder/img/logo1.png" alt="logo"></a>
            </div>
        </div>


    </div>


            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Task</h3>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->

                <div class="content">
                    <div class="row gutters-20">

                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-12" v-for="getdata in coursedata" :key="getdata.id">
                                        <div class="title">
                                            <h3>{{getdata[0].name}}</h3>
                                        </div>
                                        <div class="description">
                                            <p></p>
                                        </div>
                                        <div class="text-right">
                                            <p><small><b>Price: {{getdata[0].price_range}}</b></small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

       </div>

</template>

<script>

    import Header from '@/Pages/Header.vue'
    import Sidebar from '@/Pages/Sidebar.vue'
import axios from 'axios';

    export default {
        props:{
           topic:{},
        },
        components: {
            'HeaderComponant': Header,
             'SidebarComponant': Sidebar,
        },
         data() {
        return {
          coursedata:{}
        }
    },
        methods: {
           onChange(id, checked, type) {
            //set data type and value
            const data = {};
            data[type] = checked;



            axios.post(`/topic/search/${id}`)
        .then((res) => {

          this.coursedata = res.data;
            });
        }
        },
    }
</script>

<style scoped>
.dashboard-page-one {
    min-height: 91vh;
}
.content {
    min-height: 62vh;
}
</style>
