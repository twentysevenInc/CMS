<?php 
	header("Content-type: text/css; charset: UTF-8");

    /*  MENU  */
	$menuBorderColor = '#eee';

	/*  BUTTONS  */
	$normalButtonBorder = '#ccc';
	$normalButtonBackground = '#fff';
	$normalButtonBackgroundHover = '#fff';
	$normalButtonBackgroundActive = '#fff';

	$redButtonBorder = '#D64541';
	$redButtonBorderHover = '#FE6161';
	$redButtonBorderActive = '#D64541';
	$redButtonBackground = '#F64747';
	$redButtonBackgroundHover = '#FE6161';
	$redButtonBackgroundActive = '#D64541';

	$greenButtonBorder = '#0AC379';
	$greenButtonBorderHover = '#2ECC71';
	$greenButtonBorderActive = '#0AB06E';
	$greenButtonBackground = '#0AC379';
	$greenButtonBackgroundHover = '#2ECC71';
	$greenButtonBackgroundActive = '#0AB06E';

	$inputTypeTextBorder = '#ccc';
	$inputTypeTextBorderActive = '#777';

	$navBackground = '#f7426b';
	/*$navBackground = '';*/

	$sidebarBackground = '#303333';
	$sidebarBackground = 'rgba(32, 42, 58, 1)';

	$notificationsBackground = '#000';

	$widgetBackground = '#fff'; //wor #f2f2f2
	// $widgetBackground = 'rebeccapurple';

	/* Checkboxes */
	$checkboxDisabledBackground = "#f7426b";
	$checkboxEnabledBackground = "#2ECC71";
	$checkboxSwitchBackground = "#fff";
	$checkboxText = "#fff";

	/* Header (h1, h4) like settings*/
	$headerH4Color = '#888';
	
	/* Alerts */
	$alertOverlayBackground = "#000";

	$alertBackground = "#fff";
	$alertHeaderColor = "#000";
	$alertBorderBottomColor = "#eee";
	$alertTextColor = "#555";

	$warningBackground = "#fff";
	$warningHeaderColor = "#D64541";
	$warningBorderBottomColor = "#eee";
	$warningTextColor = "#555";
?>


@font-face {
    font-family: "Font Awesome";
    src: url("font/fontawesome.ttf");
}

*{
	margin: 0 auto;
	padding: 0;
	text-rendering: optimizeLegibility;
	-webkit-font-smoothing: antialiased;
	-webkit-appearance: none;
	border-radius: 0;
	text-decoration: none;
	list-style-type: none;
	color: black;

	font-family: "Source Sans Pro";
	/*font-family: "Comic Neue Angular";*/
}

:focus {outline:none;}

*, *:before, *:after {
	-moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
}

body, html{
	height: 100%;
	width: 100%;
}

.verticalCenter{
	/* Example
	<div class="fullWindow">
		<div class="verticalCenter">
			<elements/>
		</div>
	</div>
	*/
	position: absolute;
	top: 50%; left: 0; right: 0;
	-webkit-transform: translateY(-50%);
	-ms-transform: translateY(-50%);
	transform: translateY(-50%);
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
}

/* Font awesome */

.awesome{
	padding: 0 0.2em;
	font-family: "Font Awesome";
	transition: 0.1s all ease;
}

a.awesome:hover{
	opacity: 0.3;
}

.awesome-red{
	color: red;
}

/* Buttons */

.button{
	display: inline-block;
	font-size: 17px;
	padding: 0.4em 0.7em;
	margin: 0 0.2em;
	border-radius: 0.25em;
	transition: 0.2s all ease;
}

.button:hover{
	/*border-color: #aaa;*/
	opacity: 1;
	-webkit-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.15);
	-moz-box-shadow:    0px 2px 5px 0px rgba(0, 0, 0, 0.15);
	box-shadow:         0px 2px 5px 0px rgba(0, 0, 0, 0.15);
	-moz-transition: 200ms cubic-bezier(0.175, 0.885, 0.52, 1.775);
	-o-transition: 200ms cubic-bezier(0.175, 0.885, 0.52, 1.775);
	-webkit-transition: 200ms cubic-bezier(0.175, 0.885, 0.52, 1.775);
	transition: 200ms cubic-bezier(0.175, 0.885, 0.52, 1.775);
	/*transition: 0.3s all ease;*/
}

