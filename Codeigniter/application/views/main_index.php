<html>
	<head>
		<title>meetUP</title>
		<meta charset="utf-8">
		<style>
			#wrapper {
				width : auto;
				height: 700; 
				margin: 0 auto;
			}
		</style>
		<script type="text/javascript">
			var selectedTabColor = "#d78b7d";
			var selectedTabBackgroundColor = "#f8f7f7";

			var tabDefaultColor = "#f9f3e3";
			var tabDefaultBackgroundColor = null;

			var selectedTab = null;

			function init() {
			    var defaultSelectedTab = document.getElementById("wwd");
			    selectTab(defaultSelectedTab);
			}

			function selectTab(tab) {
			    
			    if (selectedTab != tab) {
			    
			        var content = null;
			        var selectedTabContent = null;
			        
			        if (selectedTab) {
			            selectedTab.style.color = tabDefaultColor;
			            selectedTab.style.backgroundColor = tabDefaultBackgroundColor;
			            
			            content = selectedTab.id + "_content";
			            selectedTabContent = document.getElementById(content);
			            selectedTabContent.style.display = "none";
			        }
			    
			        selectedTab = tab;
			        selectedTab.style.color = selectedTabColor;
			        selectedTab.style.backgroundColor = selectedTabBackgroundColor;
			        
			        content = selectedTab.id + "_content";
			        selectedTabContent = document.getElementById(content);
			        selectedTabContent.style.display = "block";
			    }
			    
			}
		</script>
	</head>
	<body>
		<div id ="wrapper">
			<a href="<?php echo $url; ?>" > Click here to login </a>
		</div>
	</body>
</html>