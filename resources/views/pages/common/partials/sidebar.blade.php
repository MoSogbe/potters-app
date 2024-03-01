<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item sidebar-category">
            <p>Navigation</p>
            <span></span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.index')}}">
                <i class="mdi mdi-view-quilt menu-icon"></i>
                <span class="menu-title">Dashboard</span>
                {{--<div class="badge badge-info badge-pill">2</div>--}}
            </a>
        </li>

  
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#promoDetails" aria-expanded="false" aria-controls="auth">
                <i class="mdi mdi-cloud-upload  menu-icon"></i>
                <span class="menu-title">Product Details</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="promoDetails">
             @if(auth()->check())
           
                <ul class="nav flex-column sub-menu">
               
                  
                   
                    <li class="nav-item"><a class="nav-link" href="{{route('dashboard.upload.products')}}"> Upload Products</a>
                    </li>
                   
                    <li class="nav-item"><a class="nav-link" href="{{route('dashboard.uploaded.products')}}">
                            Product List </a></li>
                            
                   
                          
                </ul>

             
        @endif
                
            </div>
        </li>


      
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="mdi mdi-account menu-icon"></i>
                        <span class="menu-title">Manage Users</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="auth">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{route('dashboard.users')}}"> User List </a>
                            </li>
                        </ul>
                    </div>
                </li>
            

         
      
    </ul>
</nav>
