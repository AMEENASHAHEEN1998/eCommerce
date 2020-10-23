<nav  class="navbar navbar-inverse navbar-expand-sm bg-dark navbar-dark" >
  <div class="container" >
    <div class="navbar-header" >
      
      <a class="navbar-brand" href="dashpored.php"><?php echo lang('AdminArea')?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav">
    <span class="navbar-toggler-icon"></span>
  </button>
    </div>

    <div class="collapse navbar-collapse ulli" id="app-nav" >
      
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link " href="categories.php"><?php echo lang('Categories')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="item.php"><?php echo lang('Items')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="member.php"><?php echo lang('Members')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="comment.php"><?php echo lang('Comments')?></a>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link  " href="#"><?php echo lang('Statistic')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="#"><?php echo lang('Logs')?></a>
        </li>-->
      </ul>
      
      <ul class="nav navbar-nav navbar-right hoverNav " style="margin-left : 50%" >   
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" style="color:#fff" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo lang('userName')?> </a>
          <ul class="dropdown-menu">
            <li><a href="member.php?do=Edit&userid=<?php echo $_SESSION['ID']?>"><?php echo lang('EditProfile')?></a></li>
            <li><a href="#"><?php echo lang('Settings')?></a></li>
            <li><a href="logout.php"><?php echo lang('Logout')?></a></li>
            
          </ul>
        </li>
      </ul>
      
    </div>
  </div>
</nav>

