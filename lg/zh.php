<?php
//========================================================//
//============> LANGAGE FILE : CHINEESE <=================//
//========================================================//


//===================> Global Content <===================//

//===> General

define("_TITLE",			"Wiki Journey - Rediscover Tourism.");
define("_SRC_IMAGE_LOGO",	"./images/design/logo_and_catchphrase/fr.png");
//===> Top
define("_INDEX",			"首页");
define("_TEAM",				"团队");
define("_ABOUT",			"关于我们");
define("_TECHNICAL",		"技术支持");

//===> Bottom
define("_OUR_PARTNERS",		"合作伙伴");
define("_NO_PARTNERS_LOL",	"目前暂缺. 对我们的项目感兴趣吗 ? 来联系我们吧!");
define("_FOLLOW_US",		"关注我们 !");

//========================> Pages <========================//

//===> index.php
define("_WELCOME_TITLE",	"欢迎访问 !");
define("_BUTTON_POI_AROUND","在我周围寻找有意思的地点!");
define("_ADRESS_LOOK_UP",	"在一个特定地点周围寻找!");
define("_ADRESS_FAILURE",	"此地址不存在 !");
define("_GEOLOC_FAILURE",	"Sorry but we can't find your position.");
define("_AROUND_LOCATION", 	"在一个特定地点周围寻找!");
define("_AROUND_ME",		"在我周围寻找有意思的地点!");
define("_NOTE_GEOLOC",		
	                        "注意：此功能需要用到定位。只有在您的定位器工作正常和网络连接的情况下才可以确定您的位置。");
define("_OPTIONS",			"选项 :");
define("_RANGE",			"范围 (km) : ");
define("_MAX_POI",			"最大值 :");
define("_PLACEHOLDER",		"在此输入地点名称.");
define("_LOADING",			"Loading...");
//===> team.php
define("_TEAM_TITLE",		"团队");
define("_TEAM_WHO_R_WE",	"成员简介");
define("_TEAM_QUICKDESC",	 
	                        "我们是法国里尔中央理工学院一个学生项目开发团队，学校在法国北方省首府里尔市。在我们前两年的学习中，我们需要组成一个团队共同开发一个实际项目。这个项目即为我们选择开发的项目。");

define("_S_ARNOUTS_DESC",	"我对于编程和信息技术很感兴趣，所以我选择了加入这个项目。这个项目属于开源开发程序，对于我来说是一个将我的能力应用到一个实际项目中的很好的机会。");
define("_S_ARNOUTS_POSTE", 	"项目主管<br/>Web开发") ;
define("_P_ARZELIER_DESC",	  "			我选择这个项目因为我喜欢信息技术，我有Linux服务器和C语言开发的经验，也有能力进行Web开发。并且，日益发展的旅游业和新技术的发展相比于目前市场上已实  现的项目很少，使得在这个领域有很大的创新空间。");
define("_P_ARZELIER_POSTE", "服务器开发<br/>Web开发");
define("_T_GAUDIN_DESC",	"这个项目涉及到的领域、应用的技术（Web开发和Android开发）和合作团体吸引了我。我学习开源软件开发已经很长时间，我非常想在开源软件领域中做出一些成果。							所以我参加这个项目，希望作为一个项目创新者，将很少联系在一起的两个领域：旅游业和信息技术联系在一起。" );
define("_T_GAUDIN_POSTE", 	"Java开发<br/>服务器开发");
define("_N_HATIM_DESC",		"因为对计算机感兴趣，我加入Wikijourney这个项目，我相信参与开源软件开发的这个经历一定会为我带来有益的经验。" );
define("_N_HATIM_POSTE", 	"财务 - 合作伙伴<br/>Java开发");
define("_B_HUBER_DESC",		"在接受很多年的通识教育后，我希望可以加入一个具体的与新兴信息科技与交流相关的项目。Wikijourney对于我来说是个很好的项目来增强我的技术能力，并且它很						   好地解决了目前学生们所遇到的问题，即在旅行过程中能够快速地找到路线和景点信息，并实现导航。" );
define("_B_HUBER_POSTE", 	"合作伙伴<br/>Web开发");
define("_J_MAES_DESC",		"我一直以来对于信息技术很感兴趣，所以选择加入这个项目以更好地学习相关知识并初次尝试参与开发实际项目。我每年会有几次去新的城市旅行，但我发现旅游路标 导航并不总是方便使用的。尽管很多信息可以在网上找到，但旅游相关的信息却不容易找到。" );
define("_J_MAES_POSTE", 	"秘书<br/>Web开发");
define("_Y_WANG_DESC",		"我此前学过C语言和C++，并且自学了CSS和HTML。我认为这个项目很好地融合了电子地图和维基百科的信息，并且符合我的技术特点，所以对这个项目很感兴趣。" );
define("_Y_WANG_POSTE", 	"Java开发");

//===> about.php
define("_ABOUT_TITLE", 		"Wikijourney 项目简介");
define("_ABOUT_TEXT","		
							<p>Wikijourney是一个学生开发项目，通过获取用户在城市中的位置，可以将用户所处地点和维基百科的相关内容相联系。
							<br> 具体来说，我们希望开发一个App，根据您的偏好，找到景点并为您规划最佳旅行路线。
							</p>

							<h2>为什么选择开发App? </h2>
							<p>
							智能手机的普及以及便携性，并且3G网络使得用户可以更加便捷地获取网上的信息，
							<br>我们建议您可以通过离线功能提前下载地图及相关信息，在旅行过程中节省流量费用。
							</p>

							<h2>WanderWiki 回归啦 ! </h2>
							<p>
							如果您已经用过了<a href=\"http://wiki-geolocalisation.wix.com/wanderwiki\">WanderWiki</a>，您就不会对我们的项目感到困惑。Wikijourney是WanderWiki的继承，提供全新的地图和更多更强大的功能。
							</p>

							<h2>问题和建议 </h2>
							<p>
							我们希望倾听您的所有意见或建议。通过 <a href=\"mailto:wikijourneydev@gmail.com\">电子邮件</a> 或者直接通过Git编程来提出您的建议吧！
							</p>");
							
							
//===> technical.php
define("_TECHNICAL_TITLE",	"技术支持");
define("_TECHNICAL_TEXT",	"此网页还在建设当中，敬请期待! ;)");


//===> map.php
define("_MAP_POI_LINK",				"维基百科");
define("_MAP_POI_TYPE_CATHO",		"'天主教教堂'");
define("_MAP_POI_TYPE_FOOD",		"'饭店'");
define("_MAP_POI_TYPE_MONUM",		"'古迹'");
define("_MAP_POI_TYPE_JEWISH",		"'犹太教堂'");
define("_MAP_POI_TYPE_MUSEUM",		"'博物馆'");
define("_MAP_POI_TYPE_ART",			"'艺术馆'");
define("_MAP_POI_TYPE_SCHOOL",		"'大学'");
define("_MAP_POI_TYPE_SUBWAY",		"'地铁站'");

define("_LOOKING_FOR",				"Looking for POI around : ");
define("_YOUR_PATH",				"Your Path");
define("_CLEAR_CART",				"Clear Cart");
define("_SAVE_CART",				"Save cart !");
define("_CART_IS_EMPTY_POPUP",		"Your cart is empty, please fill it before exporting it ! ;)");
define("_YOU_ARE_HERE",				"You're here !");
define("_CENTER_BUTTON",			"Center on my position");
