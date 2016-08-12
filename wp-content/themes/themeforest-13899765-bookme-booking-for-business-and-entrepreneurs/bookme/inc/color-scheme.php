<?php 
/*
 * Color Scheme
 * 
 */

global $bookme_option;
$color = '';
$site_color = $bookme_option['color_scheme'];
$general_page_color = get_post_meta(get_the_ID(), '_BookmeMB_general_page_color_scheme', true);
$page_color = get_post_meta(get_the_ID(), '_BookmeMB_page_color_scheme', true);
if ( $general_page_color ) { 
	$color = $general_page_color;
}elseif ( $page_color ) {
	$color = $page_color;
} elseif ( $site_color ) {
	$color = $site_color;
}

if ( $color != '' ) : ?>
<style type="text/css">

.sticky:after { 
	background: <?php echo esc_attr($color); ?>;
}

/*-----------------------------------------------*/
/*	Accounting	*/
/*-----------------------------------------------*/

.btn-one:hover,
.btn-one {
	background: <?php echo esc_attr($color); ?>;
}
#main-menu li.current-menu-item > a, #main-menu li.current-menu-parent > a{
	border-bottom-color:<?php echo esc_attr($color); ?> !important;
}

.btn-two:hover,
.btn-two {
	border: 1px solid <?php echo esc_attr($color); ?>;
}

.small-title{
	color: <?php echo esc_attr($color); ?>;
}

.dot:before {
	color: <?php echo esc_attr($color); ?>;
}

.logo-wrapper .dropdown .btn {
	color: <?php echo esc_attr($color); ?>;
}

#main-menu .nav-menu > li > a:hover{
	border-bottom-color: <?php echo esc_attr($color); ?>;
}

#main-slider .quote-form input[type="submit"] {
	background-color: <?php echo esc_attr($color); ?>;
}
#main-menu .children, #main-menu .sub-menu{
    background: <?php echo esc_attr($color); ?> !important;
}
#main-menu .children li a, #main-menu .sub-menu li{
    border-bottom-color: rgba(255,255,255, .5) !important;
}
#main-menu .children li, #main-menu .sub-menu li a{
    color: rgba(255,255,255, .8) !important;
}
#main-menu .children li, #main-menu .sub-menu li a:hover{
    color: #fff !important;
}

.services-item {
	background-color: <?php echo esc_attr($color); ?>;
}

.news-cat a {
	color: <?php echo esc_attr($color); ?>;
}

#facts .fa {
	background: <?php echo esc_attr($color); ?>;
}

.testimonials-quote {
	background: <?php echo esc_attr($color); ?>;
}

#navigations .breadcrumb {
	color: <?php echo esc_attr($color); ?>;
}

#navigations .breadcrumb > li + li:before {
	color: <?php echo esc_attr($color); ?>;
}

#navigations .breadcrumb > .active {
	color: <?php echo esc_attr($color); ?>;
}

.faqs-wrapper .question {
	background-color: <?php echo esc_attr($color); ?>;
}

#page-corporate-trainer #news .header-section .small-title {
	color: <?php echo esc_attr($color); ?>;
}

#page-movers .dot:before {
	color: <?php echo esc_attr($color); ?>;
}

#page-movers #news .btn-two {
	border-color: <?php echo esc_attr($color); ?>;
}

#page-movers #clients .small-title {
	color: <?php echo esc_attr($color); ?>;
}

#page-barber .dot:before {
	color: <?php echo esc_attr($color); ?>;
}

p.sub-title {
	color: <?php echo esc_attr($color); ?>;
}

.single-bookme_service .btn-two {
	color: <?php echo esc_attr($color); ?>;
}

.post-meta ul li a {
	color: <?php echo esc_attr($color); ?>;
	font-family: 'loraregular';
}

.page-content-wrapper .pagination > li > a,
.page-content-wrapper .pagination > li > span {
	border: 1px solid <?php echo esc_attr($color); ?>;
}

