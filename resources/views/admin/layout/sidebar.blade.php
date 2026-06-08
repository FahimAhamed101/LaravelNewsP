<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        @php
            $admin = Auth::guard('admin')->user();
        @endphp

        <div id="sidebar-menu">
            <ul id="side-menu">
                <li><a href="{{ route('admin-dashboard') }}"><i class="mdi mdi-view-dashboard-outline"></i><span> Dashboard </span></a></li>

                @if ($admin?->status)
                    <li>
                        <a href="#contentMenu" data-bs-toggle="collapse"><i class="mdi mdi-newspaper"></i><span> News Content </span><span class="menu-arrow"></span></a>
                        <div class="collapse" id="contentMenu">
                            <ul class="nav-second-level">
                                <li><a href="{{ route('news') }}">All News</a></li>
                                <li><a href="{{ route('news-create') }}">Add News</a></li>
                                <li><a href="{{ route('category') }}">Categories</a></li>
                                <li><a href="{{ route('subcategory') }}">Subcategories</a></li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#mediaMenu" data-bs-toggle="collapse"><i class="mdi mdi-image-multiple"></i><span> Media </span><span class="menu-arrow"></span></a>
                        <div class="collapse" id="mediaMenu">
                            <ul class="nav-second-level">
                                <li><a href="{{ route('banner') }}">Banners</a></li>
                                <li><a href="{{ route('photo') }}">Photo Gallery</a></li>
                                <li><a href="{{ route('photo-create') }}">Add Photo</a></li>
                                <li><a href="{{ route('video') }}">Video Gallery</a></li>
                                <li><a href="{{ route('video-create') }}">Add Video</a></li>
                                <li><a href="{{ route('live-tv') }}">Live TV</a></li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#engagementMenu" data-bs-toggle="collapse"><i class="mdi mdi-comment-multiple-outline"></i><span> Engagement </span><span class="menu-arrow"></span></a>
                        <div class="collapse" id="engagementMenu">
                            <ul class="nav-second-level">
                                <li><a href="{{ route('pending-reviews') }}">Pending Reviews</a></li>
                                <li><a href="{{ route('approved-reviews') }}">Approved Reviews</a></li>
                                <li><a href="{{ route('user-list') }}">Users</a></li>
                                <li><a href="{{ route('contact-list') }}">Contacts</a></li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#settingsMenu" data-bs-toggle="collapse"><i class="mdi mdi-cog-outline"></i><span> Settings </span><span class="menu-arrow"></span></a>
                        <div class="collapse" id="settingsMenu">
                            <ul class="nav-second-level">
                                <li><a href="{{ route('seo') }}">SEO</a></li>
                                <li><a href="{{ route('admin-all-list') }}">Admin Users</a></li>
                                <li><a href="{{ route('admin-create') }}">Add Admin</a></li>
                                <li><a href="{{ route('admin-profile') }}">Profile</a></li>
                                <li><a href="{{ route('admin-change-password') }}">Change Password</a></li>
                            </ul>
                        </div>
                    </li>
                @endif

                <li><a href="{{ route('user-home') }}" target="_blank"><i class="mdi mdi-web"></i><span> View Website </span></a></li>
                <li><a href="{{ route('admin-logout') }}"><i class="mdi mdi-logout"></i><span> Logout </span></a></li>
            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
</div>
