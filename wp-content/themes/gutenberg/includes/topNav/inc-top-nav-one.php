<div id="topNav" class="topNav">
			
    <div id="searchBox" class="small-12 columns">
        <div class="searchInner small-12 columns">	 
            <div class="formContainer small-12">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>

</div>

<style>
	/* ------------------ move to main style.css if you're using this top nav --------------- */
	
#searchBox {}

#searchBox .searchInner {
	width:50%;
	min-width:360px;
	display:block;
	margin:auto;
	float:none;
	padding:0;
}

#searchBox .searchInner .formContainer {
	position:relative;
	padding:0.9375rem 0;
}

#searchBox .searchInner .formContainer form {position:relative;}

#searchBox .searchInner .formContainer input {
	display:inline-block;
	width:calc(100% - 40px);
	margin:0;
	font-size:14px;
}

#searchBox .searchInner .formContainer input[type="submit"] {
	display:inline-block;
	width:40px;
	height:100%;
	position:absolute;
	right:0;
	z-index:2;
	background:none;
	border:0;
	font-size:0;
}

#searchBox .searchInner .formContainer i {
	position: absolute;
    right: 0;
    z-index: 1;
    width: 40px;
    height: 100%;
    text-align: center;
    padding: 9px 0;
	background:#ccc;
	transition:all ease-out 0.4s;
	-webkit-transition:all ease-out 0.4s;
	-moz-transition:all ease-out 0.4s;
	-ms-transition:all ease-out 0.4s;
	-o-transition:all ease-out 0.4s;
}

#searchBox .searchInner .formContainer:hover i  {
	background:#333;
	color:#fff;
}
	
.smIcons {
	text-align:center;
}

.smIcons .smIconsInner {
	display:inline-table;
}

.smIcons .smIconsInner a {
	padding:8px;
}

.smIcons .smIconsInner a i {
	font-size:18px;
}

@media only screen and (max-width: 40.063em) {
	#searchBox .searchInner {min-width:100%;}
}

	
</style>