.page-content-wrapper .pagination > li > a:hover,
.page-content-wrapper .pagination > li > span:hover,
.page-content-wrapper .pagination > li > a:focus,
.page-content-wrapper .pagination > li > span:focus,
.page-content-wrapper .pagination > .active > a,
.page-content-wrapper .pagination > .active > span,
.page-content-wrapper .pagination > .active > a:hover,
.page-content-wrapper .pagination > .active > span:hover,
.page-content-wrapper .pagination > .active > a:focus,
.page-content-wrapper .pagination > .active > span:focus {
	background-color: <?php echo esc_attr($color); ?>;
	border-color: <?php echo esc_attr($color); ?>;
}

.post-cat a {
	color: <?php echo esc_attr($color); ?>;
}

.pager li > a,
.pager li > span {
	border: 1px solid <?php echo esc_attr($color); ?>;
}

.pager li > a:hover,
.pager li > a:focus {
	background-color: <?php echo esc_attr($color); ?>;
	border-color: <?php echo esc_attr($color); ?>;
}

.comment-author {
	border: 1px solid <?php echo esc_attr($color); ?>;
}

.comment-author h3 span {
	color: <?php echo esc_attr($color); ?>;
}

ol.comment-list div.comment-metadata a { color: <?php echo esc_attr($color); ?>; }

ol.comment-list div.reply a { border: 1px solid <?php echo esc_attr($color); ?>; }

.comment-form  input[type="submit"] { background-color: <?php echo esc_attr($color); ?>; }

.sidebar .widget ul {
	color: <?php echo esc_attr($color); ?>;
}

.single-bookme_service .widget .quote-form  .title {
	color: <?php echo esc_attr($color); ?>;
}

.single-bookme_service .widget .quote-form input[type="submit"] {
	background-color: <?php echo esc_attr($color); ?>;
}

.tagcloud a {
	border: 1px solid <?php echo esc_attr($color); ?>;
}

.tagcloud a:hover ,
.tagcloud a:focus ,
.tagcloud a.active ,
.tagcloud a.active:hover,
.tagcloud a.active:focus {
	background-color: <?php echo esc_attr($color); ?>;
	border-color: <?php echo esc_attr($color); ?>;
}

.error-404 .error-content ul li:before {
	color: <?php echo esc_attr($color); ?>;
}

.galleries .galleries-wrapper .fa {
	background-color: <?php echo esc_attr($color); ?>;
}

.cd-single-point.visited > a {
  background-color: <?php echo esc_attr($color); ?>;
}
.quote-form input[type="text"], .quote-form input[type="email"], .quote-form input[type="tel"], .quote-form .wpcf7-form-control{
    border-bottom-color: rgba(255,255,255, .3);
}
.widget form .selectBox-dropdown .selectBox-arrow:after, .quote-form .selectBox-dropdown .selectBox-arrow:after{
    color: rgba(255,255,255, .3);
}
.testimonials-entry .small-title{
    color: <?php echo esc_attr($color); ?>;
}
.bookme-phone h4:before{
    background: none!important;
    content:'\f095';
    font:23px FontAwesome;
    text-align: left;
}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{
   background: <?php echo esc_attr($color); ?>;
}
#searchform #s{
    border:1px solid <?php echo esc_attr($color); ?>;
}
/*-----------------------------------------------*/
/*	Therapy	*/
/*-----------------------------------------------*/

#page-therapy .dot:before {
	color: <?php echo esc_attr($color); ?>;
}

#page-therapy .small-title {
	color: <?php echo esc_attr($color); ?>;
}

#page-therapy .btn-one {
	background: <?php echo esc_attr($color); ?>;
}

#page-therapy .btn-two {
	border: 1px solid <?php echo esc_attr($color); ?>;
	color: <?php echo esc_attr($color); ?>;
}

#page-therapy #main-slider .owl-theme .owl-controls .owl-buttons div{
	background: <?php echo esc_attr($color); ?>;
}

#page-therapy #services .row>div:nth-child(2n+0) .services-item {
	background-color: <?php echo esc_attr($color); ?>;
}

