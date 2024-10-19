
    <div class="app-sidebar__user">
        <img height="50px;" class="app-sidebar__user-avatar" src="{{asset('admin/images/admin.png')}}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name text-dark">{{getAuthUser()->full_name}}</p>
            <p class="app-sidebar__user-designation text-dark">{{getAuthUser()->manager_id ? 'Employee' : 'Manager'}}</p>
        </div>
    </div>
    <ul class="app-menu">
        @if(getAuthUser()->manager_id == null)
        <li>
            <a class="app-menu__item {{isNavbarActive('home')}}" href="{{route('home')}}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">{{__('Dashboard')}}</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{isNavbarActive('departments*')}}" href="{{route('departments.index')}}">
                <i class="app-menu__icon fa fa-sitemap"></i>
                <span class="app-menu__label">{{__('Departments')}}</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{isNavbarActive('employees*')}}" href="{{route('employees.index')}}">
                <i class="app-menu__icon fa fa-users"></i>
                <span class="app-menu__label">{{__('Employees')}}</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{isNavbarActive('tasks*')}}" href="{{route('tasks.index')}}">
                <i class="app-menu__icon fa fa-tasks"></i>
                <span class="app-menu__label">{{__('Tasks')}}</span>
            </a>
        </li>
        @else
            <li>
                <a class="app-menu__item {{isNavbarActive('my-tasks*')}}" href="{{route('my_tasks')}}">
                    <i class="app-menu__icon fa fa-tasks"></i>
                    <span class="app-menu__label">{{__('My Tasks')}}</span>
                </a>
            </li>
        @endif
    </ul>