.button:active{
	-webkit-box-shadow: none;
	-moz-box-shadow:    none;
	box-shadow:         none;
}

.normal-button{
	border: 0.5px solid <?php echo $normalButtonBorder; ?>;
	background: <?php echo $normalButtonBackground; ?>;
}

.normal-button:hover{
	background: <?php echo $normalButtonBackgroundHover; ?>;
}

.normal-button:active{
	background: <?php echo $normalButtonBackgroundActive; ?>;
}

.red-button{
	border: 0.5px solid <?php echo $redButtonBorder; ?>;
	background: <?php echo $redButtonBackground; ?>;
	color: white;
}

.red-button:hover{
	border: 0.5px solid <?php echo $redButtonBorderHover; ?>;
	background: <?php echo $redButtonBackgroundHover; ?>;
}

.red-button:active{
	border: 0.5px solid <?php echo $redButtonBorderActive; ?>;
	background: <?php echo $redButtonBackgroundActive; ?>;
}

.green-button{
	color: white;
	border: 0.5px solid <?php echo $greenButtonBorder; ?>;
	background: <?php echo $greenButtonBackground; ?>;
}

.green-button:hover{
	border: 0.5px solid <?php echo $greenButtonBorderHover; ?>;
	background: <?php echo $greenButtonBackgroundHover; ?>;
}

.green-button:active{
	border: 0.5px solid <?php echo $greenButtonBorderActive; ?>;
	background: <?php echo $greenButtonBackgroundActive; ?>;
	color: white;
}

/* text-fields */

input[type="text"], input[type="number"], input[type="time"], input[type="date"], input[type="password"]{
	font-weight: 400;
	font-size: 17px;
	margin: 0 0.2em;
	border: 0.5px solid <?php echo $inputTypeTextBorder; ?>;
	border-radius: 0.25em;
	padding: 0.4em 0.7em;
}

input[type="text"]:active, input[type="text"]:active, input[type="time"]:active, input[type="date"]:active, input[type="password"]:active{
	border: 0.5px solid <?php echo $inputTypeTextBorderActive; ?>;
}

label{
	font-size: 17px;
	margin: 0 0.2em;
	padding: 0.4em 0.7em;
}

.input-disabled{
	border: 0.5px solid rgba(0, 0, 0, 0) !important;
	background: none;
}

input[type="file"]{
	font-weight: 400;
	font-size: 17px;
	margin: 0 0.2em;
	border: 0.5px solid <?php echo $inputTypeTextBorder; ?>;
	border-radius: 0.25em;
	padding: 0.4em 0.7em;
}

select{
	position:relative;
	font-weight: 400;
	font-size: 17px;
	margin: 0 0.2em;
	border: 0.5px solid <?php echo $inputTypeTextBorder; ?>;
	border-radius: 0.25em;
	padding: 0.4em 0.7em;
}

select:after{
	content: ' ';
	position: absolute;
	right: 0;
	top: 0;
	width: 100px;
	height: 100px;
	display: block;
	background: #fff url(../img/arrow.svg) no-repeat center center;
	pointer-events: none;
}

/* Complete overlay & popups */

#darken{
	display: none;
	position: fixed;
	z-index: 100;
	background: <?php echo $alertOverlayBackground; ?>;
	top: 0;bottom: 0;
	left: 0;right: 0;
	opacity: 0.7;
}

#alert, #warning{
	position: fixed;
	z-index: 101;
	left: 0;right: 0;
	width: 90%;
	max-width: 420px;
	padding: 1rem;
	padding-bottom: 1.5rem;
	border-radius: 0.25em;
	/*top: 25vh;*/
}

#alert{
	background: <?php echo $alertBackground; ?>;
	display: none;
}

#warning{
	/*background: #F64747;*/
	background: <?php echo $warningBackground; ?>;
	display: none;
}

#warning h2{
	color: <?php echo $warningHeaderColor; ?>;
}

#alert h2{
	color: <?php echo $alertHeaderColor; ?>;
}

#alert h2{
	padding-bottom: 0.5rem;
	border-bottom: 1pt solid <?php echo $alertBorderBottomColor; ?>;
}