#page-therapy  #facts .fa {
	background: <?php echo esc_attr($color); ?>;
}

/*-----------------------------------------------*/
/*	Attorney */
/*-----------------------------------------------*/

#page-attorney .dot:before {
	color: <?php echo esc_attr($color); ?>;
}

#page-attorney .small-title {
	color: <?php echo esc_attr($color); ?>;
}

#page-attorney .btn-one {
	background: <?php echo esc_attr($color); ?>;
	color: #fff;
}

#page-attorney .news-cat a {
	color: <?php echo esc_attr($color); ?>;
}

#page-attorney .services-item {
	background-color: <?php echo esc_attr($color); ?>;
}

#page-attorney #services .row>div:nth-child(2n+0) .small-title,
#page-attorney #services .row>div:nth-child(3n+0) .small-title {
	color: <?php echo esc_attr($color); ?>;
}

#page-attorney #facts .fa {
	background: <?php echo esc_attr($color); ?>;
}

#page-attorney .testimonials-callout {
	background: <?php echo esc_attr($color); ?>;
}

#page-attorney #testimonials .small-title  h4, #quotes .small-title {
	color: <?php echo esc_attr($color); ?>;
}

#page-attorney #about .btn-two {
	border: 1px solid <?php echo esc_attr($color); ?>;
	color: <?php echo esc_attr($color); ?>;
}

/*-----------------------------------------------*/
/*	Trainer */
/*-----------------------------------------------*/

#page-trainer .dot:before {
	color: <?php echo esc_attr($color); ?>;
}

#page-trainer .small-title {
	color: <?php echo esc_attr($color); ?>;
}

#page-trainer .btn-one {
	background: <?php echo esc_attr($color); ?>;
}

#page-trainer .btn-two {
	border: 1px solid <?php echo esc_attr($color); ?>;
}

#page-trainer #about .video-play .fa {
	color: <?php echo esc_attr($color); ?>;
}

#page-trainer #facts .fa {
	background: <?php echo esc_attr($color); ?>;
}

#page-trainer #news .box-title  {
	background: <?php echo esc_attr($color); ?>;
}

#testimonial-trainer-content .owl-page.active span {
	background: <?php echo esc_attr($color); ?>;
}

#page-trainer .services-item {
	background-color: <?php echo esc_attr($color); ?>;
}

/*-----------------------------------------------*/
/*	Movers */
/*-----------------------------------------------*/

#page-movers .btn-one {
	background: <?php echo esc_attr($color); ?>;
}

#page-movers #about .quote-form input[type="submit"] {
	background-color: <?php echo esc_attr($color); ?>;
}

#page-movers #projects  {
	background-color: <?php echo esc_attr($color); ?>;
}

#page-movers #facts .fa{
	background: <?php echo esc_attr($color); ?>;
}
.mean-container .mean-bar, .mean-container .mean-nav {
	background: <?php echo esc_attr($color); ?>;
}
.mean-container .mean-nav a:hover {
	background: <?php echo esc_attr($color); ?> !important;
    box-shadow: inset 1px -3px 10px rgba(0,0,0, .3);
}
.mean-container .mean-nav ul li a{
    color: rgba(255,255,255, .6);
}
.mean-container .mean-nav ul li a:hover{
    color: #fff;
}
.mean-container .mean-nav ul li a{
    border-top-color: rgba(255,255,255, .4);
}
#page-movers .testimonials-content,  {
	background-color: <?php echo esc_attr($color); ?>;
}
#page-movers #main-slider .dot:before {
 color: <?php echo esc_attr($color); ?>;
}

#page-movers .small-title {
 color: <?php echo esc_attr($color); ?>;
}

#page-movers .news-cat a {
 color: <?php echo esc_attr($color); ?>;
}

#page-movers .testimonials-callout .small-title, #page-therapy #testimonials .small-title {
 color: <?php echo esc_attr($color); ?>;
}
#page-movers #projects .projects-item .title h4{
    color: rgba(255,255,255, .5);
}

