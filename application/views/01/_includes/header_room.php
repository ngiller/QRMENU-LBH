<header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <?php echo $this->session->outletoriginid; if ($this->session->outletoriginid == -1) { ?>
                    <a href="/room/show/<?= $this->session->tableno; ?>"><img src="<?php echo base_url('assets/img/logo-black.png'); ?>" alt=""></a>
                <?php } else { ?>
                    <a href="/menu/category"><img src="<?php echo base_url('assets/img/logo-black.png'); ?>" alt=""></a>
                <?php } ?>
            </div>
            <nav class="amado-nav">
                <ul>
                    <li class="<?php echo ($nav_index == 1)? 'active' : ""; ?>"><a href="/room/show/">Home</a></li>
                    <li><hr></li>
                    <?php foreach ($outlet_data as $outlet) { 
                        if ($outlet->code == 999) {
                            $link = "/page/room_directory";
                        } else {
                            $link = "/room/to_outlet/".$outlet->id;
                        }
                    ?>    
                        <li><a href="<?php echo $link; ?>"><?php echo $outlet->name; ?></a></li>
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
            
        </header>