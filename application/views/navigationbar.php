<!--
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
-->
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'bn,en,es,fr,gu,hi,ja,nl,pa,pt,zh-CN', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<div class="top1 clearfix">
<header><div class="logo_wrapper log"><a href="<?php echo base_url(); ?>" class="logo"><img src="<?php echo base_url(); ?>assets/images/logoo.png" alt=""></a></div></header>
<div class="top2 clearfix">
<div class="search-form-wrapper clearfix">
	<div style="display:inline-block;margin:5px;visibility:hidden">
		info
	</div>
	<div style="display:inline-block;float: right">
	<div class="text-right" id="google_translate_element">
	</div>
	</div>
</div>
	
<div class="menu_wrapper clearfix">
<div class="navbar navbar_">
	<div class="navbar-inner navbar-inner_">
		<a class="btn btn-navbar btn-navbar_" data-toggle="collapse" data-target=".nav-collapse_">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		<div class="nav-collapse nav-collapse_ collapse">
			<ul class="nav sf-menu clearfix">
<li <?php if($this->uri->segment(1)==""){echo 'class="active"';}?>><a href="<?php echo base_url(); ?>">home</a></li>
<li <?php if($this->uri->segment(1)=="about-us"){echo 'class="active"';}?>><a href="<?php echo base_url().'about-us.html'; ?>">about us</a></li>
<li class="<?php if($this->uri->segment(1)=="domestic-packages" || $this->uri->segment(1) == 'packages'){echo 'active ';} else if($this->uri->segment(1)=="international-packages" || $this->uri->segment(1) == 'packages'){echo 'active ';}?>sub-menu sub-menu-1"><a href="#">package</a>
		<ul>
			<li><a href="<?php echo base_url().'domestic-packages.html'; ?>">Domestic package</a></li>	
			<li><a href="<?php echo base_url().'international-packages.html'; ?>">International package</a></li>						
		</ul>						
</li>
<li class="<?php if($this->uri->segment(1)=="spe-dom-package"){echo 'active ';} else if($this->uri->segment(1)=="spe-int-packages"){echo 'active ';}?>sub-menu sub-menu-1"><a href="#">special package</a>
		<ul>
			<li><a href="<?php echo base_url().'spe-dom-package.html'; ?>">Special Domestic package</a></li>	
			<li><a href="<?php echo base_url().'spe-int-package.html'; ?>">Special International package</a></li>						
		</ul>						
</li>
<li <?php if($this->uri->segment(1)=="brochure"){echo 'class="active"';}?>><a href="<?php echo base_url().'brochure.html'; ?>">Brochure</a></li>											
<li <?php if($this->uri->segment(1)=="gallery"){echo 'class="active"';}?>><a href="<?php echo base_url().'gallery.html'; ?>">gallery</a></li>											
<li <?php if($this->uri->segment(1)=="contacts"){echo 'class="active"';}?>><a href="<?php echo base_url().'contacts.html'; ?>">contacts</a></li>	
			</ul>
		</div>
	</div>
</div>	
</div>
</div>	
</div>