/*-----------------------------------------------*/
/*	Corporate Trainer */
/*-----------------------------------------------*/

#page-corporate-trainer .dot:before {
	color: <?php echo esc_attr($color); ?>;
}

#page-corporate-trainer .small-title {
	color: <?php echo esc_attr($color); ?>;
}

#page-corporate-trainer .btn-one {
	background: <?php echo esc_attr($color); ?>;
}

#page-corporate-trainer .btn-two {
	border: 1px solid <?php echo esc_attr($color); ?>;
	color: <?php echo esc_attr($color); ?>;
}

#page-corporate-trainer #about .owl-page.active span {
	background: <?php echo esc_attr($color); ?>;
}

#page-corporate-trainer .services-item {
	background-color: <?php echo esc_attr($color); ?>;
}

#page-corporate-trainer #tabs .nav-tabs>li.active>a, 
#page-corporate-trainer #tabs .nav-tabs>li>a:hover, 
#page-corporate-trainer #tabs .nav-tabs>li.active>a:hover, 
#page-corporate-trainer #tabs .nav-tabs>li.active>a:focus {
    color: <?php echo esc_attr($color); ?>;
}

#page-corporate-trainer #tabs .useful-link li {
	color: <?php echo esc_attr($color); ?>;
}

#page-corporate-trainer #facts .fa, #page-corporate-trainer .news-cat a, #page-corporate-trainer #testimonials .small-title {
	color: <?php echo esc_attr($color); ?>;
}
.current_page_item ,
#main-menu .nav-menu > li > a:hover{
    border-bottom-color: <?php echo esc_attr($color); ?> !important;
}

/*-----------------------------------------------*/
/*	Architect */
/*-----------------------------------------------*/

#page-architect .dot:before {
	color: <?php echo esc_attr($color); ?>;
}

#page-architect .small-title {
	color: <?php echo esc_attr($color); ?>;
}

#page-architect .btn-one {
	background: <?php echo esc_attr($color); ?>;
}

#page-architect .btn-three {
	border: 1px solid <?php echo esc_attr($color); ?>;
}

#page-architect .fa {
	color: <?php echo esc_attr($color); ?>;
}

#page-architect .news-cat a {
	color: <?php echo esc_attr($color); ?>;
}

#page-architect #services .services-item .lnr-arrow-right-circle, #page-architect #requests .requests-item .media-left .lnr{
	color: <?php echo esc_attr($color); ?>;
}

#page-architect #projects ol.projects-category li a:hover,
#page-architect #projects ol.projects-category li a.active {
	border-bottom: 1px solid <?php echo esc_attr($color); ?>;
	color: <?php echo esc_attr($color); ?>;
}

#page-architect  #projects a {
	color: <?php echo esc_attr($color); ?>;
}

#page-architect #requests .requests-item .quote-form .lnr {
	background: <?php echo esc_attr($color); ?>;
}

#page-architect #requests .quote-form .fa {
	background: <?php echo esc_attr($color); ?>;
}

#page-architect #requests .quote-form input[type="submit"] {
	border: 1px solid <?php echo esc_attr($color); ?>;
}

#page-architect #testimonials .box-testimonials {
	background: <?php echo esc_attr($color); ?>;
}

#page-architect #facts .fa {
	background: <?php echo esc_attr($color); ?>;
}

#page-architect #news .btn-two {
	border: 1px solid <?php echo esc_attr($color); ?>;
}

/*-----------------------------------------------*/
/*	Barber */
/*-----------------------------------------------*/

#page-barber .small-title {
	color: <?php echo esc_attr($color); ?>;
}

#page-barber .btn-one {
	background: <?php echo esc_attr($color); ?>;
}

#page-barber .prices-item .prices-item-hover {
	border: 5px solid <?php echo esc_attr($color); ?>;
}

