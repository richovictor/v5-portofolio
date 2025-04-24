<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{route('adminIndex.index')}}">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-apps">CRUD</li>

                <li>
                    <a href="{{route('adminIndex.user.index')}}" >
                        <i class="  bx bxs-file"></i>
                        <span data-key="t-ecommerce">User</span>
                    </a>
                </li>
            {{--
                <li>
                    <a href="{{route('admin.user.indexList')}}" >
                        <i class=" bx bx-laugh"></i>
                        <span data-key="t-ecommerce">User</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.report.index')}}" >
                        <i class=" bx bxs-report"></i>
                        <span data-key="t-ecommerce">Report</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.communities.index')}}" >
                        <i class=" bx bxs-group"></i>
                        <span data-key="t-ecommerce">Category</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.comment.index')}}" >
                        <i class=" bx bxs-message"></i>
                        <span data-key="t-ecommerce">Comment</span>
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="{{route('admin.role.index')}}" >
                        <i class=" bx bx-key"></i>
                        <span data-key="t-ecommerce">Roles</span>
                    </a>
                </li> --}}
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
