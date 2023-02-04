<div data-simplebar class="h-100">


    <div class="user-sidebar text-center">
        <div class="dropdown">
            <div class="user-img">
                <img src="{{asset('templet')}}/assets/images/profile.jpg" alt="" class="rounded-circle">
                <span class="avatar-online bg-success"></span>
            </div>
            <div class="user-info">
                <h5 class="mt-3 font-size-16 text-white">{{ Auth::user()->name }}</h5>
                <span class="font-size-13 text-white-50">{{ Auth::user()->user_role }}</span>
            </div>
        </div>
    </div>



    <!--- Sidemenu  01ff70  -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">



            <li>
                <a href="{{route('home')}}" class="waves-effect">
                    <i class="dripicons-monitor"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- <li>
                <a href="{{ url('/') }}" class="waves-effect">
                    <i class="dripicons-home"></i>
                    <span>Home</span>
                </a>
            </li> --}}


        @if(auth()->user()->user_role == "Admin")
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="dripicons-device-tablet"></i>
                    <span>Outlet</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('add_outlet_view')}}">Add Outlet</a></li>
                    <li><a href="{{route('outlet_list')}}">Outlet List</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="dripicons-user"></i>
                    <span>User</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('add_user_view')}}">Add User</a></li>
                    <li><a href="{{route('user_list')}}">User List</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-user-tie"></i>
                    <span>Employee</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('add_employe_view')}}">Add Employee</a></li>
                    <li><a href="{{route('employe_list')}}">Employee List</a></li>
                </ul>
            </li>


            @if(false)
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="dripicons-user-group"></i>
                    <span>Customer</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('add_customer_view')}}">Add Customer</a></li>
                    <li><a href="{{route('customer_list')}}">Customer List</a></li>
                </ul>
            </li>
            @endif

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="dripicons-shopping-bag"></i>
                    <span>Purchase</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('add_purchase_view')}}">Add Purchase</a></li>
                    <li><a href="{{route('purchase_list')}}">Purchase List</a></li>
                </ul>
            </li>


            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="dripicons-wallet "></i>
                    <span>Expense</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('add_expense_view')}}">Add Expense</a></li>
                    <li><a href="{{route('expense_list')}}">Expense List</a></li>
                </ul>
            </li>
            @endif
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="dripicons-archive"></i>

                    <span>Product</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    @if(auth()->user()->user_role == "Admin")
                        <li><a href="{{route('add_product_view')}}">Add Product</a></li>
                        <li><a href="{{route('product_list')}}">Total Stock</a></li>
                    @endif
                    <li><a href="{{route('product_in_stock')}}">Outlet Stock</a></li>
                    <li><a href="{{route('shift_product')}}">Shift Products</a></li>
                    <li><a href="{{route('shift_request_page')}}">Shifting Request</a></li>
                    <li><a href="{{route('pending_product')}}">Pending Products</a></li>
                </ul>
            </li>


            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="dripicons-cart"></i>
                    <span>Sales</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('add_sales_for_employe')}}">Sales to Employee</a></li>
                    <li><a href="{{route('add_sales_for_customer')}}">Sales to Customer</a></li>
                    <li><a href="{{route('seles_list')}}">Sales List</a></li>
                    <li><a href="{{route('invoice_view')}}">Invoices</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="dripicons-wallet"></i>
                    <span>Account</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('due_adjustment')}}">Due Adjustment</a></li>
                    <li><a href="{{route('payment_history')}}">Payment History</a></li>
                </ul>
            </li>


        </ul>
    </div>
    <!-- Sidebar -->
</div>
