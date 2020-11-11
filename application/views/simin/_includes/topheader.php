<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

						<!-- begin:: Header Menu -->
						<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
						<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper" style="width:70%;">
							<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default " style="width:100%;">	
										<form class="form-select-property">
											<div class="row">
												<?php
													if ($this->session->id == 1) {
												?>
												<label class="col-2 label-select-property text-left">Property</label>
												<div class="col-6">
													
													<select class="form-control" id="select_property">
														<?php foreach($select_data->result() as $row):?>
															<option value="<?php echo $row->id; ?>" <?php echo ($row->id == $this->session->propertyid) ? ' selected' : ''; ?>><?php echo $row->name;?></option>
															
														<?php endforeach;?>
													</select>
												</div>												
												<?php 
													}  else { 
												?>
													<div class="col-8">
														<div class="label-select-property">Property : <?php echo $this->session->propertyname; ?></div>
													</div>
												<?php
														}
												?>																									
											</div>
											
										</form>
									
							</div>
						</div>
		

						<!-- end:: Header Menu -->

						<!-- begin:: Header Topbar -->
						<div class="kt-header__topbar">
							<!--begin: User Bar -->
							<div class="kt-header__topbar-item kt-header__topbar-item--user">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
									<div class="kt-header__topbar-user">
										<span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
										<span class="kt-header__topbar-username kt-hidden-mobile"><?php echo ucfirst(strtolower($this->session->userdata("uname"))); ?></span>

										<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
										<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"><?php echo substr(ucfirst($this->session->userdata("uname")), 0, 1); ?></span>
									</div>
								</div>
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

									<!--begin: Head -->
									<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(<?php echo base_url('assets/media/misc/bg-1.jpg');?>)">
										<div class="kt-user-card__avatar">
											<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
											<span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success"><?php echo substr(ucfirst($this->session->userdata("uname")), 0, 1); ?></span>
										</div>
										<div class="kt-user-card__name">
										<?php echo ucfirst(strtolower($this->session->userdata("uname"))); ?>
										</div>										
									</div>

									<!--end: Head -->

									<!--begin: Navigation -->
									<div class="kt-notification">
										<!--<a href="#" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-calendar-3 kt-font-success"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title kt-font-bold">
													My Profile
												</div>
												<div class="kt-notification__item-time">
													Account settings and more
												</div>
											</div>
										</a>-->
																			
										<div class="kt-notification__custom">
											<a href="/simin/signout" class="btn btn-label-brand btn-sm btn-bold">Sign Out</a>
										</div>
									</div>

									<!--end: Navigation -->
								</div>
							</div>

							<!--end: User Bar -->
						</div>

						<!-- end:: Header Topbar -->
					</div>

					<!-- end:: Header -->