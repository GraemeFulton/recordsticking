<?php header('Content-type: text/css'); ?>

/* Clearfix */

.jckcf {
	display: block;	
}	

.jckcf::after {
	clear: both;
	content: ".";
	display: block;
	height: 1px;
	visibility: hidden;
}

/* Default Styles */

.jckWooThumbs {
	display: none;
}

#jckWooThumbs_img_wrap {
	margin-bottom: 30px;
	position: relative;
	overflow: hidden;
	float: <?php echo $jckWooThumbs['sliderPosition']; ?>;
	width: <?php echo $jckWooThumbs['sliderWidth']['width']; ?>;
}

<?php if($jckWooThumbs['enableBreakpoint']): ?>
@media screen and (max-width: <?php echo $jckWooThumbs['breakpoint']['width']; ?>) {
	#jckWooThumbs_img_wrap {
		float: <?php echo $jckWooThumbs['sliderPositionBreakpoint']; ?>;
		width: <?php echo $jckWooThumbs['sliderWidthBreakpoint']['width']; ?>;
	}
}
<?php endif; ?>

	#jckWooThumbs_img_wrap .jckLoading {
		display: none;
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		z-index: 100;
		background: #fff;
		-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
		filter: alpha(opacity=80);
		-moz-opacity: 0.8;
		-khtml-opacity: 0.8;
		opacity: 0.8;		
	}
		#jckWooThumbs_img_wrap .jckLoading img {
			position: absolute;
			top: 50%;
			left: 50%;
		}
		
	#jckWooThumbs_img_wrap.jckwt_loading .jckLoading {
		display: block;
	}

/* Colouring */

.rsMinW, 
.rsMinW .rsOverflow, 
.rsMinW .rsSlide, 
.rsMinW .rsVideoFrameHolder {
	background: <?php echo $jckWooThumbs['slideBgColour']; ?>;
}
 
.rsMinW .rsThumbs {
	background: <?php echo $jckWooThumbs['thumbBgColour']; ?>;
}

/* Fullscreen Button */

#jckWooThumbs_img_wrap .viewFull {
	-moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
	position: absolute;
	bottom: 0;
	left: 0;
	display: block;
	right: 0;
	padding: 13px 10px;
	height: 48px;
	line-height: 24px;
}
	#jckWooThumbs_img_wrap .viewFull span {
		background: url('<?php echo $this->plugin_url; ?>assets/frontend/img/slide-sprite.png') no-repeat -5px -5px;
		display: block;
		width: 24px;
		height: 24px;
		overflow: hidden;
		text-indent: 250%;
		white-space: nowrap;
	}

.pp_content,
.pp_hoverContainer {
	max-width: 100%;
}
	.pp_fade {
		position: relative;
	}
		#pp_full_res img {
			height: auto !important;
			vertical-align: baseline;
		}
		
		body div.pp_woocommerce .pp_close {
			z-index: 100;
			top: -70px;
			right: -50px;
		}
		
		body div.pp_woocommerce a.pp_expand, 
		body div.pp_woocommerce a.pp_contract {
			display: none !important;
		}
		
		body div.pp_woocommerce .pp_content_container {
			padding-bottom: 10px;
		}
	
/* Thumb Styles */

#jckWooThumbs_img_wrap .rsMinW .rsThumbsHor {
	height: <?php echo $jckWooThumbs['thumbDimensions']['height']; ?>;
}

#jckWooThumbs_img_wrap .rsMinW .rsThumbsVer {
	width: <?php echo $jckWooThumbs['thumbDimensions']['width']; ?>;
}

	/* Thumbs Left */
	
	.thumbsleft .rsMinW .rsThumbsVer {
		left: 0;
		right: auto;
	}
	.thumbsleft .rsOverflow {
		margin-left: <?php echo $jckWooThumbs['thumbDimensions']['width']; ?>;
	}
	
	/* Thumbs Above */
	
	.thumbsabove .rsMinW .rsThumbsHor {
		position: absolute;
		top: 0;
	}
	.thumbsabove .rsOverflow {
		margin-top: <?php echo $jckWooThumbs['thumbDimensions']['height']; ?>;
	}

#jckWooThumbs_img_wrap .rsMinW .rsThumb {
	/* ---CUSTOMISE--- */
	width: <?php echo $jckWooThumbs['thumbDimensions']['width']; ?>;
	height: <?php echo $jckWooThumbs['thumbDimensions']['height']; ?>;
}

/* Stacked Thumb Styles */

#jckWooThumbs_img_wrap .rsMinW .rsTabs {
	margin: 0 -1.6666%;
	width: 103.3333%;
}

	#jckWooThumbs_img_wrap .rsMinW .rsTab {
		float: left;
		display: inline;
		width: 30%;
		padding: 0;
		border: none;
		background: none;
		margin: 0 1.6666% 3.3333%;
		-webkit-border-radius: 0;
		-moz-border-radius: 0;
		border-radius: 0;
	}
	
	#jckWooThumbs_img_wrap .rsMinW .rsTab.rsNavSelected {
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		box-shadow: none;
		background: #000;
	}
	
		#jckWooThumbs_img_wrap .rsMinW .rsTab img {
			width: 100%;
			height: auto;
			display: block;
		}
		
		#jckWooThumbs_img_wrap .rsMinW .rsTab.rsNavSelected img {
			-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=75)";
			filter: alpha(opacity=75);
			-moz-opacity: 0.75;
			-khtml-opacity: 0.75;
			opacity: 0.75;
		}
	
/* Zoom Styles */

.zm-viewer img {
	max-width: none;
}

<?php if($jckWooThumbs['zoomType'] == 'follow'):
$borderRadius = ($jckWooThumbs['zoomDimensions']['width'] > $jckWooThumbs['zoomDimensions']['height']) ? $jckWooThumbs['zoomDimensions']['width'] : $jckWooThumbs['zoomDimensions']['height']; ?>
.zm-viewer.shapecircular {
	-webkit-border-radius: <?php echo $borderRadius; ?>px;
	-moz-border-radius: <?php echo $borderRadius; ?>px;
	border-radius: <?php echo $borderRadius; ?>px;
}
<?php endif; ?>

.zm-handlerarea {
	background: <?php echo $jckWooThumbs['lensColour']; ?>;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $jckWooThumbs['lensOpacity']*100; ?>)" !important;
	filter: alpha(opacity=<?php echo $jckWooThumbs['lensOpacity']*100; ?>) !important;
	-moz-opacity: <?php echo $jckWooThumbs['lensOpacity']; ?> !important;
	-khtml-opacity: <?php echo $jckWooThumbs['lensOpacity']; ?> !important;
	opacity: <?php echo $jckWooThumbs['lensOpacity']; ?> !important;
}

<?php echo $jckWooThumbs['additionalCss']; ?>