#page-barber .owl-theme .owl-controls .owl-buttons div {
	background: <?php echo esc_attr($color); ?>;
}
.cd-single-point > a{
    background: <?php echo esc_attr($color); ?>;
}
.bookme-phone{
    color: <?php echo esc_attr($color); ?>;
}
</style>
<?php endif;

$headerbg = '';
$page_header_color = $bookme_option['bg_header'];
if ( $page_header_color ) {
	$headerbg = $page_header_color;
}
if ( $headerbg != '' ) : ?>
<style type="text/css">
    .site-header, #page-movers .testimonials-content{
       background:  <?php echo $headerbg; ?>;
    }
</style>
<?php endif;

$hovercolor = '';
$onhover_color = $bookme_option['hover_color'];
if ( $onhover_color ) {
	$hovercolor = $onhover_color;
}
if ( $hovercolor != '' ) : ?>
<style type="text/css">
    .btn-one:hover, .btn-one:focus, #page-architect .btn-one:hover, #page-architect .btn-one:focus, .quote-form input[type="submit"]:hover, .quote-form input[type="submit"]:focus, #main-slider .quote-form input[type="submit"]:hover, #main-slider .quote-form input[type="submit"]:focus, #page-attorney .btn-one:hover, #page-attorney .btn-one:focus, #page-corporate-trainer .btn-one:hover, #page-corporate-trainer .btn-one:focus, #page-movers .btn-one:hover, #page-movers .btn-one:focus, #page-movers #about .quote-form input[type="submit"]:hover, #page-movers #about .quote-form input[type="submit"]:focus, #page-therapy .btn-one:hover, #page-therapy .btn-one:focus, #page-trainer .btn-one:hover, #page-trainer .btn-one:focus{
        background: <?php echo $hovercolor; ?>;
    }
    .btn-two:hover, .btn-two:focus, .services-item a.btn.btn-services-one:hover, .services-item a.btn.btn-services-one:focus, #page-architect #requests .quote-form input[type="submit"]:hover, #page-architect #requests .quote-form input[type="submit"]:focus, #page-trainer .services-item .btn:hover, #page-trainer .services-item .btn:focus, .services-item .btn:hover, .services-item .btn:focus{
        border-color: <?php echo $hovercolor; ?> !important;
        color: <?php echo $hovercolor; ?> !important;
    }
    .cd-single-point.is-open > a, .cd-single-point a:hover{
        background: <?php echo $hovercolor; ?>;
    }
    a.link-more:hover, .news-cat a:hover, #news .title a:hover, #page-corporate-trainer .news-cat a:hover, #page-movers .news-cat a:hover, #page-therapy .news-cat a:hover, #page-trainer .news-cat a:hover, .two-row .galleries-wrapper .title a:hover, .three-row .galleries-wrapper .title a:hover, .entry-header .small-title h4 a:hover, .post-meta ul li a:hover {
        color: <?php echo $hovercolor; ?>;
    }
    .news-cat a:after, a.link-more:after{
        background: <?php echo $hovercolor; ?>;
    }
</style>
<?php endif;


$colorpost = '';
$post_color = get_post_meta(get_the_ID(), '_BookmeMB_post_color_scheme', true);
if ( $post_color ) {
	$colorpost = $post_color;
} 
if ( $colorpost != '' ) : ?>
<style type="text/css">	
.single-post .post-meta a, .single-post .small-title a, .single-post #navigations .breadcrumb, .single-post .comment-author h3 span, .single-post .sidebar .widget ul {
	color: <?php echo $colorpost; ?>;
}
.single-post .pager li > a, .single-post .pager li > span, .single-post .comment-author, .single-post #searchform #s {
	border-color: <?php echo $colorpost; ?>;
}
.single-post .pager li > a:hover, .single-post .pager li > a:focus {
	background-color: <?php echo $colorpost; ?>;
	border-color: <?php echo $colorpost; ?>;
}
.single-post .btn-one:hover, .single-post .btn-one, .single-post .comment-form input[type="submit"] {
	background: <?php echo $colorpost; ?>;
}

</style>
<?php endif;
