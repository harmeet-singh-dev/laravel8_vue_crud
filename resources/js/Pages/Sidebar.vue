<template>
    <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
        <div class="mobile-sidebar-header d-md-none">
            <div class="header-logo">
                <a href="/dashboard"><img src="/custom_folder/img/logo1.png" alt="logo"></a>
            </div>
        </div>
        <div class="sidebar-menu-content">
            <ul class="nav nav-sidebar-menu sidebar-toggle-view">



    <div class="sidebar-menu-content">
            <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="flaticon-dashboard"></i><span>Topic</span></a>
  <ul class="nav sub-group-menu" >

                        <li class="nav-item" v-for="data in topic" :key="data.id">
                            <label class="form-check-label" >{{data.name}}</label>
                            <input class="nav-link" type="checkbox" :value="data.id"

                            @change="onChange(data.id,$event.target.checked)">

                        </li>
                   </ul>
               </li>
            </ul>
        </div>



            </ul>
        </div>
    </div>
</template>


<script>

</script>
