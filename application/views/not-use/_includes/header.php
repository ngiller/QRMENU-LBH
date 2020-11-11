    <?php date_default_timezone_set($this->session->timezone); ?>
    
    <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="/menu/category"><img src="<?php echo base_url('assets/img/logo-black.png'); ?>" alt=""></a>
            </div>
            <div class="mb-2">
                <h5><?php echo $this->session->outletname; ?></h5>
            </div>
            <hr>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li class="<?php echo ($nav_index == 1)? 'active' : ""; ?>"><a href="/menu/category">Home</a></li>
                    <!--<li><a href="menu-w-cat.html">Favourite Menus</a></li>
                    <li><a href="menu-w-cat.html">Chef Recomend</a></li>
                    <li><a href="menu-w-cat.html">Special Menus</a></li>-->
                    <li class="<?php echo ($nav_index == 2)? 'active' : ""; ?>"><a href="/menu/all">All Menus</a></li>
                    <li><hr></li>
                    <?php foreach ($menucat_list as $menucat) { 
                    ?>    
                        <li class="<?php echo ($menucat->id == $menucatid)? 'active' : ""; ?>"><a href="/menu/item/<?php echo $menucat->id; ?>"><?php echo $menucat->name; ?></a></li>
                    <?php } ?>
                    <?php 
                        if (!empty($this->session->guestid)) {
                    ?>
                    <li><hr></li>
                    <li class="<?php echo ($nav_index == 3)? 'active' : ""; ?>"><a href="/history">Order History</a></li>
                    <?php
                        }
                    ?>
                </ul>
            </nav>
            
            <!-- Cart Menu -->
            <!--<div class="cart-fav-search mb-100">
                <a href="cart.html" class="cart-nav"><img src="img/core-img/cart.png" alt=""> Cart <span>(0)</span></a>
                <a href="#" class="fav-nav"><img src="img/core-img/favorites.png" alt=""> Favourite</a>
                <a href="#" class="search-nav"><img src="img/core-img/search.png" alt=""> Search</a>
            </div>-->
            
        </header>