#warning h2{
	padding-bottom: 0.5rem;
	border-bottom: 1pt solid <?php echo $warningBorderBottomColor; ?>;
}

#alert p{
	color: <?php echo $alertTextColor; ?>;
	padding: 1em 0;
	padding-bottom: 2em;
}

#warning p{
	color: <?php echo $warningTextColor; ?>;
	padding: 1em 0;
	padding-bottom: 2em;
}

#alert li, #warning li{
	text-align: right;
}

#alert a, #warning a{
	display: inline;
}

/* checkbox n shit */

.checkbox input[type="checkbox"]{
	border: none;
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	height: 2rem;
	width: 4rem;
	cursor: hand;
	background: <?php echo $checkboxDisabledBackground; ?>;
}

.checkbox input[type="checkbox"]:checked{
	background: <?php echo $checkboxEnabledBackground; ?>;
}

.checkbox input[type="checkbox"]:checked + .switch{
	left: 2.2rem;
}

.checkbox input[type="checkbox"] + .switch{
	left: 0.2rem;
}

.checkbox{
	/*border: 2pt solid #ccc;*/
	/*margin: 5rem;*/
	position: relative;
	height: 2rem;
	width: 4rem;
	border-radius: 1rem;
	overflow: hidden;

	display: inline-block;
}

.switch{
	pointer-events: none;
	position: absolute;
	top: 0.2rem;
	height: 1.6rem;
	width: 1.6rem;
	background: <?php echo $checkboxSwitchBackground; ?>;
	display: inline-block;
	border-radius: 50%;
	transition: 0.1s ease all;
}

.switch:before{
	content: "on";
	color: <?php echo $checkboxText; ?>;
	position: absolute;
	top: 0.17rem;
	right: 2rem;
	text-transform: uppercase;
}

.switch:after{
	content: "off";
	color: <?php echo $checkboxText; ?>;
	position: absolute;
	top: 0.17rem;
	right: -1.8rem;
	text-transform: uppercase;
}

/* Page header (h1, h4) zb settings*/

/*#page-header{
	padding: 2rem 1.5rem;
	width: 100%;
}

#page-header h1{
	font-size: 2em;
}

#page-header h4{
	font-weight: 400;
	color: <?php echo $headerH4Color; ?>;
}*/
.page-header{
	padding: 2rem 1.5rem;
	width: 100%;
}

.page-header h1{
	font-size: 2em;
}

.page-header h4{
	font-weight: 400;
	color: <?php echo $headerH4Color; ?>;
}

.page-subheader{
	/*background: #eee;*/
	padding: 2rem 1.5rem;
	padding-bottom: 1.5rem;
	width: 100%;
}

.page-subheader h1{
	font-size: 1.5em;
}

.page-subheader h4{
	font-weight: 400;
	color: <?php echo $headerH4Color; ?>;
}

/* List */

.list{
	width: 100%;
}

.list .item {
	display: block;
	width: 100%;
	padding: 1rem 0.5rem;
	padding-right: 1rem;
	padding-bottom: 0.5rem;
	text-align: center;
	text-align: left;
	overflow: auto;
}

.list .item input[type="text"]{
	margin-top: -0.4rem;
	float: left;
}

.list .item .checkbox{
	margin-top: -0.3rem;
	float: right;
}

.list .item:nth-of-type(even){
	background-color: #fff;
}

.list .item:nth-of-type(odd){
	background-color: #eee;
}

/* Settings sudo table */

.settings-table{
	width: 100%;
	max-width: 100%;
	padding-bottom: 1.5rem;
}

.settings-table > div{
	width: 100%;
	max-width: 100%;
}

.settings-table > div > div{
	width: 100%;
	max-width: 100%;
	overflow: auto;
}

.settings-table .settings-table-title{
	padding: 2rem;
	width: 100%;
}

.settings-table .settings-table-title h1{
	font-size: 1.8em !important;
	width: 60%;
	float: left;
}

.settings-table .settings-table-title h4{
	font-size: 1.1em;
	font-weight: 400;
	color: #888;
	width: 60%;
	float: left;
}

.settings-table .settings-table-title a{
	float: right;
}

.settings-table table{
	min-width: 100% !important;
	border-collapse: collapse;

	border-bottom: 2pt solid #eee;
}

