<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href=""><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{Lang::get('all.dashboard',[],getCurrentLang())}} </span></a>
            </li>

            <li class="nav-item  open ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{Lang::get('all.courses',[],getCurrentLang())}}</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\CourseType::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.courses')}}"
                                          data-i18n="nav.dash.ecommerce"> {{Lang::get('all.all courses',[],getCurrentLang())}} </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.courses.create')}}" data-i18n="nav.dash.crypto">{{Lang::get('all.Add Course',[],getCurrentLang())}}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{Lang::get('all.control panel',[],getCurrentLang())}} </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.users.index')}}"
                                          data-i18n="nav.dash.ecommerce">{{Lang::get('all.all Users',[],getCurrentLang())}}</a>
                    </li>

                    <li><a class="menu-item" href="{{route('admin.users.create')}}" data-i18n="nav.dash.crypto">{{Lang::get('all.Add Users',[],getCurrentLang())}}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
