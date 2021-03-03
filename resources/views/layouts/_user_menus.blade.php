
<div class="px-3 py-1 bg-white text-dark font-weight-bold">
  Business Dashboard
</div>

  <li>
    <a href="{{url('posts')}}"><i class="fas fa-calendar-alt"></i>
      Posts</a>
  </li>
  <li>
      <a href="{{url('myfirms')}}"> <i class="fas fa-briefcase"></i>
        My Businesses</a>
  </li>
  <li>
      <a href="{{url('social_networks')}}"> <i class="fab fa-facebook-square"></i>
        Social Media</a>
  </li>
  <li>
      <a href="#sub_menus" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="far fa-user"></i>
        My Account</a>
      <ul class="collapse list-unstyled" id="sub_menus">
          <li>
              <a href="{{route('profile')}}"> <i class="far fa-user"></i> Profile</a>
          </li>
          <li>
              <a href="{{route('myplans')}}"><i class="fas fa-rupee-sign"></i> Active Plans</a>
          </li>
          <li>
              <a href="#"><i class="fas fa-donate"></i> Wallet</a>
          </li>
          <!-- <li>
              <a href="#"><i class="fas fa-cog"></i> Settings</a>
          </li> -->
      </ul>
  </li>