.settings-table table tr td{
	padding: 0.75em  1.5em;
	text-align: left;
	font-size: 1.05em;
}

.settings-table table tr:first-of-type td{
	background: #f7426b;
	color: white !important;
	font-weight: 600;
}


.settings-table table tr td img{
	height: 2rem;
	border-radius: 50%;
}

.settings-table table tr:nth-of-type(odd){
	background: #eee;
}

.settings-table table tr:nth-of-type(even){
	background: #fff;
}

.settings-table .manage-groups-buttons{
	margin: 1rem 0;
	text-align: center;
}

#manage-users table tr td img{
	height: 2rem;
	margin: -0.25rem 0;
	margin-top: 0;
}


/* Content menu */

.menu{
	/*position: -webkit-sticky;
    position: -moz-sticky;
    position: -ms-sticky;
    position: -o-sticky;
    position: sticky;

    top: 0;
    left: 0;right: 0;*/

	text-align: right;
	padding: 1rem;
	overflow-y: auto;
	overflow-x: none;
	border-bottom: 2pt solid <?php echo $menuBorderColor; ?>;
}

.menu h1 {
	font-family: 'Source Sans Pro';
	text-align: center;
	float: left;
	vertical-align: center;
	font-weight: 600;
	font-size: 1.7em;
	padding: 0 0.3em;
}


.menu h3{
	margin: 0.25em;
	margin-right: -1rem;
	/*opacity: 0.5;*/
	display: inline;
	/*height: 2rem;*/
	vertical-align: bottom;
	transition: 0.2s all ease;
	float: left;
	font-size: 1.3em;
}

.menu h1 a, .menu h3 a{
    color: #ccc;
}

.menu h1 a:hover{
	color: #bbb;
}

.menu h1 .active{
    color: #f7426b !important;
}

.menu h3 > a{
    color: #2b2b2b !important;
}

.menu h3:hover{
    opacity: 0.3;
}

.menu h3 > img{
	height: 1.5rem;
	margin-top: -0.2rem;
	margin-bottom: -0.25rem;
}

/* else */

.flex{
	display: -webkit-box;
	display: -webkit-flex;
	display: -ms-flexbox;
	display: flex;
	-webkit-box-align: center;
	-webkit-align-items: center;
	-ms-flex-align: center;
	align-items: center;
	-webkit-box-pack: center;
	-webkit-justify-content: center;
	-ms-flex-pack: center;
	justify-content: center;
	height: 100%;
	position: fixed;
}

a{
	color: black;
}

li{
	list-style-type: none;
}

nav{
	position: fixed;
	z-index: 2;
	height: 3rem;
	width: 78%;
	right: 0;
	overflow: visible;

	-webkit-box-shadow: 0px 1px 15px 0px rgba(168, 168, 168, 0.4);
	-moz-box-shadow:    0px 1px 15px 0px rgba(168, 168, 168, 0.4);
	box-shadow:         0px 1px 15px 0px rgba(168, 168, 168, 0.4);

	-webkit-box-shadow: 0px 1px 15px 0px rgba(0, 0, 0, 0.2);
	-moz-box-shadow:    0px 1px 15px 0px rgba(0, 0, 0, 0.2);
	box-shadow:         0px 1px 15px 0px rgba(0, 0, 0, 0.2);

	background: <?php echo $navBackground; ?>;
}

nav li{
	display: inline-block;
	margin: 0 0.5em;
	height: 3rem;
	position: relative;
}

nav li:last-of-type{
	float: right;
}

nav a{
	color: #fff;
	padding: 0.5em 0.5em;
	line-height: 3rem;
}

nav a:hover{
	/*color: #666;*/
	opacity: 0.7;
}

#sidebar{
	position: fixed;
	z-index: 3;
	height: 150%;
	/*background: #f2f2f2;*/
	/*background: #343144;*/
	/*background: #303333;*/

	color: white;
	width: 22%;
	text-align: center;

    background-color: <?php echo $sidebarBackground; ?>;
}

#sidebar *{
	color: white;
}

#sidebar .sidebar-content{
	position: relative;
	width: 100%;
	/*margin-top: 2vh;*/
	margin-top: 0.5rem;
	text-align: left;
}

#sidebar .sidebar-content li{
	width: 100%;
	margin-bottom: 0.5rem;
	padding: 0 0.5rem;
	/* background: rgba(255, 255, 255, 0.1); */
}

#sidebar .sidebar-content li img{
	vertical-align: top;
	width: 2.5rem;
	padding: 0.5rem;
	display: inline-block;
	/*background: #222;*/
}

#sidebar .sidebar-content li a{
	/*background: #000;*/
	margin-top: -0.05em;
	vertical-align: top;
	width: calc(100% - 2.5rem);
	height: 2.5rem;
	line-height: 2.5rem;
	transition: 0.1s all ease;
	padding-left: 0.5rem;
	display: inline-block;
	/*background: rgba(255, 255, 255, 0.1);*/
}

#sidebar .sidebar-content li:hover{
	background: rgba(255, 255, 255, 0.07);
}

#sidebar .sidebar-user{
	height: 3rem;
	padding: 0.5rem;
	padding-left: 0.75rem;
	/*background: rgba(255, 255, 255, 1);*/
	/*background: <?php echo $navBackground; ?>;*/
	background-color: rgba(42, 52, 68, 1);
	/*border-right: 1pt solid <?php echo $sidebarBackground?>;*/
}

/*#sidebar .sidebar-user * {
	color: black;
}*/

#sidebar .sidebar-user img{
	height: 2rem;
	width: 2rem;
	float: left;
	border-radius: 50%;
	margin-right: 0.75rem;
	border: 1px solid rgba(255, 255, 255, 0.3);
}

#sidebar .sidebar-user a{
	margin: 0;
	float: left;
	transition: 0.2s all ease;
}

#sidebar .sidebar-user a:hover > h3{
	text-decoration: underline;
}

#sidebar .sidebar-user h3{
	display: inline-block;
	padding: 0.25em;
	padding-left: 0;
	float: left;
	font-weight: 400;
	font-size: 1.1em;
}
#sidebar .sidebar-user h3:after{
	content: '';
}

#sidebar #hideSidebar{
	padding: 0.5em;
	float: right;
	transition: 0.2s all ease;
}

#sidebar #hideSidebar:hover{
	opacity: 0.6;
}

#content{
	position: relative;
	float: right;
	width: 78%;
	margin-top: 3rem;
	/*overflow-x: hidden;*/
	overflow: hidden !important;
}

#notifications{
	display: none;
	position: absolute;
	z-index: 999;
	background: <?php echo $notificationsBackground; ?>;
}

#notificationArrow{
	float: left;
	margin-left: 2rem;
	position: relative;
	background: <?php echo $notificationsBackground; ?>;
	border: 4px solid <?php echo $notificationsBackground; ?>;
	width: 30px;
}
#notificationArrow:after, #notificationArrow:before {
	bottom: 100%;
	left: 50%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
	clear: both;
}

#notificationArrow:after {
	border-color: rgba(204, 204, 204, 0);
	border-bottom-color: <?php echo $notificationsBackground; ?>;
	border-width: 15px;
	margin-left: -15px;
}
#notificationArrow:before {
	border-color: rgba(0, 0, 0, 0);
	border-bottom-color: <?php echo $notificationsBackground; ?>;
	border-width: 21px;
	margin-left: -21px;
}

#notifications li{
	display: block;
	height: auto;
	width: 18rem;
	padding: 0.5em;
	margin: 0;
	background: <?php echo $notificationsBackground; ?>;
	color: white;
}

#settings #menu {
	text-align: center;
	margin-top: 2rem;
}

#settings #menu li {
	text-align: center;
	list-style: none;
	display: inline-block;
}

#settings #menu li a{
	text-decoration: none;
	color: #888;
	display: block;
	padding: 0.4rem 1rem;
	margin: 0 0.25rem;
	font-size: 1.2rem;
}
#settings #menu li .active{
	color: #000;
}

#dashboard {
	padding: 0.5rem 0.5rem;
	overflow-x: hidden; 
	/*margin-top: 1rem;*/
}

.widget{
	border-radius: 0.175rem;
	position: relative;
	/*z-index: -1;*/
	margin: 0.5rem;
	background-color: white;
	background-color: <?php echo $widgetBackground; ?>;
	/*background: #ccc;*/
	/*min-height: 14rem;*/
	/*height: 14rem;*/
	vertical-align: top;
	box-sizing: border-box;
	overflow: hidden;
	float: left;
	background: #eee;
	/*opacity: 0;*/
}
#dashboard h1 {
	margin-left: 1rem;
	margin-top: 1rem;
}
#dashboard p {
	color: #555;
	margin-left: 1rem;
}
.fullwidth{
	width: calc(100% - 1rem);
}
.threewidth {
	width: calc(75% - 1rem);
}
.halfwidth{
	width: calc(50% - 1rem);
}
.quarterwidth{
	width: calc(25% - 1rem);
}

.oneheight{
	height: 10vw !important;
}

.twoheight{
	height: calc(20vw + 1rem) !important;
}

.threeheight{
	height: calc(30vw + 2rem) !important;	
}

.fourheight{
	height: calc(40vw + 3rem) !important;
}

.oneheight-small{
	height: 5vw !important;
}

.twoheight-small{
	height: calc(10vw + 1rem) !important;
}

.threeheight-small{
	height: calc(15vw + 2rem) !important;	
}

.fourheight-small{
	height: calc(20vw + 3rem) !important;
}


#overlay{
	display: none;

	text-align: center;
	pointer-events: none;
	position: fixed;
	z-index: 9999;
	top: 3rem;bottom: 0;
	left: 22%;right: 0;
	opacity: 0.7;
	background: #000;
}

#overlay img{
	/*width: 4rem;*/
	/*height: auto;*/

	margin-top: 25%;
	width: 7rem;
	height: auto;
	/*opacity: 0.4;*/

	-webkit-animation: yey 2s infinite; /* Safari 4+ */
	-moz-animation:    yey 2s infinite; /* Fx 5+ */
	-o-animation:      yey 2s infinite; /* Opera 12+ */
	animation:         yey 2s infinite; /* IE 10+, Fx 29+ */
	-webkit-animation-fill-mode: forwards;
}

@-webkit-keyframes yey {
    0%{
    	-webkit-transform: rotateY(0deg) rotateZ(0deg) rotateX(0deg);
    }
    25%{
    	-webkit-transform: rotateY(-90deg) rotateZ(-90deg) rotateX(90deg);
    }
    50%{
    	-webkit-transform: rotateY(0deg) rotateZ(-180deg) rotateX(0deg);
    	
    }
    75%{
    	-webkit-transform: rotateY(90deg) rotateZ(-270deg) rotateX(90deg);
    }
    100%{
    	-webkit-transform: rotateY(0deg) rotateZ(-360deg) rotateX(0deg);
    }
}

@media (max-width: 320pt) {
	#sidebar{
		min-width: 75%;
		margin-left: -75%;
		display: none;
	}
	#sidebar .sidebar-content li{
		padding-left: 0.5rem;
	}
	#sidebar .sidebar-content li img{
		width: 3rem;
		padding: 0.75rem;
	}

	#sidebar .sidebar-content li a{
		width: calc(100% - 3rem);
		height: 3rem;
		line-height: 3rem;
		padding-left: 0.5rem;
	}
	#content{
		width: 100%;
	}
	nav{
		width: 100%;
	}
	/*#sidebar li img {
		margin-top: 4rem;
	}*/
	input[type="text"]{
		display: block;
	}

	.quarterwidth, .halfwidth, .threewidth{
		width: calc(100% - 1rem);
	}

	.oneheight{
		height: 25vh !important;
	}

	.twoheight{
		height: calc(50vh + 1rem) !important;
	}

	.threeheight{
		height: calc(70vh + 2rem) !important;	
	}

	.fourheight{
		height: calc(80vh + 3rem) !important;
	}
}
@media (min-width: 320pt) and (max-width: 640pt) {

	.quarterwidth{
		width: calc(50% - 1rem);
	}

	.halfwidth, .threewidth {
		width: calc(100% - 1rem);
	}

	.oneheight{
		height: 25vh !important;
	}

	.twoheight{
		height: calc(50vh + 1rem) !important;
	}

	.threeheight{
		height: calc(70vh + 2rem) !important;	
	}

	.fourheight{
		height: calc(80vh + 3rem) !important;
	}
}